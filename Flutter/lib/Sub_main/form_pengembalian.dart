import 'dart:io';
import 'package:file_picker/file_picker.dart';
import 'package:flutter/material.dart';
import '../api_service.dart';
import '../Models/pengembalian_model.dart';

class PengembalianPage extends StatefulWidget {
  final int peminjamanId;
  final int barangId;
  final String kodeBarang;
  final String nisn;
  final String namaBarang;
  final String namaPengembali;
  final DateTime tanggalPeminjaman;
  final DateTime tanggalPengembalian;

  const PengembalianPage({
    super.key,
    required this.peminjamanId,
    required this.barangId,
    required this.kodeBarang,
    required this.nisn,
    required this.namaBarang,
    required this.namaPengembali,
    required this.tanggalPeminjaman,
    required this.tanggalPengembalian,
  });

  @override
  _PengembalianPageState createState() => _PengembalianPageState();
}

class _PengembalianPageState extends State<PengembalianPage> {
  final _formKey = GlobalKey<FormState>();
  String kondisi = 'baik';
  String? catatan;
  File? bukti;
  bool isLoading = false;

  void pickFile() async {
    final result = await FilePicker.platform.pickFiles();
    if (result != null) {
      setState(() {
        bukti = File(result.files.single.path!);
      });
    }
  }

  void submit() async {
    if (!_formKey.currentState!.validate()) return;
    if (bukti == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Silakan upload bukti pengembalian terlebih dahulu')),
      );
      return;
    }

    setState(() => isLoading = true);

    final data = PengembalianModel(
      peminjamanId: widget.peminjamanId,
      barangId: widget.barangId,
      kodeBarang: widget.kodeBarang,
      nisn: widget.nisn,
      namaPengembali: widget.namaPengembali,
      namaBarang: widget.namaBarang,
      kondisiBarang: kondisi,
      catatan: catatan,
      buktiPengembalian: bukti!.path.split('/').last,
      tanggalPeminjaman: widget.tanggalPeminjaman.toLocal(),
      tanggalPengembalian: widget.tanggalPengembalian.toLocal(),
    );

    try {
      await ApiService().kirimPengembalian(data);
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Pengembalian berhasil dikirim')),
      );
      Navigator.pop(context);
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Gagal mengirim pengembalian: $e')),
      );
    } finally {
      setState(() => isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Form Pengembalian')),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text('Nama Barang: ${widget.namaBarang}'),
              const SizedBox(height: 8),
              Text('Kode Barang: ${widget.kodeBarang}'),
              const SizedBox(height: 16),
              DropdownButtonFormField<String>(
                value: kondisi,
                decoration: const InputDecoration(
                  labelText: 'Kondisi Barang',
                  border: OutlineInputBorder(),
                ),
                items: ['baik', 'rusak']
                    .map((val) => DropdownMenuItem(value: val, child: Text(val)))
                    .toList(),
                onChanged: (val) => setState(() => kondisi = val!),
              ),
              const SizedBox(height: 16),
              TextFormField(
                onChanged: (val) => catatan = val,
                decoration: InputDecoration(
                  labelText: kondisi == 'rusak' ? 'Jelaskan Kerusakan' : 'Catatan (opsional)',
                  border: const OutlineInputBorder(),
                ),
                maxLines: 3,
                validator: (val) {
                  if (kondisi == 'rusak' && (val == null || val.trim().isEmpty)) {
                    return 'Mohon jelaskan kerusakan';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),
              ElevatedButton.icon(
                onPressed: pickFile,
                icon: const Icon(Icons.upload_file),
                label: Text(
                  bukti == null
                      ? 'Upload Bukti'
                      : 'Bukti Terpilih: ${bukti!.path.split('/').last}',
                ),
              ),
              const SizedBox(height: 24),
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: isLoading ? null : submit,
                  child: isLoading
                      ? const SizedBox(
                          height: 20,
                          width: 20,
                          child: CircularProgressIndicator(
                            color: Colors.white,
                            strokeWidth: 2,
                          ),
                        )
                      : const Text('Kirim Pengembalian'),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
