class Peminjaman {
  final int id;
  final String tanggalPinjam;
  final String tanggalKembali;
  final int anggotaId;
  final int bukuId;

  Peminjaman({
    required this.id,
    required this.tanggalPinjam,
    required this.tanggalKembali,
    required this.anggotaId,
    required this.bukuId,
  });

  factory Peminjaman.fromJson(Map<String, dynamic> json) {
    return Peminjaman(
      id: json['id'],
      tanggalPinjam: json['tanggal_pinjam'],
      tanggalKembali: json['tanggal_kembali'],
      anggotaId: json['anggota'],
      bukuId: json['buku'],
    );
  }
}
