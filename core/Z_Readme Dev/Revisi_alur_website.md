Alur website :

0. CRUD Permission Management & User Manajement with status(true/false):
	- CRUD Permission & User
	- Data Section ( Self Data for prodi/ormawa & All data for admin)
	- CRUD Unit
	- CRUD Kategori
	- CRUD kegiatan
	- Exeption permohonan
	- CRUD Permohonan+SPJ (maks 1 peromhonan berjalan, kecuali dengan exception admin)
	- Disposisi 1 Permohonan ( hanya melihat & lanjutkan )
	- Disposisi 2 Permohonan ( menolak/menerima permohonan )
	- Disposisi 3 Permohonan ( menolak/menerima permohonan )
	- Disposisi 4 Permohonan ( hanya melihat & lanjutkan ke spj jika pemohon sudah mengambil uang permohonan )
	- Disposisi 1 SPJ ( menolak/menerima SPJ )
	- Disposisi 2 SPJ ( menolak/menerima SPJ )
1. Admin CRUD unit with status(true/false)
2. Admin CRUD Kategori Permohonan untuk Prodi/Ormawa with status(true/false)
3. PPK CRUD Kegiatan with status(true/false)
4. Prodi/Ormawa membuat permohonan -> setelah selesai redirect ke page show/detail untuk rincian biaya
5. Podi/Ormawa membuat rincian biaya
6. Prodi/Ormawa menekan tombol submit untuk memproses permohonan ke disposisi 1 permohonan
7. Wd2 memeriksa permohonan yang masuk & Menekan Tombol Lanjutkan ke disposisi 2 permohonan
8. PPK memeriksa permohonan : 	- menolak permohonan : menekan tombol Tolak dan memasukkan alasan penolakan+file penolakan dan mengembalikan permohonan ke user yang bersangkutan
							 	- menerima permohonan : menekan tombol terima dan melanjutkan ke disposisi 4 permohonan
9. Kasubag memeriksa permohonan : 	- menolak permohonan : menekan tombol Tolak dan memasukkan alasan penolakan+file penolakan dan mengembalikan permohonan ke user yang bersangkutan
							 		- menerima permohonan : menekan tombol terima dan melanjutkan ke disposisi 4 permohonan
10. BPP memeriksa permohonan dan memberikan dana ke pemohon, jika pemohon sudah mengambil dana maka BPP menekan tombol konfirmasi bahwa dana sudah diambil dan tor permohonan dilanjutkan ke spj
11. Prodi/Ormawa Melengkapi Spj
12. Prodi/Ormawa menekan tombol submit untuk memproses spj ke disposisi 1 spj
13. Kasubag memeriksa spj : - menolak spj : menekan tombol Tolak dan memasukkan alasan penolakan+file penolakan dan mengembalikan spj ke user yang bersangkutan
							 - menerima spj : menekan tombol terima dan melanjutkan ke disposisi 2 spj
14. BPP memeriksa spj : 	- menerima spj : menekan tombol terima dan spj telah selesai, pemohon bisa membuat permohonan lainnya
BPP (Filter/Menilai)-(download-kasih catatan ke pemohon)-{pedoman spj akhir}-(konfirmasi)