import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:sisfo_sarpras/session/user_session.dart';
import '../Models/peminjaman_model.dart';
import '../api_service.dart';
import '../Sub_main/form_pengembalian.dart';

class PeminjamanPage extends StatefulWidget {
  const PeminjamanPage({super.key});

  @override
  State<PeminjamanPage> createState() => _PeminjamanPageState();
}

class _PeminjamanPageState extends State<PeminjamanPage> {
  late Future<List<Peminjaman>> _futurePeminjaman;

  @override
  void initState() {
    super.initState();
    _futurePeminjaman = ApiService.fetchPeminjaman();
  }

  String formatTanggalWaktu(DateTime dt) {
    return DateFormat('dd MMMM yyyy • HH:mm', 'id_ID').format(dt.toLocal());
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor:const Color(0xFF123959),
      appBar: AppBar(
        title: const Text('Peminjaman Berlangsung'),
        backgroundColor:Colors.white,
        foregroundColor: const Color(0xFF123959),
      ),
      body: FutureBuilder<List<Peminjaman>>(
        future: _futurePeminjaman,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          }

          if (snapshot.hasError) {
            return Center(child: Text('Terjadi kesalahan: ${snapshot.error}'));
          }

          final peminjamanList = snapshot.data!;
          if (peminjamanList.isEmpty) {
            return const Center(child: Text('Belum ada data peminjaman.',style: TextStyle(color: Colors.white),));
          }

          return ListView.builder(
            itemCount: peminjamanList.length,
            itemBuilder: (context, index) {
              final peminjaman = peminjamanList[index];
              final barang = peminjaman.barang;

              final status = peminjaman.status.toLowerCase();
              final cardColor = status == 'diterima'
                  ? Colors.green[100]
                  : status == 'dikembalikan'
                      ? Colors.orange[100]
                      : null;

              return Card(
                color: cardColor,
                margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                child: ListTile(
                  leading: barang?['gambar'] != null
                      ? Image.network(
                          'http://sisfo-sarpras.test/storage/${barang?['gambar']}',
                          width: 50,
                          height: 50,
                          fit: BoxFit.cover,
                          errorBuilder: (context, error, stackTrace) =>
                              const Icon(Icons.image),
                        )
                      : const Icon(Icons.image),
                  title: Text(barang?['nama'] ?? 'Barang Tidak Diketahui'),
                  subtitle: Text(
                    'Kode Barang: ${peminjaman.kodeBarang}\n'
                    'Waktu Pengembalian: ${formatTanggalWaktu(peminjaman.tanggalKembali)}\n'
                    'Status: ${peminjaman.status}',
                  ),
                  onTap: () async {
                    if (status == 'pending') {
                      ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(
                          content: Text(
                              'Peminjaman masih dalam status pending, belum bisa dikembalikan.'),
                          duration: Duration(seconds: 2),
                        ),
                      );
                      return;
                    } else if (status == 'dikembalikan') {
                      ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(
                          content: Text(
                              'Pengembalian sedang diproses, silakan tunggu.'),
                          duration: Duration(seconds: 2),
                        ),
                      );
                      return;
                    }

                    final namaPengembali =
                        await UserSession.getNama() ?? 'tidak diketahui';
                    final nisnSiswa =
                        await UserSession.getNisn() ?? 'tidak diketahui';

                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => PengembalianPage(
                          peminjamanId: peminjaman.id,
                          barangId: peminjaman.barangId,
                          kodeBarang: barang?['kode_barang'] ??
                              '-', // pastikan field ini tersedia
                          nisn: nisnSiswa,
                          namaPengembali: namaPengembali,
                          namaBarang: barang?['nama'] ?? '-',
                          tanggalPeminjaman: peminjaman.tanggalPinjam,
                          tanggalPengembalian: peminjaman.tanggalKembali,
                        ),
                      ),
                    );
                  },
                ),
              );
            },
          );
        },
      ),
    );
  }
}
