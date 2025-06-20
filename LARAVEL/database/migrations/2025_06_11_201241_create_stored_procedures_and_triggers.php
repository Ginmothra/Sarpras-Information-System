<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        DB::unprepared("
            DROP TRIGGER IF EXISTS barang_AFTER_INSERT;
            CREATE TRIGGER barang_AFTER_INSERT 
            AFTER INSERT ON barang FOR EACH ROW
            BEGIN
                DECLARE kategori VARCHAR(255);
                
                SELECT nama_kategori INTO kategori 
                FROM kategori 
                WHERE id = NEW.kategori_id;
                
                INSERT INTO laporan (
                    keterangan, kategori, status, created_at, updated_at
                )
                VALUES (
                    CONCAT(
                        'Admin ', NEW.admin, 
                        ' Menambahkan Barang Dengan Nama ', NEW.nama, 
                        ' Dengan Kode Barang ', NEW.kode_barang, 
                        ' Dengan Kategori ', kategori
                    ), 
                    'barang', 'input_barang', NOW(), NOW()
                );
            END;
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS barang_AFTER_UPDATE;
            CREATE TRIGGER barang_AFTER_UPDATE 
            AFTER UPDATE ON barang FOR EACH ROW
            BEGIN
                DECLARE old_kategori VARCHAR(255);
                DECLARE new_kategori VARCHAR(255);

                SELECT nama_kategori INTO old_kategori FROM kategori WHERE id = OLD.kategori_id;
                SELECT nama_kategori INTO new_kategori FROM kategori WHERE id = NEW.kategori_id;

                INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
                VALUES (
                    CONCAT(
                        'Admin ', OLD.admin,
                        ' Telah Mengedit Barang ', OLD.nama, ' (', OLD.kode_barang, ') Menjadi ', NEW.nama, ' (', NEW.kode_barang, ')',
                        ', Kategori ', old_kategori, ' Menjadi ', new_kategori
                    ),
                    'barang', 'edit_barang', NOW(), NOW()
                );
            END;
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS barang_AFTER_DELETE;
            CREATE TRIGGER barang_AFTER_DELETE 
            AFTER DELETE ON barang FOR EACH ROW
            BEGIN
                DECLARE kategori_nama VARCHAR(255);

                SELECT nama_kategori INTO kategori_nama FROM kategori WHERE id = OLD.kategori_id;

                INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
                VALUES (
                    CONCAT(
                        'Admin ', OLD.admin, 
                        ' Menghapus Barang ', OLD.nama, 
                        ' (', OLD.kode_barang, ')', 
                        ' Dengan Kategori ', kategori_nama
                    ),
                    'barang', 'hapus_barang', NOW(), NOW()
                );
            END;
        ");

        // DENDA TRIGGER
        DB::unprepared("
            DROP TRIGGER IF EXISTS denda_AFTER_INSERT;
            CREATE TRIGGER `denda_AFTER_INSERT` AFTER INSERT ON `denda` FOR EACH ROW BEGIN
                DECLARE nama_siswa VARCHAR(255);
                DECLARE jumlah_formatted VARCHAR(50);

                SELECT username INTO nama_siswa FROM siswa WHERE nisn = NEW.siswa_nisn;

                SET jumlah_formatted = CONCAT('Rp ', REPLACE(FORMAT(NEW.jumlah, 0), ',', '.'));

                INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
                VALUES (
                    CONCAT(
                        'Admin ', NEW.admin, 
                        ' Telah Memberikan Denda Kepada ', nama_siswa, 
                        ' sejumlah ', jumlah_formatted, 
                        ' dengan alasan ', NEW.keterangan
                    ), 
                    'denda', 'input_denda', NOW(), NOW()
                );
            END
        ");
        
        DB::unprepared("
            DROP TRIGGER IF EXISTS denda_AFTER_UPDATE;
            CREATE TRIGGER `denda_AFTER_UPDATE` AFTER UPDATE ON `denda` FOR EACH ROW BEGIN
            declare siswa varchar(50);
            declare jumlah_denda varchar(50);
            set jumlah_denda = concat('Rp ', REPLACE(format(old.jumlah,0), ',', '.'));
            select username into siswa from siswa where nisn = old.siswa_nisn;

            insert into laporan (keterangan, kategori, status, created_at, updated_at)
            values (concat('Admin ', OLD.admin, ' Mengonfirmasi Pembayaran Siswa ', siswa, ' sejumlah ', jumlah_denda) , 'denda', 'konfirmasi_denda', now(), now());
        END
        ");
        // TRIGGER SISWA
        DB::unprepared("
    CREATE TRIGGER siswa_AFTER_INSERT AFTER INSERT ON siswa FOR EACH ROW
    BEGIN
        INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
        VALUES (
            CONCAT('Admin ', NEW.admin, ' menambahkan siswa baru dengan NISN ', NEW.nisn, ' dan username ', NEW.username),
            'siswa',
            'input_siswa',
            NOW(),
            NOW()
        );
    END
");

DB::unprepared("
    CREATE TRIGGER siswa_AFTER_DELETE AFTER DELETE ON siswa FOR EACH ROW
    BEGIN
        INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
        VALUES (
            CONCAT('Admin ', OLD.admin, ' menghapus siswa dengan NISN ', OLD.nisn, ' dan username ', OLD.username),
            'siswa',
            'hapus_siswa',
            NOW(),
            NOW()
        );
    END
");

DB::unprepared("
    CREATE TRIGGER siswa_AFTER_UPDATE AFTER UPDATE ON siswa FOR EACH ROW
    BEGIN
        INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
        VALUES (
            CONCAT('Admin ', NEW.admin, ' mengubah data siswa dengan NISN ', OLD.nisn),
            'siswa',
            'edit_siswa',
            NOW(),
            NOW()
        );
    END
");
        DB::unprepared('
    CREATE TRIGGER kategori_AFTER_INSERT AFTER INSERT ON kategori FOR EACH ROW
    BEGIN
        INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
        VALUES (
            CONCAT("Admin ", NEW.admin, " menambahkan kategori baru bernama ", NEW.nama_kategori),
            "kategori",
            "input_kategori",
            NOW(),
            NOW()
        );
    END
');

DB::unprepared('
    CREATE TRIGGER kategori_AFTER_UPDATE AFTER UPDATE ON kategori FOR EACH ROW
    BEGIN
        INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
        VALUES (
            CONCAT("Admin ", NEW.admin, " mengubah kategori dari ", OLD.nama_kategori, " menjadi ", NEW.nama_kategori),
            "kategori",
            "edit_kategori",
            NOW(),
            NOW()
        );
    END
');

DB::unprepared('
    CREATE TRIGGER kategori_AFTER_DELETE AFTER DELETE ON kategori FOR EACH ROW
    BEGIN
        INSERT INTO laporan (keterangan, kategori, status, created_at, updated_at)
        VALUES (
            CONCAT("Admin ", OLD.admin, " menghapus kategori bernama ", OLD.nama_kategori),
            "kategori",
            "hapus_kategori",
            NOW(),
            NOW()
        );
    END
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_Kategori;");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_AFTER_INSERT;");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_AFTER_UPDATE;");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_AFTER_DELETE;");
        DB::unprepared("DROP TRIGGER IF EXISTS siswa_AFTER_INSERT;");
        DB::unprepared("DROP TRIGGER IF EXISTS siswa_AFTER_DELETE;");
        DB::unprepared("DROP TRIGGER IF EXISTS siswa_AFTER_UPDATE;");
        DB::unprepared('DROP TRIGGER IF EXISTS kategori_AFTER_INSERT');
        DB::unprepared('DROP TRIGGER IF EXISTS kategori_AFTER_UPDATE');
        DB::unprepared('DROP TRIGGER IF EXISTS kategori_AFTER_DELETE');

    }
};
