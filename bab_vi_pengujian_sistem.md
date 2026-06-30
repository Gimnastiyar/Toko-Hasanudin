# BAB VI
# PENGUJIAN SISTEM

Bab ini membahas mengenai proses pengujian yang dilakukan terhadap aplikasi "Sistem Informasi Kasir Toko Hasan". Pengujian sistem merupakan tahapan krusial dalam siklus pengembangan perangkat lunak yang bertujuan untuk memastikan bahwa seluruh fungsi dan fitur aplikasi berjalan sesuai dengan kebutuhan fungsional yang telah didefinisikan sebelumnya. Pengujian dilakukan menggunakan metode pengujian kotak hitam (*Black Box Testing*) untuk menguji fungsionalitas sistem dari sudut pandang pengguna tanpa memeriksa struktur kode internal sistem, serta pengujian penerimaan pengguna (*User Acceptance Testing*) untuk mengukur tingkat kepuasan dan kesiapan adopsi sistem oleh pengguna akhir.

---

## 6.1 SOFTWARE TEST DESCRIPTION (STD)

*Software Test Description* (STD) merupakan dokumen yang digunakan untuk menjelaskan skenario pengujian pada Sistem Informasi Kasir Toko Hasan. Pengujian dilakukan menggunakan metode *Black Box Testing* untuk memastikan seluruh fungsi sistem berjalan sesuai dengan kebutuhan pengguna tanpa melihat struktur kode program. 

Pengujian sistem dibagi berdasarkan hak akses pengguna, yaitu role **Kasir** dan **Admin**.

### 6.1.1 Pengujian Role Kasir

Pengujian pada bagian ini dikhususkan untuk memeriksa seluruh fungsi dan hak akses yang dimiliki oleh pengguna dengan hak akses (role) sebagai kasir. Kasir merupakan aktor utama yang berinteraksi langsung dengan antarmuka transaksi kasir (*point of sale*) untuk melakukan aktivitas pelayanan transaksi penjualan, pencarian barang, input pembayaran, hingga pencetakan struk belanja untuk pelanggan.

Tujuan dari pengujian ini adalah untuk menjamin kemudahan, kecepatan, dan kelancaran kasir saat melayani transaksi penjualan barang serta memastikan perhitungan matematis (subtotal, diskon, kembalian) terhitung secara otomatis oleh sistem tanpa terjadi kesalahan atau eror. Rincian skenario pengujian, data masukan, serta hasil keluaran yang diharapkan dari role kasir dapat dilihat pada tabel berikut.

**Tabel 6.1 STD Pengujian Role Kasir**

| No | Fitur | Skenario Pengujian | Input | Output yang Diharapkan |
| :--- | :--- | :--- | :--- | :--- |
| 1 | Login Kasir | Kasir masuk ke dalam sistem | Email dan password kasir | Sistem berhasil masuk ke dashboard kasir dengan hak akses terbatas |
| 2 | Logout Kasir | Kasir keluar dari sistem | Klik tombol logout | Sistem mengakhiri sesi kasir dan kembali ke halaman login |
| 3 | Dashboard Kasir | Kasir membuka dashboard utama kasir | Klik menu dashboard | Sistem menampilkan ringkasan data transaksi kasir pada hari aktif |
| 4 | Buka Form Transaksi | Kasir mengakses halaman transaksi kasir | Klik menu transaksi | Sistem menampilkan form kasir pintar dan input pemindaian barcode |
| 5 | Cari Barang (Barcode) | Kasir mencari produk berdasarkan barcode/SKU | Scan barcode barang / ketik kode produk lalu cari | Sistem menampilkan detail nama produk, harga satuan, dan stok dari database |
| 6 | Cari Barang (Gagal) | Kasir memindai barcode yang tidak terdaftar | Scan barcode tidak valid / salah | Sistem menampilkan pesan kesalahan "Barcode tidak terdaftar" |
| 7 | Atur Kuantitas Barang | Kasir mengubah kuantitas pembelian barang | Klik tombol + atau - pada kolom kuantitas | Kuantitas barang ter-update dan subtotal belanja dihitung ulang otomatis |
| 8 | Batas Maksimal Stok | Kasir menginput kuantitas melebihi stok barang | Input kuantitas lebih besar dari stok tersedia | Sistem membatasi input ke batas stok maksimal dan memunculkan notifikasi peringatan |
| 9 | Cari Customer | Kasir mencari data customer terdaftar | Input nomor telepon customer | Sistem menampilkan nama customer terdaftar pada form transaksi |
| 10 | Atur Diskon | Kasir menerapkan diskon transaksi | Input nominal diskon atau persentase diskon | Nilai potongan harga terhitung otomatis dan memotong total tagihan belanja |
| 11 | Kalkulasi Kembalian | Kasir menginput jumlah uang bayar dari pelanggan | Input jumlah uang tunai yang diterima | Sistem secara otomatis menghitung kembalian real-time dan mengaktifkan tombol bayar |
| 12 | Simpan & Cetak Struk | Kasir menyelesaikan transaksi dan mencetak struk | Klik tombol "BAYAR SEKARANG" dan klik "Cetak Struk" | Transaksi tersimpan ke database, stok terpotong, dan jendela cetak struk belanja terbuka |

