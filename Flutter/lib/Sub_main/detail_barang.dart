import 'package:flutter/material.dart';
import '../Models/barang_model.dart';
import 'form_peminjaman.dart';
import '../session/user_session.dart';

class BarangDetailPage extends StatelessWidget {
  final Barang barang;

  const BarangDetailPage({super.key, required this.barang});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF123959),
      appBar: AppBar(
        title: const Text(
          'Kembali',
          style: const TextStyle(color: Colors.white),
        ),
        backgroundColor: const Color(0xFF123959),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(
              child: ClipRRect(
                borderRadius: BorderRadius.circular(12),
                child: Image.network(
                  'http://sisfo-sarpras.test/storage/${barang.gambar}',
                  height: 200,
                  width: double.infinity,
                  fit: BoxFit.cover,
                ),
              ),
            ),
            const SizedBox(height: 24),
            Text(
              barang.nama,
              style: const TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
                color: Colors.white,
              ),
            ),
            const SizedBox(height: 8),
            Text(
              'Kode Barang: ${barang.kode_barang}',
              style: const TextStyle(
                fontSize: 18,
                color: Colors.white70,
              ),
            ),
            const SizedBox(height: 8),
            Text(
              'Kategori: ${barang.kategori!['nama_kategori']}',
              style: const TextStyle(
                fontSize: 18,
                color: Colors.white70,
              ),
            ),
            const Spacer(),
            SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () async {
                  final namaSiswa = await UserSession.getNama();
                  final nisnSiswa = await UserSession.getNisn();

                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => FormPeminjamanPage(
                        barang: barang.toJson(),
                        namaSiswa: namaSiswa ?? 'tidak ada nama',
                        nisnSiswa: nisnSiswa ?? 'tidak ada nisn',
                      ),
                    ),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF367CC2),
                  padding: const EdgeInsets.symmetric(vertical: 16),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
                child: const Text(
                  'Pinjam',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
