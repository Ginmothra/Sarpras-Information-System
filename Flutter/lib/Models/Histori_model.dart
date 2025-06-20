class HistoriPeminjaman {
  final int id;
  final String kodeBarang;
  final String namaBarang;
  final DateTime? tanggalPinjam;
  final DateTime? tanggalKembali;
  final DateTime? tanggalSebenarnya;
  final String status;
  final String? alasanPenolakan;

  HistoriPeminjaman({
    required this.id,
    required this.kodeBarang,
    required this.namaBarang,
    this.tanggalPinjam,
    this.tanggalKembali,
    this.tanggalSebenarnya,
    required this.status,
    this.alasanPenolakan,
  });

  factory HistoriPeminjaman.fromJson(Map<String, dynamic> json) {
    return HistoriPeminjaman(
      id: json['id'],
      kodeBarang: json['kode_barang'],
      namaBarang: json['nama_barang'],
      tanggalPinjam: json['tanggal_pinjam'] != null
          ? DateTime.parse(json['tanggal_pinjam'])
          : null,
      tanggalKembali: json['tanggal_kembali'] != null
          ? DateTime.parse(json['tanggal_kembali'])
          : null,
      tanggalSebenarnya: json['tanggal_sebenarnya'] != null
          ? DateTime.parse(json['tanggal_sebenarnya'])
          : null,
      status: json['status'],
      alasanPenolakan: json['alasan_penolakan'],
    );
  }
}