---

### 6.1.2 Pengujian Role Admin

Pengujian pada bagian ini dilakukan untuk memeriksa seluruh fungsi manajemen dan hak akses penuh yang dimiliki oleh pengguna dengan hak akses sebagai administrator (admin). Admin merupakan aktor yang bertanggung jawab di balik layar untuk mengontrol jalannya operasional aplikasi, melakukan manajemen data master (produk, supplier, customer), memantau seluruh riwayat transaksi penjualan dari semua kasir, serta mengunduh laporan keuangan.

Tujuan utama dari pengujian ini adalah untuk memastikan bahwa panel kendali dashboard admin bekerja secara akurat saat melakukan pengolahan data produk, manajemen supplier, pendataan customer, verifikasi transaksi pembayaran, serta pembuatan rekapitulasi data laporan yang sah. Rincian skenario pengujian, data masukan, serta hasil keluaran yang diharapkan dari pengujian hak akses admin dapat dilihat pada tabel berikut.

**Tabel 6.2 STD Pengujian Role Admin**

| No | Fitur | Skenario Pengujian | Input | Output yang Diharapkan |
| :--- | :--- | :--- | :--- | :--- |
| 1 | Login Admin | Admin masuk ke dashboard | Email dan password admin | Sistem berhasil masuk ke dashboard admin dengan menu penuh |
| 2 | Logout Admin | Admin keluar dari sistem | Klik tombol logout | Sistem mengakhiri sesi admin dan kembali ke halaman login |
| 3 | Dashboard Admin | Admin membuka halaman dashboard utama | Klik menu dashboard | Sistem menampilkan grafik total pendapatan, jumlah produk, supplier, dan customer |
| 4 | Tambah Produk | Admin menambah data produk baru | Data produk (nama, harga beli/jual, stok, supplier, barcode) | Data produk berhasil disimpan ke basis data |
| 5 | Edit Produk | Admin mengubah informasi produk | Perubahan data produk | Data produk berhasil diperbarui pada database |
| 6 | Hapus Produk | Admin menghapus data produk | Klik tombol hapus produk | Data produk berhasil terhapus dari basis data |
| 7 | Tambah Supplier | Admin menambah data supplier baru | Data supplier (nama, kontak, alamat) | Data supplier baru berhasil disimpan |
| 8 | Edit Supplier | Admin mengubah informasi supplier | Perubahan data supplier | Data supplier berhasil diperbarui |
| 9 | Hapus Supplier | Admin menghapus data supplier | Klik tombol hapus supplier | Data supplier berhasil terhapus dari database |
| 10 | Bayar Supplier | Admin mencatat transaksi pembayaran ke supplier | Mengisi form pembayaran/hutang | Transaksi pembayaran supplier berhasil disimpan dan status ter-update |
| 11 | Tambah Customer | Admin menambah data customer baru | Data customer (nama, HP, alamat) | Data customer baru berhasil disimpan |
| 12 | Edit Customer | Admin mengubah data customer | Perubahan data customer | Data customer berhasil diperbarui |
| 13 | Hapus Customer | Admin menghapus data customer | Klik tombol hapus customer | Data customer berhasil dihapus dari database |
| 14 | Daftar Transaksi | Admin membuka riwayat penjualan | Klik menu transaksi | Sistem menampilkan tabel riwayat transaksi lengkap dari seluruh kasir |
| 15 | Update Status Pembayaran | Admin mengupdate status transaksi manual | Klik verifikasi status pembayaran | Status pembayaran transaksi berhasil diperbarui |
| 16 | Cetak Ulang Struk | Admin mencetak ulang struk penjualan | Klik tombol print pada transaksi terpilih | Sistem menampilkan print preview struk transaksi dengan benar |
| 17 | Ekspor Excel Transaksi | Admin mengekspor data transaksi ke Excel | Klik tombol export Excel | File rekap transaksi berformat Excel (.xlsx) berhasil diunduh |
| 18 | Menu Laporan | Admin membuka halaman laporan penjualan | Klik menu laporan | Halaman laporan menampilkan ringkasan data dan penyaringan tanggal |
| 19 | Ekspor PDF Laporan | Admin mengunduh berkas laporan dalam PDF | Filter tanggal dan klik unduh PDF | File laporan penjualan berformat PDF berhasil diunduh secara rapi |
| 20 | Laporan Stok Barang | Admin memantau barang yang menipis | Membuka tab laporan stok barang | Sistem menyajikan daftar produk dengan kuantitas stok di bawah batas aman |

