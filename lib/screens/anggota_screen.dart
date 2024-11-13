import 'package:flutter/material.dart';
import '../services/anggota_service.dart';
import '../models/anggota.dart';

class AnggotaScreen extends StatefulWidget {
  const AnggotaScreen({super.key});

  @override
  _AnggotaScreenState createState() => _AnggotaScreenState();
}

class _AnggotaScreenState extends State<AnggotaScreen> {
  final AnggotaService anggotaService = AnggotaService();
  late Future<List<Anggota>> anggotaList;

  @override
  void initState() {
    super.initState();
    anggotaList = anggotaService.fetchAnggota();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Data Anggota')),
      body: FutureBuilder<List<Anggota>>(
        future: anggotaList,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('No data found'));
          } else {
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) {
                final anggota = snapshot.data![index];
                return ListTile(
                  title: Text(anggota.nama),
                  subtitle: Text(anggota.nim),
                );
              },
            );
          }
        },
      ),
    );
  }
}
