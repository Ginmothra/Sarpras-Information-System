import 'package:shared_preferences/shared_preferences.dart';

class UserSession {
  static Future<void> saveUserData(String nama, String nisn, String token) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('nama', nama);
    await prefs.setString('nisn', nisn);
    await prefs.setString('token', token);  
  }

  static Future<String?> getNama() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('nama');
  }

  static Future<String?> getNisn() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('nisn');
  }

  static Future<String?> getToken() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('token');
  }

  static Future<void> clear() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.clear();
  }
}
