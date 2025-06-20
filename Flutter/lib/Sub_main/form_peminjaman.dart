import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:sisfo_sarpras/Partials/bottom_nav.dart';
import '../api_service.dart';

class FormPeminjamanPage extends StatefulWidget {
  final Map<String, dynamic> barang;
  final String namaSiswa;
  final String nisnSiswa;

  const FormPeminjamanPage({
    super.key,
    required this.barang,
    required this.namaSiswa,
    required this.nisnSiswa,
  });

  @override
  State<FormPeminjamanPage> createState() => _FormPeminjamanPageState();
}

class _FormPeminjamanPageState extends State<FormPeminjamanPage> {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _alasanController = TextEditingController();
  final TextEditingController _tanggalKembaliController = TextEditingController();

  late String tanggalPinjam;

  @override
  void initState() {
    super.initState();
    tanggalPinjam = DateFormat('yyyy-MM-dd HH:mm:ss').format(DateTime.now());
  }

  void _submitForm() async {
    if (_formKey.currentState!.validate()) {
      final data = {
        'barang_id': widget.barang['id'],
        'kode_barang' : widget.barang['kode_barang'],
        'siswa_nisn': widget.nisnSiswa,
        'nama_barang': widget.barang['nama'],
        'alasan': _alasanController.text,
        'tanggal_pinjam': tanggalPinjam,
        'tanggal_kembali': _tanggalKembaliController.text,
      };

      showDialog(
        context: context,
        barrierDismissible: false,
        builder: (_) => const Center(child: CircularProgressIndicator()),
      );
      final result = await ApiService.submitPeminjaman(data);

      Navigator.pop(context);

      if (result == true) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Permintaan peminjaman berhasil dikirim')),
        );
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (_) => const BottomNavBar(initialIndex: 1)),
        );
      } else if (result is Map && result.containsKey('message')) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text(result['message'])),
        );
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Gagal mengirim permintaan peminjaman')),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F7FA),
      appBar: AppBar(
        title: const Text('Form Peminjaman'),
        backgroundColor: const Color(0xFF377DC2),
        elevation: 0,
      ),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 24),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              Card(
                elevation: 3,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                ),
                margin: EdgeInsets.zero,
                child: Padding(
                  padding: const EdgeInsets.all(16),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text('Kode Barang',
                          style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 16,
                              color: Colors.grey[700])),
                      const SizedBox(height: 4),
                      Text(widget.barang['kode_barang'] ?? '-',
                          style: const TextStyle(
                              fontSize: 18, fontWeight: FontWeight.w600)),
                      const Divider(height: 24),
                      Text('Nama Barang',
                          style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 16,
                              color: Colors.grey[700])),
                      const SizedBox(height: 4),
                      Text(widget.barang['nama'],
                          style: const TextStyle(
                              fontSize: 18, fontWeight: FontWeight.w600)),
                      const Divider(height: 24),
                      Text('Nama Peminjam',
                          style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 16,
                              color: Colors.grey[700])),
                      const SizedBox(height: 4),
                      Text(widget.namaSiswa,
                          style: const TextStyle(
                              fontSize: 18, fontWeight: FontWeight.w600)),
                    ],
                  ),
                ),
              ),
              const SizedBox(height: 24),
              TextFormField(
                controller: _alasanController,
                decoration: InputDecoration(
                  labelText: 'Alasan Peminjaman',
                  prefixIcon: const Icon(Icons.note),
                  border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12)),
                  filled: true,
                  fillColor: Colors.white,
                ),
                maxLines: 3,
                validator: (value) =>
                    value == null || value.isEmpty ? 'Alasan wajib diisi' : null,
              ),
              const SizedBox(height: 20),
              TextFormField(
                controller: _tanggalKembaliController,
                readOnly: true,
                decoration: InputDecoration(
                  labelText: 'Tanggal Kembali',
                  prefixIcon: const Icon(Icons.calendar_today),
                  border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12)),
                  filled: true,
                  fillColor: Colors.white,
                ),
                onTap: () async {
                  final pickedDate = await showDatePicker(
                    context: context,
                    initialDate: DateTime.now().add(const Duration(days: 1)),
                    firstDate: DateTime.now(),
                    lastDate: DateTime.now().add(const Duration(days: 30)),
                  );
                  if (pickedDate != null) {
                    final pickedTime = await showTimePicker(
                      context: context,
                      initialTime: TimeOfDay.now(),
                    );
                    if (pickedTime != null) {
                      final combinedDateTime = DateTime(
                        pickedDate.year,
                        pickedDate.month,
                        pickedDate.day,
                        pickedTime.hour,
                        pickedTime.minute,
                      );
                      _tanggalKembaliController.text =
                          DateFormat('yyyy-MM-dd HH:mm:ss')
                              .format(combinedDateTime);
                    } else {
                      _tanggalKembaliController.text =
                          DateFormat('yyyy-MM-dd 00:00:00')
                              .format(pickedDate);
                    }
                  }
                },
                validator: (value) => value == null || value.isEmpty
                    ? 'Tanggal kembali wajib diisi'
                    : null,
              ),
              const SizedBox(height: 32),
              SizedBox(
                height: 50,
                child: ElevatedButton(
                  onPressed: _submitForm,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFF377DC2),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                    elevation: 5,
                  ),
                  child: const Text(
                    'Request Peminjaman',
                    style: TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.w600,
                      color: Colors.white,
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