---

## 6.2 SOFTWARE TEST RESULT (STR)

*Software Test Result* (STR) merupakan hasil dari pengujian sistem yang dilakukan berdasarkan skenario pada *Software Test Description* (STD). Pengujian dilakukan menggunakan metode *Black Box Testing* untuk memastikan seluruh fitur sistem berjalan sesuai dengan fungsi yang telah dirancang.

Hasil pengujian sistem dibagi berdasarkan role pengguna, yaitu **Kasir** dan **Admin**.

### 6.2.1 Hasil Pengujian Role Kasir

Hasil pengujian pada hak akses kasir ini memuat laporan akhir dari seluruh uji coba fitur yang dilakukan secara langsung pada antarmuka kasir pintar. Proses pengujian dilakukan dengan memosisikan penguji sebagai kasir yang melayani simulasi pembelian produk, memindai barcode barang, mengubah kuantitas barang, menginput diskon, hingga mencetak struk belanja.

Berdasarkan hasil uji coba yang telah dilakukan, seluruh fungsi yang diakses oleh kasir menunjukkan performa yang stabil dan mampu memberikan respons yang sesuai. Data yang dikirimkan oleh kasir dapat tersimpan dengan aman ke dalam database, perhitungan aritmatika diskon dan kembalian berjalan dengan tepat, serta sistem berhasil memanggil dialog print struk belanja tanpa mengalami kegagalan. Rincian detail mengenai fitur, hasil pengujian di lapangan, serta status akhir keberhasilan dari role kasir dapat dilihat pada tabel berikut.

**Tabel 6.3 STR Pengujian Role Kasir**

| No | Fitur | Hasil Pengujian | Hasil yang Diperoleh | Status |
| :--- | :--- | :--- | :--- | :--- |
| 1 | Login Kasir | Pengguna berhasil masuk sebagai kasir | Halaman dashboard kasir tampil dengan wewenang terbatas | Berhasil |
| 2 | Logout Kasir | Pengguna berhasil keluar dari sistem | Session login kasir berhasil dihapus | Berhasil |
| 3 | Dashboard Kasir | Halaman dashboard kasir berhasil ditampilkan | Ringkasan penjualan harian kasir tampil dengan baik | Berhasil |
| 4 | Buka Form Transaksi | Halaman kasir pintar berhasil diakses | Form transaksi dan pemindaian barcode tampil | Berhasil |
| 5 | Cari Barang (Barcode) | Pencarian produk di database berhasil | Detail nama produk, harga, dan sisa stok tampil secara real-time | Berhasil |
| 6 | Cari Barang (Gagal) | Deteksi barcode tidak terdaftar berhasil | Muncul notifikasi "Barcode tidak terdaftar di sistem" | Berhasil |
| 7 | Atur Kuantitas Barang | Pengubahan jumlah beli barang berhasil | Subtotal belanja ter-update secara otomatis dan tepat | Berhasil |
| 8 | Batas Maksimal Stok | Proteksi batas stok barang berhasil | Nilai input kembali ke stok maksimal dan muncul pesan peringatan | Berhasil |
| 9 | Cari Customer | Pencarian data customer terdaftar berhasil | Nama customer muncul di form transaksi | Berhasil |
| 10 | Atur Diskon | Penerapan potongan harga berhasil | Nominal tagihan berkurang sesuai persentase/nominal diskon | Berhasil |
| 11 | Kalkulasi Kembalian | Penghitungan uang kembalian berhasil | Selisih uang bayar tampil real-time dan tombol bayar aktif | Berhasil |
| 12 | Simpan & Cetak Struk | Pemrosesan transaksi dan struk berhasil | Transaksi tersimpan ke database, stok berkurang, dan jendela cetak struk terbuka | Berhasil |

