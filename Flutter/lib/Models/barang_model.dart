class Barang {
  final int id;
  final String kode_barang;
  final String nama;
  final int kategori_id;
  final String gambar;
  final String kondisi;
  final String? status;
  final Map<String, dynamic>? kategori;

  Barang({
    required this.id,
    required this.kode_barang,
    required this.nama,
    required this.kategori_id,
    required this.gambar,
    required this.kondisi,
    this.status,
    this.kategori,
  });

  factory Barang.fromJson(Map<String, dynamic> json) {
    return Barang(
      id: json['id'],
      kode_barang: json['kode_barang'],
      nama: json['nama'],
      kategori_id: json['kategori_id'],
      gambar: json['gambar'],
      kondisi: json['kondisi'],
      status: json['status'],
      kategori: json['kategori'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'kode_barang': kode_barang,
      'nama': nama,
      'kategori_id': kategori_id,
      'gambar': gambar,
      'kondisi': kondisi,
      'status': status,
      'kategori': kategori,
    };
  }
}
