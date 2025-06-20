import 'dart:convert';
import 'package:http/http.dart' as http;
import 'Models/barang_model.dart' as barangModel;
import 'session/user_session.dart';
import 'Models/peminjaman_model.dart' as peminjamanModel;
import 'Models/pengembalian_model.dart';
import 'Models/Histori_model.dart';

class ApiService {
  static const baseUrl = 'http://sisfo-sarpras.test/api'; 

  static Future<bool> login(String nisn, String password) async {
  final url = Uri.parse('$baseUrl/login');
  final response = await http.post(
    url,
    headers: {'Content-Type': 'application/json'},
    body: jsonEncode({'nisn': nisn, 'password': password}),
  );

  if (response.statusCode == 200) {
    final data = jsonDecode(response.body);
    final nama = data['nama'];
    final nisn = data['nisn'];
    final token = data['token'];

    await UserSession.saveUserData(nama, nisn, token);

    return true;
  } else {
    return false;
  }
}


  static Future<List<barangModel.Barang>> fetchBarang() async {
    final uri = Uri.parse('$baseUrl/barang');
    final token = await UserSession.getToken();

    final response = await http.get(uri, headers: {
      'Authorization':'Bearer $token',
      'content-Type': 'application/json',
    });
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      final List<dynamic> data = jsonData['data'];
      return data.map((json) => barangModel.Barang.fromJson(json)).toList();
    } else {
      throw Exception('Gagal memuat data barang');
    }
  }

 static Future<dynamic> submitPeminjaman(Map<String, dynamic> data) async {
  final token = await UserSession.getToken();

  final url = Uri.parse('$baseUrl/peminjaman');
  final response = await http.post(
    url,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
    },
    body: jsonEncode(data),
  );

  if (response.statusCode == 201 || response.statusCode == 200) {
    return true;
  } else if (response.statusCode == 422) {
    return jsonDecode(response.body);
  } else {
    print('Response status: ${response.statusCode}');
    print('Response body: ${response.body}');
    return false;
  }
}

static Future<List<peminjamanModel.Peminjaman>> fetchPeminjaman() async {
    final url = Uri.parse('http://sisfo-sarpras.test/api/peminjaman');
    final token = await UserSession.getToken();

    final response = await http.get(
      url,
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body);
      final List data = jsonData['data'];
      return data.map((e) => peminjamanModel.Peminjaman.fromJson(e)).toList();
    } else {
      throw Exception('Gagal mengambil data peminjaman');
    }
  }

static Future<List<HistoriPeminjaman>> fetchHistori() async {
  final url = Uri.parse('http://sisfo-sarpras.test/api/histori');
  final token = await UserSession.getToken();
  final response = await http.get(
      url,
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );

  if (response.statusCode == 200) {
    final List data = jsonDecode(response.body);
    return data.map((e) => HistoriPeminjaman.fromJson(e)).toList();
  } else {
    throw Exception('Gagal memuat histori');
  }
}

  Future<void> kirimPengembalian(PengembalianModel pengembalian) async {
  var uri = Uri.parse('$baseUrl/pengembalian');
  var request = http.MultipartRequest('POST', uri);

  final token = await UserSession.getToken();

  request.headers.addAll({
    'Authorization': 'Bearer $token',
    'Accept': 'application/json',
  });

  request.fields.addAll(
    pengembalian.toJson().map((key, value) => MapEntry(key, value.toString())),
  );

  request.files.add(await http.MultipartFile.fromPath(
    'bukti_pengembalian',
    pengembalian.buktiPengembalian,
  ));

  var response = await request.send();
  if (response.statusCode != 201 && response.statusCode != 200) {
    final res = await http.Response.fromStream(response);
    throw Exception(jsonDecode(res.body)['message'] ?? 'Gagal mengirim pengembalian');
  }
}

 static Future<Map<String, dynamic>> getProfile() async {
  final url = Uri.parse('http://sisfo-sarpras.test/api/profile');
  final token = await UserSession.getToken();

  final response = await http.get(
    url,
    headers: {
      'Authorization': 'Bearer $token',
      'Accept': 'application/json',
    },
  );

  if (response.statusCode == 200) {
    return jsonDecode(response.body);
  } else {
    throw Exception('Gagal memuat profil');
  }
}

}