import 'package:intl/intl.dart';

class PengembalianModel {
  final int peminjamanId;
  final int barangId;
  final String kodeBarang;
  final String nisn;
  final String namaPengembali;
  final String namaBarang;
  final String kondisiBarang;
  final String? catatan;
  final String buktiPengembalian;
  final DateTime tanggalPeminjaman;
  final DateTime tanggalPengembalian;

  PengembalianModel({
    required this.peminjamanId,
    required this.barangId,
    required this.kodeBarang,
    required this.nisn,
    required this.namaPengembali,
    required this.namaBarang,
    required this.kondisiBarang,
    this.catatan,
    required this.buktiPengembalian,
    required this.tanggalPeminjaman,
    required this.tanggalPengembalian,
  });

  Map<String, dynamic> toJson() {
    final DateFormat formatter = DateFormat('yyyy-MM-dd HH:mm:ss');

    return {
      'peminjaman_id': peminjamanId,
      'barang_id': barangId,
      'kode_barang': kodeBarang,
      'nisn': nisn,
      'nama_pengembali': namaPengembali,
      'nama_barang': namaBarang,
      'kondisi_barang': kondisiBarang,
      'catatan': catatan ?? '',
      'bukti_pengembalian': buktiPengembalian,
      'tanggal_peminjaman': formatter.format(tanggalPeminjaman.toLocal()),
      'tanggal_pengembalian': formatter.format(tanggalPengembalian.toLocal()),
    };
  }
}