---

### 6.2.2 Hasil Pengujian Role Admin

Hasil pengujian pada hak akses administrator ini menyajikan laporan akhir dari pengujian seluruh fungsi kendali yang ada di dalam dashboard admin. Proses uji coba dilakukan secara menyeluruh untuk memastikan panel admin mampu mengelola data dengan baik, mulai dari manipulasi data produk, manajemen supplier, verifikasi status transaksi, hingga pencetakan laporan PDF dan Excel.

Berdasarkan hasil pengujian yang telah dilaksanakan di lingkungan sistem, seluruh fitur manajemen menunjukkan tingkat keberhasilan yang sempurna tanpa adanya kendala teknis. Sistem mampu memproses perubahan data master dengan cepat ke dalam database, mengamankan sesi masuk admin, serta berhasil memfasilitasi ekspor berkas rekapitulasi data penjualan dalam format Excel maupun PDF secara akurat. Rincian detail mengenai menu manajemen, hasil operasional di lapangan, serta status akhir pengujian dari role admin dapat dilihat pada tabel berikut.

**Tabel 6.4 STR Pengujian Role Admin**

| No | Fitur | Hasil Pengujian | Hasil yang Diperoleh | Status |
| :--- | :--- | :--- | :--- | :--- |
| 1 | Login Admin | Admin berhasil login ke dashboard | Dashboard admin tampil dengan fitur menu lengkap | Berhasil |
| 2 | Logout Admin | Admin berhasil logout dari sistem | Session admin berhasil dihapus | Berhasil |
| 3 | Dashboard Admin | Dashboard admin berhasil ditampilkan | Statistik total penjualan, barang, supplier, dan customer tampil | Berhasil |
| 4 | Tambah Produk | Admin berhasil menambah data produk baru | Data produk tersimpan ke basis data | Berhasil |
| 5 | Edit Produk | Admin berhasil mengubah data produk | Perubahan data produk diperbarui pada database | Berhasil |
| 6 | Hapus Produk | Admin berhasil menghapus data produk | Data produk berhasil terhapus dari database | Berhasil |
| 7 | Tambah Supplier | Admin berhasil menambah data supplier | Data supplier tersimpan ke database | Berhasil |
| 8 | Edit Supplier | Admin berhasil mengubah data supplier | Perubahan data supplier diperbarui pada database | Berhasil |
| 9 | Hapus Supplier | Admin berhasil menghapus data supplier | Data supplier berhasil terhapus dari database | Berhasil |
| 10 | Bayar Supplier | Admin berhasil mencatat pembayaran ke supplier | Status transaksi supplier berhasil diperbarui | Berhasil |
| 11 | Tambah Customer | Admin berhasil menambah data customer | Data customer baru tersimpan pada database | Berhasil |
| 12 | Edit Customer | Admin berhasil mengubah data customer | Perubahan data customer berhasil diperbarui | Berhasil |
| 13 | Hapus Customer | Admin berhasil menghapus data customer | Data customer berhasil dihapus dari database | Berhasil |
| 14 | Daftar Transaksi | Riwayat transaksi penjualan berhasil dimuat | Daftar transaksi dari semua kasir tampil dengan rapi | Berhasil |
| 15 | Update Status Pembayaran | Admin berhasil memperbarui status pembayaran | Status transaksi berubah secara manual | Berhasil |
| 16 | Cetak Ulang Struk | Admin berhasil melakukan print preview struk | Struk transaksi tercetak dengan format yang sesuai | Berhasil |
| 17 | Ekspor Excel Transaksi | Rekap penjualan Excel berhasil diunduh | File spreadsheet Excel berhasil diunduh dan valid | Berhasil |
| 18 | Menu Laporan | Halaman laporan penjualan berhasil diakses | Tabel penjualan dan filter tanggal berfungsi baik | Berhasil |
| 19 | Ekspor PDF Laporan | Unduh laporan penjualan PDF berhasil | File laporan PDF dengan layout rapi berhasil dibuat dan diunduh | Berhasil |
| 20 | Laporan Stok Barang | Laporan ketersediaan barang berhasil dimuat | Daftar barang dengan stok menipis/habis tampil dengan baik | Berhasil |

