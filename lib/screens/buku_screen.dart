import 'package:flutter/material.dart';
import '../services/buku_service.dart';
import '../models/buku.dart';

class BukuScreen extends StatefulWidget {
  const BukuScreen({super.key});

  @override
  _BukuScreenState createState() => _BukuScreenState();
}

class _BukuScreenState extends State<BukuScreen> {
  final BukuService bukuService = BukuService();
  late Future<List<Buku>> bukuList;

  @override
  void initState() {
    super.initState();
    bukuList = bukuService.fetchBuku();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Data Buku')),
      body: FutureBuilder<List<Buku>>(
        future: bukuList,
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
                final buku = snapshot.data![index];
                return ListTile(
                  title: Text(buku.judul),
                  subtitle: Text(buku.pengarang),
                );
              },
            );
          }
        },
      ),
    );
  }
}
