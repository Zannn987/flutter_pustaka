import 'package:flutter/material.dart';
import './anggota_screen.dart';
import './buku_screen.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Aplikasi Pustaka'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => AnggotaScreen()),
                );
              },
              child: const Text('Data Anggota'),
            ),
            ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => BukuScreen()),
                );
              },
              child: const Text('Data Buku'),
            ),
          ],
        ),
      ),
    );
  }
}
