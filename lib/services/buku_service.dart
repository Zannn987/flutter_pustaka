import 'package:http/http.dart' as http;
import 'dart:convert';
import '../models/buku.dart';

class BukuService {
  final String baseUrl = 'http://localhost/api_pustaka'; // URL backend API Anda

  Future<List<Buku>> fetchBuku() async {
    final response = await http.get(Uri.parse('$baseUrl/buku.php'));
    if (response.statusCode == 200) {
      List<dynamic> data = jsonDecode(response.body);
      return data.map((json) => Buku.fromJson(json)).toList();
    } else {
      throw Exception('Failed to load data');
    }
  }
}