Berdasarkan hasil pengujian yang telah dilakukan, seluruh fitur pada Sistem Informasi Kasir Toko Hasan dapat berjalan sesuai dengan kebutuhan fungsional sistem. Seluruh proses pengelolaan data, transaksi penjualan oleh kasir, serta pengelolaan informasi oleh admin dapat dilakukan dengan baik tanpa ditemukan kesalahan fungsi pada saat pengujian dilakukan.

---

## 6.3 USER ACCEPTANCE TESTING (UAT)

*User Acceptance Testing* (UAT) dilakukan untuk mengetahui apakah Sistem Informasi Kasir Toko Hasan telah sesuai dengan kebutuhan pengguna. Pengujian dilakukan langsung oleh pengguna sistem, yaitu kasir dan admin/pemilik toko, dengan mencoba seluruh fitur utama yang tersedia pada sistem.

Pengguna kemudian memberikan penilaian terhadap fungsi sistem berdasarkan kemudahan penggunaan, tampilan sistem, dan kesesuaian fitur dengan kebutuhan operasional.

### 6.3.1 UAT Role Kasir

**Tabel 6.5 UAT Role Kasir**

| No | Fitur | Skenario Pengujian | Hasil Simulasi | Persentase |
| :--- | :--- | :--- | :--- | :---: |
| 1 | Login Kasir | Kasir mengakses halaman login kasir | Sistem menampilkan form login kasir | 100% |
| | | Kasir memasukkan email dan password yang benar | Sistem berhasil login dan menampilkan dashboard kasir | 100% |
| | | Kasir memasukkan email atau password yang salah | Sistem menolak masuk dan memunculkan pesan validasi kesalahan | 100% |
| 2 | Logout Kasir | Kasir menekan tombol logout | Sistem mengakhiri sesi kasir dan mengalihkan ke halaman login | 100% |
| 3 | Dashboard Kasir | Kasir membuka halaman dashboard utama | Sistem menyajikan data total transaksi kasir yang bersangkutan | 100% |
| 4 | Transaksi Kasir | Kasir mengakses menu kasir pintar | Halaman form transaksi kasir pintar siap digunakan | 100% |
| | | Kasir memindai / mengetik barcode produk terdaftar | Sistem menampilkan nama produk, harga, dan stok di keranjang | 100% |
| | | Kasir memindai barcode produk yang tidak terdaftar | Sistem memunculkan notifikasi "Produk tidak ditemukan" | 100% |
| | | Kasir mengubah kuantitas produk menggunakan tombol + / - | Jumlah barang belanjaan bertambah/berkurang secara real-time | 100% |
| | | Kasir mengubah kuantitas produk melebihi sisa stok | Sistem membatasi kuantitas ke stok maksimal dan memberi peringatan | 100% |
| 5 | Data Customer & Diskon | Kasir menginput nomor HP customer terdaftar | Sistem menampilkan nama customer di halaman kasir | 100% |
| | | Kasir memilih tipe diskon dan memasukkan nilainya | Sistem menghitung potongan harga dan mengupdate total tagihan | 100% |
| 6 | Pembayaran | Kasir menginput nominal pembayaran dari pelanggan | Sistem otomatis menghitung uang kembalian real-time | 100% |
| | | Kasir menginput nominal uang bayar kurang dari tagihan | Sistem menampilkan pesan kesalahan dan menonaktifkan bayar | 100% |
| | | Kasir menekan tombol "BAYAR SEKARANG" | Transaksi disimpan ke basis data dan stok produk terpotong | 100% |
| 7 | Cetak Struk | Kasir menekan tombol "Cetak Struk" | Jendela cetak (print preview) struk belanja kasir terbuka | 100% |

