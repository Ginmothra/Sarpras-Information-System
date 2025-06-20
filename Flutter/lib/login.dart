import 'package:flutter/material.dart';
import 'api_service.dart';
import 'package:google_fonts/google_fonts.dart';
import 'Partials/bottom_nav.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final nisnController = TextEditingController();
  final passwordController = TextEditingController();
  String? error;
  bool isLoading = false;

  void handleLogin() async {
    final nisn = nisnController.text.trim();
    final password = passwordController.text.trim();

    if (nisn.isEmpty || password.isEmpty) {
      setState(() {
        error = 'NISN dan Password harus diisi';
      });
      return;
    }

    setState(() {
      error = null;
      isLoading = true;
    });

    final result = await ApiService.login(nisn, password);
    setState(() {
      isLoading = false;
    });

    if (result) {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => const BottomNavBar()),
      );
    } else {
      setState(() {
        error = 'Nisn atau Password salah';
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: DefaultTextStyle(
        style: GoogleFonts.nunito(
          textStyle: const TextStyle(
            color: Colors.black,
            fontSize: 14,
          ),
        ),
        child: Stack(
          children: [
            Positioned.fill(
              child: Image.asset(
                'assets/bg.jpg',
                fit: BoxFit.cover,
              ),
            ),
            Container(
              color: Colors.black.withOpacity(0.2),
            ),
            Center(
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(24),
                child: Container(
                  padding: const EdgeInsets.all(24),
                  width: 350,
                  decoration: BoxDecoration(
                    color: const Color(0xFFEEF1F6),
                    borderRadius: BorderRadius.circular(14),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.1),
                        blurRadius: 12,
                        offset: const Offset(0, 6),
                      ),
                    ],
                  ),
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Image.asset(
                        'assets/logo.png',
                        width: 160,
                      ),
                      const SizedBox(height: 16),
                      Text(
                        'SISFO SARPRAS',
                        style: GoogleFonts.nunito(
                          fontSize: 20,
                          fontWeight: FontWeight.w900,
                          letterSpacing: 1.5,
                        ),
                      ),
                      const SizedBox(height: 24),
                      TextField(
                        controller: nisnController,
                        decoration: InputDecoration(
                          hintText: 'NISN',
                          hintStyle: GoogleFonts.nunito(),
                          filled: true,
                          fillColor: Colors.white,
                          contentPadding: const EdgeInsets.symmetric(
                              horizontal: 20, vertical: 14),
                          border: OutlineInputBorder(
                            borderRadius: BorderRadius.circular(14),
                            borderSide: BorderSide.none,
                          ),
                        ),
                      ),
                      const SizedBox(height: 20),
                      TextField(
                        controller: passwordController,
                        obscureText: true,
                        decoration: InputDecoration(
                          hintText: 'Password',
                          hintStyle: GoogleFonts.nunito(),
                          filled: true,
                          fillColor: Colors.white,
                          contentPadding: const EdgeInsets.symmetric(
                              horizontal: 20, vertical: 14),
                          border: OutlineInputBorder(
                            borderRadius: BorderRadius.circular(14),
                            borderSide: BorderSide.none,
                          ),
                        ),
                      ),
                      const SizedBox(height: 24),
                      SizedBox(
                        width: double.infinity,
                        height: 48,
                        child: ElevatedButton(
                          onPressed: handleLogin,
                          style: ElevatedButton.styleFrom(
                            backgroundColor: const Color(0xFF377DC2),
                            foregroundColor: Colors.white,
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(14),
                            ),
                            elevation: 6,
                          ),
                          child: isLoading
                              ? const SizedBox(
                                width: 24,
                                height: 24,
                                child: CircularProgressIndicator(
                                  color: Colors.white,
                                  strokeWidth: 2,
                                ),
                              ): Text(
                                  'Login',
                                  style: GoogleFonts.nunito(
                                    fontWeight: FontWeight.w400,
                                    fontSize: 16,
                                  ),
                                ),
                        ),
                      ),
                      const SizedBox(height: 12),
                      if (error != null)
                        Text(
                          error!,
                          style: GoogleFonts.nunito(
                            color: Colors.red,
                            fontSize: 14,
                          ),
                        ),
                    ],
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
