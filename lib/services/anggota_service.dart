import 'package:http/http.dart' as http;
import 'dart:convert';
import '../models/anggota.dart';

class AnggotaService {
  final String baseUrl = 'http://localhost/api_pustaka'; // URL backend API Anda

  Future<List<Anggota>> fetchAnggota() async {
    final response = await http.get(Uri.parse('$baseUrl/anggota.php'));
    if (response.statusCode == 200) {
      List<dynamic> data = jsonDecode(response.body);
      return data.map((json) => Anggota.fromJson(json)).toList();
    } else {
      throw Exception('Failed to load data');
    }
  }
}
