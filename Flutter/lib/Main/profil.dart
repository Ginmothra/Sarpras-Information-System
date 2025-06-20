import 'package:flutter/material.dart';
import '../session/user_session.dart';
import '../api_service.dart';
import '../login.dart';
import 'dart:io';

class ProfilPage extends StatefulWidget {
  const ProfilPage({super.key});

  @override
  State<ProfilPage> createState() => _ProfilPageState();
}

class _ProfilPageState extends State<ProfilPage> {
  String nama = '';
  String nisn = '';
  String tanggalGabung = '';
  String totalDenda = '0';

  @override
  void initState() {
    super.initState();
    fetchProfile();
  }

  Future<void> fetchProfile() async {
    try {
      final response = await ApiService.getProfile();
      setState(() {
        nama = response['nama'] ?? '';
        nisn = response['nisn'] ?? '';
        tanggalGabung = response['tanggal_bergabung'] ?? '';
        totalDenda = response['total_denda']?.toString() ?? '0';
      });
    } catch (e) {
      print('Error saat mengambil profil: $e');
    }
  }

  Future<void> logout() async {
    await UserSession.clear();
    if (context.mounted) {
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (context) => const LoginPage()),
        (route) => false,
      );
    }
  }

  Future<void> launchWA() async {
  final message =
      'HALO MIN SAYA SISWA DENGAN NISN [$nisn] INGIN MENGGANTI USERNAME MENJADI [ISI DENGAN USERNAME BARU] DAN PASSWORD MENJADI [ISI DENGAN PASSWORD BARU] TERIMA KASIH';
  final url = 'https://wa.me/628984458227?text=${Uri.encodeComponent(message)}';

  if (Platform.isWindows) {
    await Process.run('start', [url], runInShell: true);
  } else if (Platform.isMacOS) {
    await Process.run('open', [url]);
  } else if (Platform.isLinux) {
    await Process.run('xdg-open', [url]);
  } else {
    print('Platform tidak didukung.');
  }
}

  @override
Widget build(BuildContext context) {
  return Scaffold(
    backgroundColor: const Color(0xFF123959),
    appBar: AppBar(
      title: const Text('Profil'),
      backgroundColor: Colors.white,
      foregroundColor: const Color(0xFF123959),
      elevation: 1,
    ),
    body: LayoutBuilder(
      builder: (context, constraints) {
        return SingleChildScrollView(
          child: ConstrainedBox(
            constraints: BoxConstraints(minHeight: constraints.maxHeight),
            child: IntrinsicHeight(
              child: Padding(
                padding: const EdgeInsets.all(20),
                child: Column(
                  children: [
                    const CircleAvatar(
                      radius: 40,
                      backgroundColor: Colors.white,
                      child: Icon(Icons.person, size: 48, color: Color(0xFF123959)),
                    ),
                    const SizedBox(height: 16),
                    Card(
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                      elevation: 4,
                      color: const Color(0xFF1E4C7B),
                      child: Padding(
                        padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 24),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const Text(
                              'Informasi Akun',
                              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Colors.white),
                            ),
                            const SizedBox(height: 12),
                            Text('Nama: $nama', style: const TextStyle(color: Colors.white, fontSize: 15)),
                            Text('NISN: $nisn', style: const TextStyle(color: Colors.white, fontSize: 15)),
                            Text('Tanggal Bergabung: $tanggalGabung', style: const TextStyle(color: Colors.white, fontSize: 15)),
                            const SizedBox(height: 20),
                            const Divider(color: Colors.white54),
                            const SizedBox(height: 12),
                            const Text(
                              'Total Denda Belum Lunas',
                              style: TextStyle(color: Colors.white70),
                            ),
                            Text(
                              'Rp. $totalDenda',
                              style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 16),
                            ),
                            const SizedBox(height: 24),
                            Center(
                              child: ElevatedButton(
                                onPressed: launchWA,
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: const Color(0xFF377DC2),
                                  padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                                ),
                                child: const Text('Ubah Kata Sandi / Profil', style: TextStyle(color: Colors.white)),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    const Spacer(),
                    const SizedBox(height: 24),
                    ElevatedButton(
                      onPressed: logout,
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.red,
                        padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                      ),
                      child: const Text('Logout', style: TextStyle(color: Colors.white)),
                    ),
                  ],
                ),
              ),
            ),
          ),
        );
      },
    ),
  );
}

}
