class Anggota {
  final int id;
  final String nim;
  final String nama;
  final String alamat;
  final String jenisKelamin;

  Anggota({
    required this.id,
    required this.nim,
    required this.nama,
    required this.alamat,
    required this.jenisKelamin,
  });

  factory Anggota.fromJson(Map<String, dynamic> json) {
    return Anggota(
      id: int.parse(json['id']?.toString() ?? '0'), // Set default value if null
      nim: json['nim'] ?? '', // Default to empty string if null
      nama: json['nama'] ?? '', // Default to empty string if null
      alamat: json['alamat'] ?? '', // Default to empty string if null
      jenisKelamin:
          json['jenisKelamin'] ?? '', // Default to empty string if null
    );
  }
}