**Tabel 6.6 Rekapitulasi UAT Kasir**

| Jumlah Responden | Jumlah Skenario | Skenario Berhasil | Tingkat Keberhasilan |
| :---: | :---: | :---: | :---: |
| 2 Orang | 16 | 16 | 100% |

---

### 6.3.2 UAT Role Admin

**Tabel 6.7 UAT Role Admin**

| No | Fitur (Sesuai SRS) | Skenario Pengujian | Hasil Simulasi | Persentase |
| :--- | :--- | :--- | :--- | :---: |
| 1 | Login Admin | Admin mengakses halaman login admin | Halaman login admin berhasil ditampilkan | 100% |
| | | Admin memasukkan email dan password admin yang benar | Sistem berhasil login dan menampilkan dashboard admin | 100% |
| | | Admin memasukkan email atau password admin yang salah | Sistem menampilkan pesan "kredensial tidak cocok" | 100% |
| | Logout Admin | Admin menekan tombol logout | Sistem mengakhiri sesi admin dan kembali ke halaman login | 100% |
| 2 | Dashboard Admin | Admin membuka halaman dashboard utama | Sistem menyajikan visualisasi grafik dan total pendapatan toko | 100% |
| 3 | Kelola Produk | Admin membuka menu daftar produk | Tabel data produk terisi lengkap dari basis data | 100% |
| | | Admin menambah produk dengan mengisi data lengkap | Data produk baru berhasil disimpan di database | 100% |
| | | Admin mengosongkan data wajib pada form tambah produk | Sistem menampilkan pesan validasi kesalahan input | 100% |
| | | Admin mengubah data produk dan menyimpannya | Perubahan data produk diperbarui pada database | 100% |
| | | Admin menekan tombol hapus produk | Data produk berhasil terhapus dari basis data | 100% |
| 4 | Kelola Supplier | Admin membuka halaman supplier | Daftar data supplier ditampilkan di tabel | 100% |
| | | Admin menambahkan data supplier baru | Data supplier baru berhasil disimpan | 100% |
| | | Admin mengubah informasi data supplier | Perubahan data supplier berhasil diperbarui | 100% |
| | | Admin mencatat transaksi pembayaran ke supplier | Riwayat pembayaran tersimpan dan mengubah nominal tagihan | 100% |
| | | Admin menghapus data supplier | Data supplier berhasil terhapus dari database | 100% |
| 5 | Kelola Customer | Admin membuka menu customer | Daftar customer terdaftar ditampilkan di tabel | 100% |
| | | Admin menambahkan data customer baru | Akun customer berhasil disimpan | 100% |
| | | Admin mengubah informasi data customer | Perubahan data customer diperbarui | 100% |
| | | Admin menghapus data customer | Data customer berhasil terhapus | 100% |
| 6 | Kelola Transaksi | Admin membuka riwayat transaksi penjualan | Sistem memuat daftar seluruh transaksi penjualan dari database | 100% |
| | | Admin melakukan update status pembayaran manual | Status transaksi pembayaran diperbarui sesuai pilihan admin | 100% |
| | | Admin menekan tombol export Excel | File rekapitulasi transaksi berformat Excel berhasil diunduh | 100% |
| | | Admin menekan tombol cetak struk dari tabel transaksi | Sistem menampilkan print preview struk transaksi terpilih | 100% |
| 7 | Kelola Laporan | Admin membuka halaman laporan penjualan | Sistem menampilkan data ringkasan laporan penjualan | 100% |
| | | Admin menyaring laporan berdasarkan rentang tanggal | Tabel laporan ter-update memuat data sesuai filter tanggal | 100% |
| | | Admin mengunduh laporan penjualan PDF | Berkas laporan penjualan format PDF berhasil diunduh | 100% |
| | | Admin membuka laporan stok barang | Sistem menampilkan data barang dengan stok kritis / menipis | 100% |

**Tabel 6.8 Rekapitulasi UAT Admin**

| Jumlah Responden | Jumlah Skenario | Skenario Berhasil | Tingkat Keberhasilan |
| :---: | :---: | :---: | :---: |
| 1 Orang | 27 | 27 | 100% |
