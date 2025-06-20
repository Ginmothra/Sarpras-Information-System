import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import '../Models/Histori_model.dart';
import '../api_service.dart';

class HistoryPage extends StatefulWidget {
  const HistoryPage({super.key});

  @override
  State<HistoryPage> createState() => _HistoryPageState();
}

class _HistoryPageState extends State<HistoryPage> {
  late Future<List<HistoriPeminjaman>> _futureHistori;

  @override
  void initState() {
    super.initState();
    Intl.defaultLocale = 'id_ID';
    _futureHistori = ApiService.fetchHistori();
  }

  String _formatTanggal(DateTime? tanggal) {
    if (tanggal == null) {
      return 'N/A';
    }
    return DateFormat('dd MMMM HH:mm').format(tanggal.toLocal());
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF123959),
      appBar: AppBar(
        title: const Text('Histori Peminjaman'),
        foregroundColor: const Color(0xFF123959),
        backgroundColor: Colors.white,
      ),
      body: FutureBuilder<List<HistoriPeminjaman>>(
        future: _futureHistori,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          }

          if (snapshot.hasError) {
            return Center(
                child: Text('Terjadi kesalahan: ${snapshot.error}. Silakan coba lagi.'));
          }

          if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('Belum ada histori peminjaman.'));
          }

          final historiList = snapshot.data!;

          return ListView.builder(
            padding: const EdgeInsets.all(8.0),
            itemCount: historiList.length,
            itemBuilder: (context, index) {
              final histori = historiList[index];
              Color cardColor;
              Color textColor;
              String statusDisplayText;

              switch (histori.status) {
                case 'rejected':
                  cardColor = Colors.red.shade50;
                  textColor = Colors.red.shade700;
                  statusDisplayText = 'Ditolak';
                  break;
                case 'accepted':
                  cardColor = Colors.purple.shade50;
                  textColor = Colors.purple.shade700;
                  statusDisplayText = 'Disetujui';
                  break;
                default:
                  cardColor = Colors.grey.shade50;
                  textColor = Colors.grey.shade700;
                  statusDisplayText = 'Status Tidak Diketahui';
              }

              return Card(
                color: cardColor,
                margin: const EdgeInsets.symmetric(vertical: 6, horizontal: 4),
                elevation: 2,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10),
                ),
                child: Padding(
                  padding: const EdgeInsets.all(12.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        children: [
                          Icon(_getStatusIcon(histori.status), color: textColor, size: 20),
                          const SizedBox(width: 8),
                          Text(
                            statusDisplayText,
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 15,
                              color: textColor,
                            ),
                          ),
                        ],
                      ),
                      const Divider(height: 12, thickness: 0.8),
                      _buildInfoRow('Kode Barang', histori.kodeBarang),
                      _buildInfoRow('Nama Barang', histori.namaBarang),
                      _buildInfoRow('Tanggal Pinjam', _formatTanggal(histori.tanggalPinjam)),
                      _buildInfoRow('Batas Pengembalian', _formatTanggal(histori.tanggalKembali)),
                      
                      if (histori.tanggalSebenarnya != null)
                        _buildInfoRow('Tanggal Pengembalian', _formatTanggal(histori.tanggalSebenarnya)),
                      
                      if (histori.status == 'rejected' && histori.alasanPenolakan != null && histori.alasanPenolakan!.isNotEmpty)
                        _buildInfoRow('Alasan Penolakan', histori.alasanPenolakan!, isReason: true),
                    ],
                  ),
                ),
              );
            },
          );
        },
      ),
    );
  }

  Widget _buildInfoRow(String label, String value, {bool isReason = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 2.0),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            '$label: ',
            style: const TextStyle(fontWeight: FontWeight.w600, fontSize: 13),
          ),
          Expanded(
            child: Text(
              value,
              style: TextStyle(
                fontSize: 13,
                color: isReason ? Colors.red.shade600 : Colors.black87,
              ),
            ),
          ),
        ],
      ),
    );
  }

  IconData _getStatusIcon(String status) {
    switch (status) {
      case 'rejected':
        return Icons.cancel;
      case 'accepted':
        return Icons.thumb_up_alt;
      default:
        return Icons.info_outline;
    }
  }
}