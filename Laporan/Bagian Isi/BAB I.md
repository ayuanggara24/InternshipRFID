BAB I
PENDAHULUAN

1.1	Latar Belakang
Saat ini, banyak industry yang menggunakan teknologi Radio Frequency Identification (RFID)[1], RFID diterapkan dalam berbagai aplikasi seperti aplikasi pencatatan kehadiran[2], manajemen pergudangan[3], perpustakaan[4], pelacakan objek[5], dan lain sebagainya. RFID memiliki beberapa keunggulan dibandingkan dengan teknologi identifikasi tradisional. RFID tidak memerlukan trek acak untuk komunikasi dan tag RFID dapat dibaca berkali kali [6]. RFID relative lebih cepat dan banyak tag yang dapat dibaca secara bersamaan. Sistem RFID terdiri dari tag RFID, RFID reader dan PC [7]. Setiap tag RFID memiliki ID unik yang sesuai dengan informasi yang diperlukan (misalnya informasi produk, pelacakan, dan posisi), dan Penggunaan nomor unik di dalam tag sangat berguna sebagai identitas suatu benda atau sebagai alat pelacak[8].
Sementara RFID banyak digunakan, penting untuk dicatatan bahwa RFID memiliki kelemahan. Kelemahan dalam sistem RFID adalah memungkinkan untuk menduplikasi data identifikasi[9]. Serangan duplikasi membuat aplikasi tidak aman karena penduplikasian tag asli sehingga mengancam aplikasi yang menggunakan keaslian tag untuk memvalidasi objek[10]. Serangan penduplikasian ini dapat mengakibatkan kerugian bagi pengguna [11]. [12].
Oleh karena itu, untuk meningkatkan keamanan sistem dan meminimalisir duplikasi dalam sistem RFID dalam hal ini peneliti akan menerapkan metode Multi-Factor Authentication (MFA). MFA adalah metode untuk mengotentikasi pengguna dengan menggunkan beberapa lapisan program Autentikasi. Ini adalah acara Autentikasi yang aman yang mungkin dapat mencegah pencurian identitas [13]. Ini dianggap sebagai cara aman untuk otentikasi yang dapat secara efektif mencegah pencurian identitas [14]. Adapun faktor yang akan digunakan pada laporan ini adalah menggunakan One-Time Password. One-time password (OTP) adalah kata sandi yang hanya berlaku untuk satu sesi login atau transaksi, pada perangkat digital manapun. OTPs menghindari sejumlah kekurangan yang terkait dengan sistem otentikasi berbasis password tradisional.[15] Maka, Dengan adanya sistem dengan beberapa langkah otentifikasi ini juga dapat meminimalisir kecurangan yang akan terjadi. Seperti kasus proxy absen (titip absen).

1.2	Identifikasi Masalah
Adapun identifikasi masalah yang melatarbelakangi untuk mengambil judul Internship II ini adalah sebagai berikut :
1.	Bagaimana cara untuk meminimalisir terjadinya penduplikasian RFID dan pencurian data terkait pada RFID?
2.	Bagaimana cara menggunakan metode Multi-factor Authentication untuk melakukan proses autentikasi pengguna untuk meminimalisir terjadi penduplikasian dan kecurangan pada sistem RFID?

1.3	Tujuan dan Manfaat
	Adapun tujuan dari perancangan sistem berbasis RFID dan metode MFA ini adalah:
1.	Untuk membangun sebuah sistem dengan beberapa langkah otentifikasi untuk meminimalisir terjadinya duplikasi dan kecurangan pada RFID 
2.	Untuk menerapkan metode Multi-factor Authentication dalam pembangunan sistem agar tujuan pertama dapat tercapai yaitu untuk meminimalisir kecurangan dan penduplikasian RFID.  

Manfaat yang diperoleh dari analisis dan perancangan sistem berbasis RFID dan metode MFA ini adalah sebagai berikut:
1.	Dengan mengimplementasikan metode Multi-factor Authentication yaitu proses autentikasi beberapa langkah dengan penerapan OTP didalam nya dapat meminimalisir terjadinya kecurangan dan duplikasi pada RFID.
2.	Dengan adanya sistem ini dapat membantu pengguna untuk menjaga data pribadi yang dimiliki nya.

1.4	Ruang Lingkup
Ruang lingkup yang digunakan dalam penelitian ini adalah :
1.	Perancangan alat dan sistem untuk meminimalisir penduplikasian RFID menggunakan Arduino dan Ethernet Shield.
2.	Perancangan ini menerapkan metode Multi-factor Authentication dan menggunakan One-Time Password sebagai salah satu multi-factor nya.
3.	Sistem yang dibangun hanya terdiri dari user dan admin. Dan data yang terdapat pada kartu RFID hanya kode OTP dan jam masuk serta jam keluar.
4.	Tools yang digunakan dalam perancangan sistem menggunkana UML (Unified Modelling Language) dengan tahapan use case diagram, class diagram, sequence diagram, activity diagram, statechart diagram, component diagram, dan deployment diagram.

