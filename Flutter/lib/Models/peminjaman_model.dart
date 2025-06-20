class Peminjaman {
  final int id;
  final String siswaNisn;
  final String kodeBarang;
  final int barangId;
  final String namaBarang;
  final String alasan;
  final String status;
  final DateTime tanggalPinjam;
  final DateTime tanggalKembali;
  final String? alasanPenolakan;
  final Map<String,dynamic>? barang;

  Peminjaman({
    required this.id,
    required this.siswaNisn,
    required this.kodeBarang,
    required this.barangId,
    required this.namaBarang,
    required this.alasan,
    required this.status,
    required this.tanggalPinjam,
    required this.tanggalKembali,
    required this.alasanPenolakan,
    required this.barang,
  });

  factory Peminjaman.fromJson(Map<String, dynamic> json) {
    return Peminjaman(
      id: json['id'],
      siswaNisn: json['siswa_nisn'],
      kodeBarang: json['kode_barang'],
      barangId: json['barang_id'],
      namaBarang: json['nama_barang'],
      alasan: json['alasan'],
      status: json['status'],
      tanggalPinjam: DateTime.parse(json['tanggal_pinjam']),
      tanggalKembali: DateTime.parse(json['tanggal_kembali']),
      alasanPenolakan: json['alasan_penolakan'],
      barang: json['barang']
    );
  }
}