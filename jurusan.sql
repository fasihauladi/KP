-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jan 2024 pada 16.26
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jurusan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `npm` varchar(14) NOT NULL,
  `kesan` text DEFAULT NULL,
  `telp` varchar(16) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `beasiswa`
--

CREATE TABLE `beasiswa` (
  `id` int(11) NOT NULL,
  `namabeasiswa` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `beasiswa`
--

INSERT INTO `beasiswa` (`id`, `namabeasiswa`, `deskripsi`, `create`, `update`) VALUES
(7, 'Beasiswa SEMESTA', 'Beberapa tahun belakangan ini, beasiswa SEMESTA turun mewarnai pendidikan di tanah air. Beasiswa besutan SEVIMA ini memberikan fasilitas kuliah gratis dan kerja langsung di SEVIMA. Tahun ini merupakan beasiswa keempat yang sudah diberikan kepada para pemenang beruntung. \r\n\r\nMenariknya lagi, SEVIMA memberikan hadiah total hingga 1 Milyar untuk para 50 pemenang beasiswa. Tak heran jika jajaran pimpinan di tanah air pun turut mendukung penuh hadirnya beasiswa ini. Kamu bisa langsung daftar disini : https://maukuliah.id/beasiswa-semesta.', '2023-12-06 20:13:38', NULL),
(8, 'Beasiswa KIP Kuliah', 'Beasiswa informatika ini merupakan salah satu beasiswa yang dibuka khusus calon mahasiswa yang ingin berkuliah di PTN/PTS di seluruh Indonesia. Program beasiswa ini diperuntukkan bagi lulusan SMA/SMK/MA yang ingin melanjutkan seluruh program studi, salah satunya program studi teknik informatika.', '2023-12-06 20:14:22', NULL),
(9, 'Beasiswa IT BCA', 'BCA juga tak kalah dalam membantu peningkatan pendidikan di tanah air. BCA menyediakan beasiswa Program Pendidikan Teknik Informatika (PPTI) khusus untuk para lulusan SMA/SMK/MA di tanah air. Beasiswa ini memberikan uang saku gratis bagi para penerimanya.', '2023-12-06 20:15:14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidminat`
--

CREATE TABLE `bidminat` (
  `id` int(11) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `namabidminat` varchar(255) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `petapenelitian` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `bidminat`
--

INSERT INTO `bidminat` (`id`, `kodeprodi`, `namabidminat`, `profile`, `petapenelitian`, `create`, `update`) VALUES
(10, 'tif', 'Komputasi Pemrosesan Bahasa Alami', '<p>Komputasi Pemrosesan Bahasa Alami (Natural Language Processing atau NLP) adalah cabang dari kecerdasan buatan yang berfokus pada interaksi antara komputer dan bahasa manusia. Tujuannya adalah memungkinkan komputer untuk memahami, menganalisis, dan merespons bahasa manusia dengan cara yang bermakna. Berikut adalah penjelasan lebih rinci tentang Konsep Komputasi Pemrosesan Bahasa Alami :</p>\n\n<ol>\n <li><strong>Tokenization, </strong>Tokenization adalah proses memecah sebuah teks menjadi unit-unit kecil yang disebut token. Token bisa berupa kata, frasa, atau tanda baca. Langkah ini membantu komputer untuk memahami struktur dasar dari kalimat atau dokumen.</li>\n <li><strong>Morphological Analysis, </strong>Pada tahap ini, kata-kata diuraikan menjadi morfem-morfem atau bentuk dasar mereka. Ini membantu dalam memahami arti kata dan hubungannya dengan kata-kata lain dalam kalimat.</li>\n <li><strong>Syntax Analysis, </strong>Proses ini melibatkan analisis struktur gramatikal dari kalimat. Komputer mencoba memahami hubungan sintaksis antara kata-kata dalam sebuah kalimat untuk mengerti struktur kalimat yang benar.</li>\n <li><strong>Semantics, </strong>Semantik berkaitan dengan pemberian makna pada kata atau kalimat. Pada tingkat ini, komputer mencoba untuk memahami makna di balik kata-kata dan bagaimana mereka saling terkait.</li>\n <li><strong>Pragmatics, </strong>Pragmatik melibatkan pemahaman konteks atau situasi di mana suatu pernyataan dibuat. Ini mencakup pemahaman implisit, referensi, dan tujuan komunikatif dari kalimat atau ujaran.</li>\n <li><strong>Entity Recognition, </strong>Komputer berusaha mengidentifikasi entitas atau objek tertentu dalam teks, seperti orang, tempat, tanggal, dll. Ini penting untuk memahami informasi spesifik dalam konteks.</li>\n <li><strong>Sentiment Analysis, </strong>Analisis sentimen melibatkan penentuan emosi atau sikap yang terkandung dalam teks. Misalnya, apakah suatu pernyataan bersifat positif, negatif, atau netral.</li>\n <li><strong>Machine Translation, </strong>Ini melibatkan penerjemahan otomatis dari satu bahasa ke bahasa lain. Sistem NLP dapat membantu dalam menerjemahkan teks secara otomatis.</li>\n <li><strong>Speech Recognition,</strong> NLP juga mencakup pengenalan ucapan, di mana komputer berusaha untuk mengenali dan memahami ucapan manusia.</li>\n <li><strong>Question Answering,</strong> Sistem NLP dapat dirancang untuk menjawab pertanyaan manusia berdasarkan pemahaman mereka terhadap teks tertentu.</li>\n <li><strong>Chatbots,</strong> Penggunaan NLP dapat ditemukan dalam pembuatan chatbot, yang dapat berkomunikasi dengan pengguna melalui bahasa manusia dan memberikan jawaban atau bantuan.</li>\n</ol>\n\n<p>Implementasi NLP dapat memanfaatkan teknologi seperti machine learning dan deep learning untuk meningkatkan kemampuan pemahaman dan respons sistem terhadap bahasa manusia. Teknologi ini terus berkembang untuk mendukung berbagai aplikasi, mulai dari pencarian web hingga asisten virtual dan analisis sentimen.</p>', '<p>Peta penelitian dalam Komputasi Pemrosesan Bahasa Alami (Natural Language Processing or NLP) mencakup berbagai area dan topik yang sedang dieksplorasi oleh peneliti di bidang ini. Berikut adalah beberapa arah penelitian utama dalam NLP :</p>\r\n\r\n<ol>\r\n <li><strong>Mendalamnya Pemahaman Bahasa</strong>\r\n\r\n <ul>\r\n  <li>Peningkatan kemampuan sistem untuk memahami konteks dan nuansa dalam bahasa manusia.</li>\r\n  <li>Pengembangan model yang mampu mengenali perbedaan dalam penggunaan bahasa dalam berbagai konteks.</li>\r\n </ul>\r\n </li>\r\n <li><strong>Transfer Learning dan Pre-trained Models</strong>\r\n <ul>\r\n  <li>Penggunaan model yang telah dilatih sebelumnya untuk tugas-tugas tertentu (pre-trained models) dan kemudian mengadaptasikannya untuk tugas spesifik yang lebih kecil.</li>\r\n  <li>Penelitian tentang cara efektif mentransfer pengetahuan dari satu tugas ke tugas lain.</li>\r\n </ul>\r\n </li>\r\n <li><strong>Multimodal NLP</strong>\r\n <ul>\r\n  <li>Integrasi pemrosesan bahasa dengan informasi dari modality lain, seperti gambar, video, atau audio.</li>\r\n  <li>Pengembangan model yang dapat memahami dan memanipulasi informasi dari berbagai sumber modalitas.</li>\r\n </ul>\r\n </li>\r\n <li><strong>Explainability and Interpretability</strong>\r\n <ul>\r\n  <li>Pengembangan model NLP yang dapat dijelaskan dan dipahami oleh manusia.</li>\r\n  <li>Penelitian tentang cara menjelaskan keputusan dan prediksi model NLP.</li>\r\n </ul>\r\n </li>\r\n <li><strong>Bahasa Manusia yang Lebih Alami:</strong>\r\n <ul>\r\n  <li>Pengembangan model yang mampu menghasilkan bahasa yang lebih alami dan kontekstual.</li>\r\n  <li>Pemahaman dan generasi dialog yang lebih baik untuk aplikasi chatbot dan asisten virtual.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Peta penelitian ini mencerminkan kompleksitas dan keragaman tantangan yang dihadapi oleh peneliti dalam memajukan kemampuan komputasi pemrosesan bahasa alami. Penelitian ini tidak hanya membahas masalah teknis, tetapi juga aspek-aspek etika, privasi, dan keadilan yang semakin menjadi perhatian.</p>', '2023-12-02 18:16:39', '2023-12-02 18:17:37'),
(11, 'tif', 'Kecerdasan Komputasi', '<p xss=removed>Kecerdasan Komputasi, atau dalam bahasa Inggris dikenal sebagai Computational Intelligence, adalah cabang dari kecerdasan buatan yang fokus pada pengembangan metode komputasional untuk meniru kemampuan-kemampuan intelektual manusia. Tujuannya adalah memungkinkan komputer untuk belajar dari pengalaman, menyesuaikan diri dengan situasi baru, dan melakukan tugas-tugas yang biasanya memerlukan kecerdasan manusia. Berikut adalah beberapa aspek utama dari Kecerdasan Komputasi :</p>\r\n\r\n<ol>\r\n <li xss=removed><strong>Fuzzy Logic</strong>\r\n\r\n <ul>\r\n  <li>Fuzzy logic mencakup penanganan kebenaran parsial atau tidak pasti dalam suatu sistem.</li>\r\n  <li>Menggunakan konsep \"nilai keanggotaan\" untuk menggambarkan sejauh mana suatu kondisi atau keadaan memenuhi suatu kriteria.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Neural Networks</strong><strong>???????</strong>\r\n <ul>\r\n  <li>Neural networks adalah model komputasi yang terinspirasi oleh struktur dan fungsi otak manusia.</li>\r\n  <li>Mereka terdiri dari lapisan-lapisan neuron buatan (node) yang dapat belajar dari data untuk menghasilkan output yang diinginkan.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Evolutionary Computation</strong>\r\n <ul>\r\n  <li>Evolutionary computation melibatkan teknik-teknik yang terinspirasi dari proses evolusi biologis.</li>\r\n  <li>Algoritma genetika, strategi evolusioner, dan pemrograman genetik termasuk dalam pendekatan ini untuk menyelesaikan masalah optimasi dan pembelajaran mesin.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Swarm Intelligence</strong>\r\n <ul>\r\n  <li>Rough set theory digunakan untuk menangani ketidakpastian dan tidak pasti dalam data.</li>\r\n  <li>Mengidentifikasi hubungan-hubungan yang tidak pasti antara elemen-elemen dalam sebuah set data.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Rough Sets:</strong>\r\n <ul>\r\n  <li>Rough set theory digunakan untuk menangani ketidakpastian dan tidak pasti dalam data.</li>\r\n  <li>Mengidentifikasi hubungan-hubungan yang tidak pasti antara elemen-elemen dalam sebuah set data.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Expert Systems</strong>\r\n <ul>\r\n  <li>Expert systems adalah sistem berbasis pengetahuan yang dirancang untuk menyelesaikan masalah spesifik dengan tingkat kecerdasan buatan.</li>\r\n  <li>Menggunakan pengetahuan yang diambil dari ahli manusia untuk membuat keputusan atau memberikan solusi.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Hybrid Systems</strong>\r\n <ul>\r\n  <li>Menggabungkan berbagai teknik kecerdasan komputasi untuk meningkatkan kinerja dan keandalan sistem.</li>\r\n  <li>Contohnya adalah penggabungan neural networks dengan algoritma evolusi atau fuzzy logic.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Machine Learning</strong><strong>???????</strong>\r\n <ul>\r\n  <li>Machine learning merupakan bagian penting dari kecerdasan komputasi, di mana komputer dapat belajar dari data dan pengalaman untuk meningkatkan kinerja tanpa pemrograman eksplisit.</li>\r\n  <li>Termasuk dalam machine learning adalah penggunaan algoritma klasifikasi, regresi, dan clustering.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Decision Support Systems</strong>\r\n <ul>\r\n  <li>Decision support systems menggunakan kecerdasan komputasi untuk memberikan dukungan dalam proses pengambilan keputusan.</li>\r\n  <li>Membantu analisis data, mengidentifikasi tren, dan memberikan saran untuk membimbing pengambilan keputusan.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p xss=removed>Kecerdasan Komputasi mencakup berbagai paradigma dan pendekatan untuk mencapai kecerdasan dalam konteks komputasional. Dengan memanfaatkan metode-metode ini, sistem dapat menghadapi situasi yang tidak pasti, menyelesaikan masalah kompleks, dan beradaptasi dengan perubahan lingkungan atau kondisi.</p>', '<p xss=removed>Peta penelitian Kecerdasan Komputasi mencakup berbagai bidang dan topik yang menjadi fokus penelitian para ilmuwan dan peneliti. Berikut adalah beberapa arah penelitian utama dalam Kecerdasan Komputasi :</p>\r\n\r\n<ol>\r\n <li xss=removed><strong>Optimasi dan Pemecahan Masalah</strong>\r\n\r\n <ul>\r\n  <li>Algoritma evolusi dan algoritma optimisasi lainnya untuk penyelesaian masalah kompleks.</li>\r\n  <li>Pengembangan metode optimasi yang efisien dan efektif.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Machine Learning dan Deep Learning</strong>\r\n <ul>\r\n  <li>Pengembangan algoritma pembelajaran mesin yang lebih baik untuk analisis data dan prediksi.</li>\r\n  <li>Peningkatan arsitektur deep learning untuk pemahaman representasi yang lebih baik.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Neural Networks dan Jaringan Syaraf Tiruan</strong>\r\n <ul>\r\n  <li>Pengembangan model neural networks yang lebih kompleks dan adaptif.</li>\r\n  <li>Peningkatan teknik pelatihan dan pemrosesan paralel untuk jaringan syaraf tiruan.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Swarm Intelligence</strong>\r\n <ul>\r\n  <li>Pengembangan algoritma berdasarkan prinsip-prinsip swarm intelligence, seperti particle swarm optimization atau ant colony optimization.</li>\r\n  <li>Aplikasi swarm intelligence dalam optimasi, perutean, dan masalah-masalah lainnya.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Fuzzy Logic dan Sistem Fuzzy</strong>\r\n <ul>\r\n  <li>Peningkatan dalam pemodelan dan penggunaan fuzzy logic untuk penanganan ketidakpastian.</li>\r\n  <li>Integrasi fuzzy logic dalam sistem pengambilan keputusan.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Kecerdasan Komputasi Multimodal:</strong>\r\n <ul>\r\n  <li>Integrasi berbagai jenis data, termasuk teks, gambar, suara, dan video.</li>\r\n  <li>Pengembangan algoritma yang dapat memproses dan memahami informasi dari berbagai sumber modalitas.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Explainable AI (XAI)</strong>\r\n <ul>\r\n  <li>Pengembangan teknik untuk menjelaskan dan memahami keputusan yang diambil oleh model kecerdasan buatan.</li>\r\n  <li>Penelitian tentang cara membuat model kecerdasan buatan lebih interpretable.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Kecerdasan Buatan yang Berbasis Pengetahuan</strong>\r\n <ul>\r\n  <li>Pengembangan sistem berbasis pengetahuan untuk membuat keputusan yang kompleks.</li>\r\n  <li>Penerapan sistem kecerdasan buatan berbasis pengetahuan dalam berbagai industri.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Kecerdasan Komputasi Kuantum:</strong>\r\n <ul>\r\n  <li>Pemahaman dan pengembangan algoritma kecerdasan buatan yang dapat dijalankan pada komputer kuantum.</li>\r\n  <li>Penerapan konsep-konsep kuantum dalam konteks kecerdasan buatan.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Aspek Etika dan Keamanan</strong>\r\n <ul>\r\n  <li>Penelitian tentang implikasi etika dalam pengembangan dan penggunaan kecerdasan buatan.</li>\r\n  <li>Pengembangan metode untuk meningkatkan keamanan dan privasi dalam sistem kecerdasan buatan.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Penerapan Kecerdasan Komputasi dalam Berbagai Sektor</strong>\r\n <ul>\r\n  <li>Aplikasi kecerdasan komputasi dalam kesehatan, keuangan, manufaktur, transportasi, dan sektor-sektor lainnya.</li>\r\n  <li>Penelitian terapan untuk meningkatkan efisiensi dan efektivitas dalam berbagai konteks industri.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Kecerdasan Komputasi dan Interaksi Manusia</strong>\r\n <ul>\r\n  <li>Pengembangan sistem yang dapat berinteraksi dengan manusia secara alami.</li>\r\n  <li>Penggunaan kecerdasan buatan untuk meningkatkan antarmuka manusia dan sistem.</li>\r\n </ul>\r\n </li>\r\n <li xss=removed><strong>Pengembangan Model Kreatif</strong>\r\n <ul>\r\n  <li>Penelitian tentang cara mengintegrasikan unsur kreatif dalam model kecerdasan buatan.</li>\r\n  <li>Aplikasi kecerdasan buatan dalam generasi ide dan desain.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p xss=removed>Peta penelitian ini mencerminkan keragaman topik dan tren penelitian dalam Kecerdasan Komputasi, yang terus berkembang seiring dengan kemajuan teknologi dan pemahaman ilmiah.</p>', '2023-12-02 18:30:04', NULL),
(12, 'tif', 'Komputasi Sain Data', '<p xss=removed>Profil Komputasi Sains Data mencakup keterampilan, konsep, dan pendekatan yang umumnya diasosiasikan dengan praktisi dalam bidang ini. Berikut adalah beberapa aspek utama dari profil Komputasi Sains Data :</p>\r\n\r\n<ol>\r\n <li>\r\n <p xss=removed><strong>Pemahaman Statistik:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Kemampuan untuk menerapkan konsep-konsep statistik dalam analisis data.</li>\r\n  <li xss=removed>Pemahaman tentang distribusi data, pengujian hipotesis, dan regresi statistik.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Keterampilan Pemrograman:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Penguasaan bahasa pemrograman seperti Python, R, atau Julia.</li>\r\n  <li xss=removed>Kemampuan untuk mengembangkan kode untuk analisis data, pemrosesan, dan visualisasi.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Manipulasi dan Pembersihan Data:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Keterampilan dalam membersihkan dan memanipulasi data untuk mempersiapkannya untuk analisis.</li>\r\n  <li xss=removed>Pemahaman terhadap teknik-teknik seperti penggabungan data, filter, dan transformasi data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Pemodelan Statistik dan Machine Learning:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Kemampuan untuk membangun model statistik dan machine learning.</li>\r\n  <li xss=removed>Pemahaman tentang algoritma, teknik validasi model, dan pengoptimalan model.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Pengolahan dan Analisis Big Data:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pemahaman terhadap kerangka kerja big data seperti Apache Hadoop dan Apache Spark.</li>\r\n  <li xss=removed>Keterampilan dalam bekerja dengan dataset yang besar dan kompleks.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Data Visualization:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Kemampuan untuk membuat visualisasi data yang efektif dan bermakna.</li>\r\n  <li xss=removed>Pemahaman tentang alat visualisasi seperti Matplotlib, Seaborn, atau ggplot2.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Pengelolaan Proyek Data:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Keterampilan manajemen proyek untuk merencanakan, melaksanakan, dan mengevaluasi proyek data.</li>\r\n  <li xss=removed>Pemahaman tentang siklus hidup data dari pengumpulan hingga implementasi model.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Komunikasi Efektif:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Kemampuan untuk menjelaskan hasil analisis data secara jelas dan komprehensif kepada pemangku kepentingan yang mungkin tidak memiliki latar belakang teknis.</li>\r\n  <li xss=removed>Keterampilan presentasi dan dokumentasi yang baik.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Keamanan Data dan Etika:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Kesadaran tentang masalah keamanan data dan privasi.</li>\r\n  <li xss=removed>Pemahaman tentang etika dalam pengumpulan, pengolahan, dan penggunaan data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Pengembangan Bisnis dan Keahlian Domain:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pemahaman tentang konteks bisnis dan domain di mana solusi data diterapkan.</li>\r\n  <li xss=removed>Kemampuan untuk berkomunikasi dengan pemangku kepentingan non-teknis.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Keterampilan SQL:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Kemampuan untuk mengambil dan memanipulasi data menggunakan SQL.</li>\r\n  <li xss=removed>Pemahaman tentang struktur basis data relasional.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Pemahaman Model Data dan Arsitektur:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pemahaman tentang model data dan arsitektur sistem penyimpanan data.</li>\r\n  <li xss=removed>Kemampuan untuk merancang skema basis data yang efisien.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Penelitian dan Inovasi:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Kemampuan untuk terus belajar dan mengikuti perkembangan terbaru dalam bidang Komputasi Sains Data.</li>\r\n  <li xss=removed>Kreativitas dan kemampuan untuk mengidentifikasi solusi inovatif.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p xss=removed>Profil ini mencerminkan sifat multidisipliner dari Komputasi Sains Data, yang melibatkan keterampilan teknis, pemahaman bisnis, dan kemampuan komunikasi yang efektif. Selain itu, praktisi dalam bidang ini juga diharapkan untuk selalu memperbarui dan mengembangkan keterampilan mereka seiring dengan perkembangan teknologi.</p>', '<p xss=removed>Peta penelitian Komputasi Sains Data mencakup berbagai area dan topik yang menjadi fokus penelitian dalam bidang ini. Berikut adalah beberapa arah penelitian utama dalam Komputasi Sains Data :</p>\r\n\r\n<ol>\r\n <li>\r\n <p xss=removed><strong>Pengembangan Algoritma Pemrosesan Data:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan algoritma efisien untuk pembersihan, transformasi, dan manipulasi data.</li>\r\n  <li xss=removed>Algoritma untuk mengatasi ketidakpastian dan kehilangan data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Analisis dan Model Machine Learning yang Skalabel:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan model machine learning yang dapat mengatasi permasalahan skala besar.</li>\r\n  <li xss=removed>Algoritma machine learning yang dapat bekerja dengan data streaming atau real-time.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Analisis dan Pengolahan Big Data:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Metode dan teknik pengolahan big data untuk mengekstrak informasi berharga.</li>\r\n  <li xss=removed>Algoritma dan infrastruktur untuk mengelola dan menganalisis data dalam skala besar.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Interpretability dan Explainability:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan teknik untuk menjelaskan dan memahami keputusan yang dihasilkan oleh model machine learning.</li>\r\n  <li xss=removed>Metode untuk meningkatkan interpretabilitas model kompleks.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Pengolahan Data Temporal dan Spasial:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan teknik untuk mengatasi data temporal dan spasial.</li>\r\n  <li xss=removed>Model dan algoritma untuk analisis data deret waktu dan data spasial.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Keamanan Data dan Privasi:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Metode dan alat untuk menjaga keamanan dan privasi data.</li>\r\n  <li xss=removed>Pengembangan teknik anonimisasi dan enkripsi yang efektif.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Transfer Learning dan Domain Adaptation:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan teknik untuk mentransfer pengetahuan antar domain.</li>\r\n  <li xss=removed>Algoritma yang dapat beradaptasi dengan perubahan dalam distribusi data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Analisis Sentimen dan NLP (Natural Language Processing):</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan model untuk analisis sentimen dan pemahaman bahasa alami.</li>\r\n  <li xss=removed>Integrasi analisis sentimen dengan sistem NLP untuk memahami opini pengguna.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Optimasi Model Machine Learning:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Metode untuk mengoptimalkan parameter model machine learning.</li>\r\n  <li xss=removed>Pengembangan algoritma pencarian hyperparameter yang efisien.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Sistem Rekomendasi yang Personalisasi:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan sistem rekomendasi yang dapat memberikan rekomendasi yang lebih personal dan akurat.</li>\r\n  <li xss=removed>Model yang memahami preferensi pengguna secara dinamis.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Visualisasi Data Interaktif:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan alat visualisasi data yang interaktif.</li>\r\n  <li xss=removed>Penggunaan teknologi VR (Virtual Reality) atau AR (Augmented Reality) untuk visualisasi data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Analisis dan Prediksi Anomali:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan model untuk mendeteksi anomali dalam data.</li>\r\n  <li xss=removed>Algoritma untuk mengidentifikasi pola tidak normal atau perilaku yang mencurigakan.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Pengembangan Platform dan Alat Sains Data:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Pengembangan platform dan alat yang mendukung seluruh siklus hidup data.</li>\r\n  <li xss=removed>Alat untuk kolaborasi tim dan manajemen proyek data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p xss=removed><strong>Penerapan Sains Data dalam Konteks Industri Khusus:</strong></p>\r\n\r\n <ul>\r\n  <li xss=removed>Aplikasi Sains Data dalam sektor-sektor industri seperti kesehatan, keuangan, manufaktur, dan lainnya.</li>\r\n  <li xss=removed>Penelitian terapan untuk menyelesaikan tantangan spesifik dalam berbagai domain.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p xss=removed>Peta penelitian ini mencerminkan kompleksitas dan keragaman penelitian dalam Komputasi Sains Data, yang mencakup aspek-aspek teknis, metodologis, dan aplikatif. Penelitian ini terus berlanjut seiring dengan perkembangan teknologi dan permintaan untuk pemahaman yang lebih baik terhadap data yang semakin kompleks.</p>', '2023-12-02 18:33:56', NULL),
(13, 'tif', 'Rekayasa Perangkat Lunak', '<p>Bidang minat dalam rekayasa perangkat lunak dapat mencakup berbagai hal, tergantung pada minat, keterampilan, dan tujuan individu. Berikut adalah beberapa profil bidang minat yang umum di dalam rekayasa perangkat lunak:</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Pengembangan Perangkat Lunak Aplikasi:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterampilan: Pemrograman (Java, Python, C++, dll.), Desain antarmuka pengguna (UI/UX), Pengujian perangkat lunak.</li>\r\n  <li>Penerapan: Membangun aplikasi desktop, web, atau mobile.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Rekayasa Perangkat Lunak Embedded:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterampilan: Pemrograman bahasa rendah (C, Assembly), Desain sistem terdistribusi, Pengembangan perangkat keras.</li>\r\n  <li>Penerapan: Sistem tertanam dalam perangkat keras seperti mikrokontroler, sistem kendali otomatis, Internet of Things (IoT).</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengembangan Perangkat Lunak Berbasis Cloud:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterampilan: Komputasi awan, Pemrograman web (Node.js, Ruby on Rails), Penyimpanan awan, Keamanan awan.</li>\r\n  <li>Penerapan: Membangun dan mengelola aplikasi yang berjalan di infrastruktur cloud.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Analisis Data dan Ilmu Data:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterampilan: Pengolahan data, Statistik, Pemahaman machine learning, Bahasa pemrograman untuk analisis data (Python, R).</li>\r\n  <li>Penerapan: Pengembangan algoritma analisis data, pembuatan model machine learning, dan visualisasi data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Keamanan Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterampilan: Keamanan jaringan, Pengujian penetrasi, Kriptografi, Pemahaman kerentanan keamanan.</li>\r\n  <li>Penerapan: Meningkatkan keamanan aplikasi dan sistem, mencegah serangan siber.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Manajemen Proyek Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterampilan: Manajemen proyek, Komunikasi, Pemahaman proses pengembangan perangkat lunak.</li>\r\n  <li>Penerapan: Memimpin tim pengembangan, merencanakan dan mengelola siklus hidup proyek.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Teknologi Web dan Pengembangan Front-end:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterampilan: Pemrograman web (HTML, CSS, JavaScript), Framework web (React, Angular), Pengujian lintas browser.</li>\r\n  <li>Penerapan: Membangun antarmuka pengguna web yang responsif dan menarik.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Profil bidang minat dalam rekayasa perangkat lunak dapat bervariasi sesuai dengan minat pribadi dan perkembangan teknologi. Penting untuk terus memperbarui keterampilan dan pengetahuan sesuai dengan perkembangan industri untuk tetap relevan dalam dunia rekayasa perangkat lunak.</p>', '<p>Pemilihan topik penelitian dalam bidang rekayasa perangkat lunak sangat bergantung pada minat dan tujuan spesifik peneliti. Namun, berikut adalah beberapa peta penelitian dalam bidang rekayasa perangkat lunak yang mungkin dapat menjadi sumber inspirasi:</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Metodologi Pengembangan Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Pembandingan metodologi pengembangan perangkat lunak seperti Scrum, Kanban, dan waterfall.</li>\r\n  <li>Penerapan metodologi Agile dalam pengembangan perangkat lunak kritis.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Keamanan Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Analisis keamanan perangkat lunak untuk mencegah serangan cyber.</li>\r\n  <li>Pengembangan metode enkripsi yang lebih kuat.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengujian Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Pengembangan strategi pengujian otomatis yang efisien.</li>\r\n  <li>Penerapan pengujian fungsional dan non-fungsional pada perangkat lunak real-time.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Manajemen Proyek Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Studi kasus tentang keberhasilan dan kegagalan manajemen proyek perangkat lunak.</li>\r\n  <li>Perbaikan estimasi biaya dan waktu dalam proyek pengembangan perangkat lunak.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengembangan Aplikasi Mobile:</strong></p>\r\n\r\n <ul>\r\n  <li>Optimasi kinerja aplikasi mobile.</li>\r\n  <li>Keamanan dalam pengembangan aplikasi mobile.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengembangan Perangkat Lunak Berbasis Kecerdasan Buatan:</strong></p>\r\n\r\n <ul>\r\n  <li>Penerapan machine learning dalam pengembangan perangkat lunak.</li>\r\n  <li>Penggunaan teknologi AI untuk meningkatkan pengalaman pengguna.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Internet of Things (IoT) dan Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Keamanan dan privasi dalam aplikasi IoT.</li>\r\n  <li>Integrasi perangkat lunak untuk pengembangan solusi IoT.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengelolaan Konfigurasi dan Versi:</strong></p>\r\n\r\n <ul>\r\n  <li>Penerapan sistem pengelolaan versi yang efektif.</li>\r\n  <li>Strategi pengelolaan konfigurasi untuk proyek besar.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengembangan Perangkat Lunak Open Source:</strong></p>\r\n\r\n <ul>\r\n  <li>Keterlibatan komunitas dalam pengembangan perangkat lunak open source.</li>\r\n  <li>Analisis dampak ekonomi dan teknis dari proyek open source terkenal.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan Paralel dan Distribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Pengembangan perangkat lunak yang mendukung pemrosesan paralel.</li>\r\n  <li>Desain aplikasi untuk lingkungan komputasi terdistribusi.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Interaksi Manusia dan Komputer:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian antarmuka pengguna yang intuitif.</li>\r\n  <li>Analisis dampak desain UX terhadap penerimaan pengguna.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Analisis Big Data dan Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Pemrosesan dan analisis data skala besar.</li>\r\n  <li>Algoritma dan teknik pengembangan perangkat lunak untuk big data.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Pastikan untuk memilih topik yang sesuai dengan minat Anda dan relevan dengan perkembangan terkini dalam industri rekayasa perangkat lunak. Selain itu, perhatikan bahwa penelitian dalam bidang ini sering kali melibatkan kerjasama dan pertukaran ide dengan komunitas ilmiah dan industri.</p>', '2023-12-07 06:10:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL,
  `mutuid` int(11) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `namadokumen` varchar(255) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(14) NOT NULL,
  `bidminatid` int(11) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `penelitian` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nip`, `bidminatid`, `kodeprodi`, `nama`, `email`, `foto`, `penelitian`, `create`, `update`) VALUES
('19730520200212', 12, 'tif', 'Mula\'ab, S.Si., M.Kom.', 'mulaab@trunojoyo.ac.id', '20231202184127656b17e7946c8.jpg', '<p>Penelitian penelitian 3</p>', '2023-12-02 18:41:27', NULL),
('19760627200801', 11, 'tif', 'Firdaus Solihin, S.Kom., M.Kom.', 'firdaus@trunojoyo.ac.id', '20231202184006656b179683a53.jpg', '<p>Penelitian 2</p>', '2023-12-02 18:40:06', NULL),
('19830305200604', 10, 'tif', 'Fika Hastarita Rachman, S.T., M.Eng', 'fika@trunojoyo.ac.id', '20231202183746656b170a78afd.jpg', '<p>Penelitian A</p>', '2023-12-02 18:37:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyalab`
--

CREATE TABLE `karyalab` (
  `id` int(11) NOT NULL,
  `kodelab` varchar(10) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `namakarya` varchar(255) DEFAULT NULL,
  `deskripsikarya` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `karyalab`
--

INSERT INTO `karyalab` (`id`, `kodelab`, `kodeprodi`, `namakarya`, `deskripsikarya`, `foto`, `create`, `update`) VALUES
(6, 'lab-003', 'tif', 'Pengembangan asisten virtual yang dapat merespons perintah suara dan memberikan informasi atau melakukan tugas tertentu', '<p>Pengembangan asisten virtual yang dapat merespons perintah suara dan menjalankan tugas tertentu melibatkan kombinasi teknologi pemrosesan suara, pemrosesan bahasa alami (NLP), dan integrasi dengan berbagai layanan atau aplikasi. Berikut adalah langkah-langkah umum yang terlibat dalam proyek seperti ini :</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Rekam Suara:</strong></p>\r\n\r\n <ul>\r\n  <li>Mengintegrasikan fitur perekaman suara ke dalam asisten virtual untuk mendengarkan perintah pengguna.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan Suara:</strong></p>\r\n\r\n <ul>\r\n  <li>Menggunakan teknik pemrosesan suara untuk mengkonversi sinyal suara menjadi teks yang dapat dimengerti oleh komputer.</li>\r\n  <li>Penggunaan model pemrosesan suara seperti Automatic Speech Recognition (ASR) untuk meningkatkan akurasi transkripsi.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan Bahasa Alami (NLP):</strong></p>\r\n\r\n <ul>\r\n  <li>Menerapkan pemrosesan bahasa alami untuk memahami perintah atau pertanyaan yang diucapkan oleh pengguna.</li>\r\n  <li>Menggunakan model bahasa alami untuk mengekstrak entitas, klasifikasi perintah, dan memahami niat pengguna.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemahaman Konteks:</strong></p>\r\n\r\n <ul>\r\n  <li>Membangun kemampuan asisten untuk memahami konteks percakapan, termasuk mengingat pertanyaan atau perintah sebelumnya untuk menjalankan tugas lebih lanjut.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Integrasi dengan Layanan dan Aplikasi:</strong></p>\r\n\r\n <ul>\r\n  <li>Menghubungkan asisten virtual dengan berbagai layanan atau aplikasi yang dapat diakses secara otomatis.</li>\r\n  <li>Penggunaan API (Application Programming Interface) untuk mengintegrasikan dengan layanan eksternal seperti cuaca, berita, kalender, atau aplikasi perintah dan kendali rumah pintar.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengembangan Database Pengetahuan:</strong></p>\r\n\r\n <ul>\r\n  <li>Membangun database pengetahuan yang dapat diakses oleh asisten untuk memberikan jawaban akurat atau informasi yang relevan.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Sistem Pemilihan Tugas:</strong></p>\r\n\r\n <ul>\r\n  <li>Mengembangkan mekanisme untuk menentukan tugas yang sesuai berdasarkan perintah pengguna.</li>\r\n  <li>Pemilihan tugas ini dapat melibatkan logika pengambilan keputusan atau pemilihan dari berbagai opsi tugas yang telah diprogram sebelumnya.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Respons dan Interaksi Pengguna:</strong></p>\r\n\r\n <ul>\r\n  <li>Merancang antarmuka respons yang ramah pengguna dan informatif.</li>\r\n  <li>Memberikan respons suara atau teks yang merespons perintah atau pertanyaan pengguna dengan baik.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pelatihan dan Pembaruan Model:</strong></p>\r\n\r\n <ul>\r\n  <li>Melakukan pelatihan berkala menggunakan data baru untuk meningkatkan pemahaman dan respons asisten terhadap variasi perintah dan konteks.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Keamanan dan Privasi:</strong></p>\r\n\r\n <ul>\r\n  <li>Menyertakan fitur keamanan untuk melindungi data pengguna dan menjaga privasi mereka.</li>\r\n  <li>Mematuhi standar keamanan dan privasi yang berlaku.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Uji Pengguna (User Testing):</strong></p>\r\n\r\n <ul>\r\n  <li>Melakukan uji pengguna untuk mengevaluasi kinerja dan pengalaman pengguna asisten virtual.</li>\r\n  <li>Mengumpulkan umpan balik pengguna untuk meningkatkan kualitas dan respons asisten.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Proyek pengembangan asisten virtual semacam ini memerlukan kolaborasi antara ahli pemrosesan suara, ahli NLP, dan pengembang perangkat lunak. Selain itu, perlu memperhatikan aspek-aspek etika dan privasi dalam penggunaan data pengguna.</p>', '2023120619220165706769d71a9.jpg', '2023-12-06 19:22:01', '2023-12-06 19:39:01'),
(7, 'lab-003', 'tif', 'Aplikasi VR untuk tur virtual ke museum seni dengan penjelasan audio dan visual tentang karya seni', '<p>Pengembangan aplikasi VR untuk tur virtual ke museum seni dengan penjelasan audio dan visual tentang karya seni melibatkan integrasi teknologi VR dengan konten multimedia seperti gambar, audio, dan teks. Berikut adalah langkah-langkah umum yang terlibat dalam proyek seperti ini :</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Perencanaan Konten:</strong></p>\r\n\r\n <ul>\r\n  <li>Identifikasi karya seni yang akan dimasukkan dalam tur virtual.</li>\r\n  <li>Rencanakan struktur tur dan konten audiovisual untuk setiap karya seni.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemilihan Platform VR:</strong></p>\r\n\r\n <ul>\r\n  <li>Pilih platform VR yang sesuai dengan kebutuhan aplikasi Anda (misalnya, Oculus Rift, HTC Vive, atau platform VR mobile seperti Google Cardboard atau Oculus Quest).</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengembangan Konten Multimedia:</strong></p>\r\n\r\n <ul>\r\n  <li>Persiapkan konten multimedia untuk setiap karya seni, termasuk gambar berkualitas tinggi, rekaman audio untuk penjelasan, dan teks yang memberikan informasi lebih lanjut.</li>\r\n  <li>Gunakan teknik fotogrametri atau model 3D jika ingin memasukkan representasi 3D dari karya seni tersebut.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengembangan Aplikasi VR:</strong></p>\r\n\r\n <ul>\r\n  <li>Pilih lingkungan pengembangan VR seperti Unity atau Unreal Engine.</li>\r\n  <li>Implementasikan tur virtual dan fungsionalitas interaktif menggunakan bahasa pemrograman dan alat pengembangan yang sesuai.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Desain Antarmuka Pengguna (UI):</strong></p>\r\n\r\n <ul>\r\n  <li>Rancang antarmuka pengguna VR yang ramah pengguna, mudah dinavigasi, dan memberikan akses ke konten multimedia.</li>\r\n  <li>Pastikan tombol atau kontrol interaksi VR digunakan dengan baik untuk memberikan pengalaman pengguna yang imersif.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Integrasi Suara:</strong></p>\r\n\r\n <ul>\r\n  <li>Implementasikan penjelasan audio untuk setiap karya seni.</li>\r\n  <li>Pastikan bahwa suara diaktifkan ketika pengguna mengamati karya seni tertentu dan memberikan kontrol suara kepada pengguna.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Implementasi Visual:</strong></p>\r\n\r\n <ul>\r\n  <li>Sajikan gambar atau representasi visual berkualitas tinggi dari setiap karya seni.</li>\r\n  <li>Pastikan bahwa visualisasi VR memberikan pengalaman mendalam yang memungkinkan pengguna memeriksa detail-detail karya seni.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Navigasi dan Interaksi:</strong></p>\r\n\r\n <ul>\r\n  <li>Implementasikan navigasi yang mudah dan intuitif melalui tur virtual.</li>\r\n  <li>Tambahkan fungsi untuk memfokuskan karya seni, memutar pandangan, dan mengakses informasi tambahan.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Uji Coba dan Debugging:</strong></p>\r\n\r\n <ul>\r\n  <li>Lakukan uji coba menyeluruh untuk memastikan bahwa aplikasi VR berjalan dengan baik dan memberikan pengalaman tanpa gangguan.</li>\r\n  <li>Perbaiki bug dan tingkatkan kinerja jika diperlukan.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Peluncuran Aplikasi:</strong></p>\r\n\r\n <ul>\r\n  <li>Siapkan aplikasi untuk peluncuran di platform VR yang dituju.</li>\r\n  <li>Lakukan promosi dan informasikan pengguna tentang ketersediaan aplikasi VR.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemeliharaan dan Pembaruan:</strong></p>\r\n\r\n <ul>\r\n  <li>Berikan pemeliharaan terhadap aplikasi dan berikan pembaruan berkala dengan menambahkan karya seni baru atau meningkatkan konten multimedia.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Dokumentasi dan Bantuan:</strong></p>\r\n\r\n <ul>\r\n  <li>Sertakan dokumentasi dan bantuan untuk memandu pengguna dalam menggunakan aplikasi VR dengan efektif.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Penting untuk bekerja sama dengan ahli seni, kurator museum, dan pengembang konten multimedia untuk memastikan bahwa aplikasi memberikan pengalaman yang mendalam dan informatif tentang karya seni yang dipamerkan.</p>', '2023120619403665706bc4e5774.jpg', '2023-12-06 19:40:36', NULL),
(8, 'lab-001', 'tif', 'Pengembangan sistem yang dapat mendeteksi kegagalan pada satu atau beberapa node dan secara otomatis mengalihkan beban kerja ke node yang masih berfungsi', '<p>Pengembangan sistem yang dapat mendeteksi kegagalan pada satu atau beberapa node dan secara otomatis mengalihkan beban kerja ke node yang masih berfungsi merupakan bagian penting dari desain sistem terdistribusi yang handal dan tahan terhadap kegagalan. Berikut adalah langkah-langkah umum yang dapat diambil untuk mengembangkan sistem semacam itu:</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Monitor Kesehatan Node:</strong></p>\r\n\r\n <ul>\r\n  <li>Implementasikan mekanisme pemantauan kesehatan (health monitoring) untuk setiap node dalam sistem terdistribusi.</li>\r\n  <li>Gunakan alat atau protokol seperti Heartbeat untuk secara teratur memeriksa keadaan kesehatan setiap node.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Tetapkan Kriteria Kegagalan:</strong></p>\r\n\r\n <ul>\r\n  <li>Tentukan kriteria yang menandakan kegagalan pada node. Misalnya, hilangnya koneksi, waktu tanggapan yang lambat, atau kegagalan pada layanan tertentu.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Sistem Pendeteksian Kegagalan:</strong></p>\r\n\r\n <ul>\r\n  <li>Kembangkan sistem pendeteksian kegagalan yang dapat mengenali keadaan kesehatan yang tidak normal pada node.</li>\r\n  <li>Gunakan aturan atau model prediktif untuk memutuskan apakah sebuah node dianggap \"gagal\".</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Algoritma Penentuan Pergantian Node:</strong></p>\r\n\r\n <ul>\r\n  <li>Implementasikan algoritma untuk menentukan node pengganti yang akan mengambil alih beban kerja dari node yang gagal.</li>\r\n  <li>Pertimbangkan faktor seperti kecepatan respons, ketersediaan sumber daya, dan jarak geografis saat memilih node pengganti.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Sistem Pengalihan Beban Kerja:</strong></p>\r\n\r\n <ul>\r\n  <li>Kembangkan sistem pengalihan beban kerja yang dapat secara otomatis mengarahkan beban kerja dari node yang gagal ke node pengganti.</li>\r\n  <li>Gunakan mekanisme seperti load balancing untuk memastikan distribusi yang merata dan efisien.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Manajemen Status Distribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Tetapkan dan kelola status distribusi untuk setiap node, yang mencerminkan kesehatan dan status beban kerja aktual.</li>\r\n  <li>Gunakan mekanisme komunikasi terdistribusi untuk menginformasikan node lain tentang perubahan status.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemulihan Pada Kegagalan Node:</strong></p>\r\n\r\n <ul>\r\n  <li>Implementasikan strategi pemulihan otomatis untuk node yang gagal.</li>\r\n  <li>Pastikan bahwa proses pemulihan tidak hanya memulihkan beban kerja, tetapi juga memperbaiki atau mengisolasi penyebab kegagalan jika memungkinkan.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemulihan Manual:</strong></p>\r\n\r\n <ul>\r\n  <li>Sediakan antarmuka atau alat untuk pemulihan manual jika diperlukan, memberikan kontrol tambahan kepada administrator sistem.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Uji Pengujian dan Simulasi Kegagalan:</strong></p>\r\n\r\n <ul>\r\n  <li>Lakukan uji coba dan simulasi kegagalan untuk memastikan bahwa sistem benar-benar dapat mendeteksi kegagalan, mengaktifkan pengalihan, dan melakukan pemulihan seperti yang diharapkan.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Dokumentasi dan Pelatihan:</strong></p>\r\n\r\n <ul>\r\n  <li>Sertakan dokumentasi yang jelas tentang cara kerja sistem deteksi kegagalan dan pengalihan beban kerja.</li>\r\n  <li>Lakukan pelatihan untuk administrator atau pengguna yang bertanggung jawab terhadap pemeliharaan sistem.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Penting untuk memperhatikan bahwa setiap implementasi akan bergantung pada spesifikasi sistem, bahasa pemrograman, dan platform yang digunakan. Langkah-langkah di atas memberikan dasar umum untuk mengembangkan sistem yang tahan terhadap kegagalan dalam lingkungan terdistribusi.</p>', '2023120619435065706c869e73c.jpg', '2023-12-06 19:43:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyapenelitian`
--

CREATE TABLE `karyapenelitian` (
  `id` int(11) NOT NULL,
  `nip` varchar(14) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `katpenelitianid` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `sumberdana` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `karyapenelitian`
--

INSERT INTO `karyapenelitian` (`id`, `nip`, `kodeprodi`, `katpenelitianid`, `judul`, `sumberdana`, `deskripsi`, `foto`, `create`, `update`) VALUES
(6, '19730520200212', 'tif', 8, 'Analisis dan Peningkatan Keamanan Virtualisasi dalam Lingkungan Cloud', 'Kampus', '<p>Penelitian ini bertujuan untuk menganalisis kerentanan keamanan yang terkait dengan teknologi virtualisasi dalam lingkungan cloud. Penelitian tersebut mencakup evaluasi risiko keamanan seperti serangan terhadap mesin virtual, eskalasi hak akses, dan isolasi yang tidak memadai antara mesin virtual. Selain itu, penelitian ini mengusulkan langkah-langkah peningkatan keamanan, seperti pengaturan hak akses yang lebih ketat, penggunaan teknologi enkripsi, dan implementasi monitoring keamanan yang lebih canggih.</p>', '2023120620501365707c15604e4.jpg', '2023-12-06 20:50:13', NULL),
(7, '19760627200801', 'tif', 5, 'Implementasi dan Analisis Keamanan Algoritma Enkripsi Quantum-resistant dalam Komunikasi Internet', 'Pemerintah', '<p>Penelitian ini berfokus pada implementasi dan analisis keamanan algoritma enkripsi yang tahan terhadap serangan kuantum. Seiring dengan perkembangan teknologi kuantum, risiko terhadap algoritma enkripsi klasik meningkat. Penelitian ini mencakup pemilihan, implementasi, dan evaluasi keamanan algoritma enkripsi yang dianggap tahan terhadap serangan kuantum, seperti algoritma berbasis kisi-kisi atau kode koreksi kesalahan.</p>\r\n\r\n<p>Selain itu, penelitian ini melakukan analisis terhadap keamanan algoritma tersebut dalam konteks aplikasi praktis, khususnya dalam komunikasi internet. Dalam penelitian ini, para peneliti mengevaluasi kinerja algoritma, overhead yang terkait dengan implementasi mereka, serta resistansi terhadap serangan kriptoanalisis kuantum yang mungkin terjadi.</p>\r\n\r\n<p>Penelitian semacam ini sangat relevan karena mengatasi tantangan baru dalam domain keamanan informasi yang muncul seiring perkembangan teknologi. Implementasi algoritma enkripsi yang tahan terhadap komputasi kuantum menjadi esensial dalam menghadapi potensi ancaman masa depan terhadap keamanan data.</p>', '2023120620530465707cc067cfc.jpg', '2023-12-06 20:53:04', NULL),
(8, '19730520200212', 'tif', 9, 'Analisis dan Peningkatan Kinerja Arsitektur Jaringan Terdistribusi pada Lingkungan Cloud Skala Besar', 'Pemerintah', '<p>Penelitian ini membahas analisis dan peningkatan kinerja arsitektur jaringan terdistribusi dalam skenario lingkungan cloud skala besar. Fokus utama penelitian adalah memahami tantangan dan peluang yang terkait dengan manajemen jaringan dan alokasi sumber daya dalam infrastruktur cloud yang melibatkan ribuan atau bahkan jutaan server.</p>\r\n\r\n<p>Para peneliti melakukan pemodelan dan simulasi berbasis data riil untuk mengevaluasi kinerja arsitektur jaringan terdistribusi dalam lingkungan cloud tersebut. Hasil analisis melibatkan identifikasi bottleneck, latensi, dan optimasi beban kerja untuk memastikan distribusi sumber daya yang efisien.</p>\r\n\r\n<p>Selain itu, penelitian ini mencakup pengembangan atau penyesuaian protokol jaringan terdistribusi yang dapat meningkatkan throughput, mengurangi latensi, dan memastikan keandalan dalam skenario cloud yang dinamis.</p>\r\n\r\n<p>Penelitian semacam ini memiliki implikasi signifikan dalam mengoptimalkan kinerja infrastruktur cloud, yang penting untuk memastikan pengalaman pengguna yang responsif, efisiensi sumber daya yang maksimal, dan skalabilitas yang baik saat menghadapi pertumbuhan dinamis permintaan.</p>', '2023120620551265707d40d18a3.jpg', '2023-12-06 20:55:12', NULL),
(9, '19730520200212', 'tif', 8, 'Analisis Keamanan Multi-Tenant Isolation dalam Infrastruktur Cloud: Studi Kasus pada Layanan IaaS', 'Kampus', '<p>Penelitian ini memfokuskan pada aspek keamanan dalam lingkungan cloud, khususnya pada isolasi multi-tenant pada layanan Infrastruktur sebagai Layanan (IaaS). Isolasi multi-tenant menjadi kritis karena banyak pelanggan yang menggunakan infrastruktur yang sama dalam lingkungan cloud. Penelitian ini bertujuan untuk menyelidiki dan meningkatkan tingkat isolasi antar-penyewa (tenant) guna mengatasi potensi risiko keamanan.</p>\r\n\r\n<p>Para peneliti melakukan analisis menyeluruh terhadap implementasi isolasi multi-tenant di platform cloud terkemuka. Melibatkan serangkaian uji penetrasi dan evaluasi keamanan, penelitian ini mengidentifikasi celah atau potensi kerentanan yang dapat dieksploitasi di tingkat penyewa, serta mengusulkan solusi atau perbaikan keamanan.</p>\r\n\r\n<p>Hasil penelitian ini dapat mencakup rekomendasi praktis untuk penyedia layanan cloud dalam meningkatkan keamanan isolasi multi-tenant, serta memberikan pemahaman lebih mendalam bagi pelanggan cloud tentang risiko dan langkah-langkah pengamanan yang diperlukan.</p>\r\n\r\n<p>Penelitian semacam ini sangat relevan karena keamanan multi-tenant merupakan isu sentral dalam lingkungan cloud, dan pemahaman yang lebih baik tentang potensi risiko dan strategi mitigasi dapat membantu mengembangkan lingkungan cloud yang lebih aman.</p>', '2023120620570865707db48f84e.jpg', '2023-12-06 20:57:08', NULL),
(10, '19760627200801', 'tif', 6, 'Analisis Keamanan Jaringan Wireless Menggunakan Protokol WPA3: Studi Kasus pada Lingkungan Perusahaan', 'kampus', '<p>Penelitian ini fokus pada keamanan jaringan nirkabel dengan menganalisis implementasi dan keefektifan protokol keamanan WPA3. Protokol WPA3 diperkenalkan sebagai standar keamanan terbaru untuk melindungi jaringan nirkabel dari serangan terkini, menggantikan WPA2.</p>\r\n\r\n<p>Para peneliti melakukan evaluasi keamanan melibatkan serangkaian uji penetrasi dan analisis risiko pada jaringan nirkabel yang diimplementasikan di lingkungan perusahaan. Mereka memeriksa kelemahan potensial, celah keamanan, dan kemungkinan serangan terhadap protokol WPA3.</p>\r\n\r\n<p>Hasil penelitian ini mencakup temuan keamanan yang dapat digunakan untuk meningkatkan konfigurasi jaringan nirkabel, serta rekomendasi untuk penerapan praktik keamanan terbaik dalam lingkungan perusahaan yang menggunakan protokol WPA3. Selain itu, penelitian ini dapat menyajikan pemahaman lebih dalam tentang tingkat keamanan yang dapat diandalkan dari protokol ini.</p>\r\n\r\n<p>Penelitian semacam ini penting karena jaringan nirkabel merupakan bagian kritis dari infrastruktur IT modern, dan pemahaman mendalam tentang keamanan protokol seperti WPA3 membantu organisasi melindungi data sensitif dan merespons ancaman keamanan terkini.</p>', '2023120620594165707e4d2e6b0.png', '2023-12-06 20:59:41', NULL),
(11, '19760627200801', 'tif', 6, 'Analisis Keamanan Jaringan SDN (Software-Defined Networking) dalam Lingkungan Korporat', 'Pemerintah', '<p>Penelitian ini bertujuan untuk mengevaluasi keamanan jaringan yang diimplementasikan dengan menggunakan paradigma Software-Defined Networking (SDN) di lingkungan korporat. SDN menghadirkan fleksibilitas yang tinggi dalam mengelola dan mengkonfigurasi jaringan, tetapi juga memunculkan potensi risiko keamanan baru.</p>\r\n\r\n<p>Penelitian ini melibatkan analisis mendalam terhadap keamanan SDN, termasuk identifikasi potensi serangan terhadap kontroler SDN, isolasi penyewa (tenant) dalam lingkungan multi-tenant, dan ancaman yang terkait dengan protokol komunikasi SDN. Para peneliti juga melakukan uji penetrasi untuk mengevaluasi kekuatan dan kelemahan keamanan implementasi SDN dalam skenario keamanan korporat yang realistis.</p>\r\n\r\n<p>Hasil penelitian ini memberikan wawasan yang berharga tentang tantangan keamanan yang mungkin dihadapi oleh organisasi yang menerapkan SDN. Selain itu, penelitian ini dapat menghasilkan rekomendasi keamanan dan solusi mitigasi untuk membantu organisasi melindungi jaringan SDN mereka dari potensi serangan.</p>\r\n\r\n<p>Penelitian semacam ini penting karena SDN menjadi semakin populer dalam lingkungan korporat, dan pemahaman mendalam tentang keamanan SDN adalah kunci untuk memastikan integritas, kerahasiaan, dan ketersediaan layanan jaringan.</p>', '2023120621012065707eb085808.jpg', '2023-12-06 21:01:20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyapengabdian`
--

CREATE TABLE `karyapengabdian` (
  `id` int(11) NOT NULL,
  `nip` varchar(14) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `katpengabdianid` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `sumberdana` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `katjabatan`
--

CREATE TABLE `katjabatan` (
  `kodejabatan` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL,
  `kodeprodi` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `katlab`
--

CREATE TABLE `katlab` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `keterangan` tinytext DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `katlab`
--

INSERT INTO `katlab` (`id`, `kategori`, `keterangan`, `create`, `update`) VALUES
(5, 'Lab A', 'Laboratorium A', '2023-12-06 18:56:31', NULL),
(6, 'Lab B', 'Laboratorium B', '2023-12-06 18:56:45', NULL),
(7, 'Lab C', 'Laboratorium C', '2023-12-06 18:56:58', NULL),
(8, 'Lab D', 'Laboratorium D', '2023-12-06 18:57:10', NULL),
(9, 'Lab E', 'Laboratorium E', '2023-12-06 18:57:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `katpenelitian`
--

CREATE TABLE `katpenelitian` (
  `id` int(11) NOT NULL,
  `namakatpen` varchar(100) DEFAULT NULL,
  `namasubkatpen` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `katpenelitian`
--

INSERT INTO `katpenelitian` (`id`, `namakatpen`, `namasubkatpen`, `deskripsi`, `create`, `update`) VALUES
(5, 'Keamanan Informasi', 'Kriptografi', 'Pengembangan algoritma enkripsi dan dekripsi dan analisis kekuatan keamanan algoritma kriptografi.', '2023-12-06 20:38:24', NULL),
(6, 'Keamanan Informasi', 'Keamanan Jaringan', 'Pengembangan sistem deteksi intrusi (IDS) dan analisis dan pencegahan serangan siber.', '2023-12-06 20:38:44', '2023-12-06 20:39:16'),
(7, 'Cloud Computing', 'Alokasi Sumber Daya Cloud', 'Strategi alokasi sumber daya yang efisien dan manajemen beban kerja dalam lingkungan cloud.', '2023-12-06 20:40:03', '2023-12-06 20:41:54'),
(8, 'Cloud Computing', 'Keamanan Cloud', 'Enkripsi data dalam penyimpanan cloud dan keamanan virtualisasi dan isolasi tenant.', '2023-12-06 20:40:12', '2023-12-06 20:42:42'),
(9, 'Cloud Computing', 'Jaringan dan Arsitektur Cloud', 'Desain arsitektur cloud yang skalabel dan Pengembangan teknologi jaringan terdistribusi.', '2023-12-06 20:40:24', '2023-12-06 20:43:07'),
(10, 'Sistem Terdistribusi', 'Pengembangan Aplikasi Terdistribusi', 'Desain dan implementasi aplikasi terdistribusi dan Integrasi dan komunikasi antar layanan.', '2023-12-06 20:40:51', '2023-12-06 20:43:42'),
(11, 'Sistem Terdistribusi', 'Manajemen Sumber Daya Terdistribusi', 'Pemilihan dan alokasi sumber daya dan Skalabilitas dan elastisitas sistem terdistribusi.', '2023-12-06 20:41:15', '2023-12-06 20:44:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `katpengabdian`
--

CREATE TABLE `katpengabdian` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `subkategori` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `labberita`
--

CREATE TABLE `labberita` (
  `id` int(11) NOT NULL,
  `kodelab` varchar(10) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `judulberita` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `labberita`
--

INSERT INTO `labberita` (`id`, `kodelab`, `kodeprodi`, `judulberita`, `content`, `foto`, `thumbnail`, `create`, `update`) VALUES
(6, 'lab-001', 'tif', '10 Rekomendasi Jurusan Teknik Informatika di Jawa Timur', '<p>Rekomendasi Jurusan Teknik Informatika di Jawa Timur:</p>\r\n\r\n<p>1. Universitas Brawijaya (UB)<br>\r\nUniversitas Brawijaya berdiri pada 23 September 1963. UB berada di Jalan Veteran, Kecamatan Lowokwaru, Kota Malang.<br>\r\nDi Universitas Brawijaya terdapat program studi Teknik Informatika. Akreditasnya B.<br>\r\n<br>\r\n2. Universitas Negeri Malang (UM)<br>\r\nUniversitas Negeri Malang berdiri pada 4 Agustus 1999. UM berada di Jalan Semarang 5 Malang, Kecamatan Lowokwaru, Kota Malang. Program Studi Teknik Informatika di UM memiliki akreditasi B.<br>\r\n<br>\r\n3. Universitas Islam Negeri (UIN) Maulana Malik Ibrahim Malang<br>\r\nIni merupakan universitas akreditasi A yang didirikan pada 21 Juni 2004. UIN Maulana Malik Ibrahim Malang berada di Jalan Gajayana No 50, Kecamatan Lowokwaru, Kota Malang.<br>\r\nDi Universitas Islam Negeri Maulana Malik Ibrahim Malang ada program studi Teknik Informatika yang terakreditasi B.<br>\r\n<br>\r\n4. Universitas Trunojoyo Madura (UTM)<br>\r\nUniversitas yang terakreditasi baik sekali ini berdiri sejak 5 Juli 2001. Lokasinya di Jalan Raya Telang, Perumahan Telang Inda, Telang, Kecamatan Kamal, Kabupaten Bangkalan.<br>\r\nProgram studi Teknik Informatika di Universitas Trunojoyo Madura memiliki akreditasi B.<br>\r\n<br>\r\n5. Universitas Negeri Surabaya (Unesa)<br>\r\nUniversitas dengan akreditasi unggul ini berdiri sejak 19 Desember 1964. Unesa berlokasi di Jalan Ketintang, Kota Surabaya.<br>\r\nProgram studi Teknik Informatika yang berada di bawah naungan Fakultas Teknik ini telah terakreditasi baik sekali.<br>\r\n<br>\r\n6. Universitas Pembangunan Nasional Veteran Jawa Timur (UPNVJT)<br>\r\nUPNVJT terakreditasi A yang berdiri sejak 5 Oktober 1965. Universitas ini berada di Jalan Raya Rungkut Madya Gunung Anyar Surabaya, Kecamatan Gununganyar, Kota Surabaya.<br>\r\nProgram studi Teknik Informatika di universitas ini terakreditasi baik sekali.<br>\r\n<br>\r\n7. Universitas Jember<br>\r\nUniversitas Jember yang terakreditasi unggul ini berlokasi di Jalan Kalimantan No 37 Kampus Tegalboto, Kecamatan Sumbersari, Kabupaten Jember.<br>\r\nProgram studi Teknik Informatika di universitas ini termasuk ke dalam Fakultas Ilmu Komputer dan terakreditasi baik.<br>\r\n<br>\r\n8. Universitas Muhammadiyah Malang (UMM)<br>\r\nUniversitas yang telah terakreditasi unggul ini berdiri sejak 1 September 1964. Kampusnya berlokasi di Jalan Raya Tlogomas No 246 Kecamatan Lowokwaru, Kota Malang.<br>\r\nProgram studi Teknik Informatika di universitas ini telah terakreditasi A.<br>\r\n<br>\r\n9. Universitas Kristen Petra<br>\r\nUniversitas yang terakreditasi unggul ini berdiri pada 22 September 1961. Lokasinya berada di Jalan Siwalankerto 121-131, Kecamatan Wonocolo, Kota Surabaya.<br>\r\nJurusan Teknik Informatika di universitas ini telah terakreditasi A.<br>\r\n<br>\r\n10. Institut Teknologi Sepuluh Nopember (ITS)<br>\r\nITS telah mengantongi akreditasi A secara institusi yang berarti sangat baik dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT)<br>\r\nBelasan departemen di ITS juga telah mendapatkan sertifikasi dari ASEAN University Network-Quality Assurance (AUN-QA). Salah satunya Teknik Informatika.</p>', 'f202312062007266570720e745d1.jpg', 't202312062007266570720e6fa53.jpg', '2023-12-06 20:07:26', NULL),
(7, 'lab-001', 'tif', 'Ini Lho Bedanya Jurusan Teknik Informatika, Ilmu Komputer, dan Sistem Informasi!', '<p>Perbedaan Teknik Informatika, Sistem Informasi, dan Ilmu Komputer</p>\r\n\r\n<p><br>\r\n1. Teknik Informatika<br>\r\nTeknik Informatika adalah bidang ilmu yang mempelajari soal teknologi komputer. Jurusan ini nantinya mencakup analisis matematis pengembangan, pengujian, evaluasi perangkat lunak, kerja komputer, dan sistem operasi.<br>\r\nMengutip unggahan Instagram Balai Pengelolaan Pengujian Pendidikan (BP3) Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi, jurusan tersebut identik dengan bahasa pemrograman dan aplikasinya. Beberapa contohnya adalah pembuatan aplikasi desktop, mobile, web, dan lainnya.<br>\r\nMata kuliah teknik informatika lebih cenderung ke ilmu pemrograman, pengembangan perangkat lunak, dan teknologi jaringan komputer. Pada jenjang SMK jurusan Rekayasa Perangkat Lunak (RPL), mata kuliah jurusan ini tidak jauh berbeda dengan mata pelajaran yang biasa dipelajari.<br>\r\n </p>\r\n\r\n<p>2. Ilmu Komputer<br>\r\nJurusan ilmu komputer lebih fokus pada teori dan strategi penerapan ilmu komputer, misalnya teknik pemrograman dan analisis algoritma perangkat lunak. Ilmu yang akan dipelajari di sini banyak mencakup sesuatu yang bersifat teoretis, misalnya teori jaringan, algoritma, pemrograman sistem, dan lainnya.<br>\r\nMahasiswa ilmu komputer nantinya akan menerjemahkan algoritma menjadi kode-kode di bahasa pemrograman.<br>\r\n<br>\r\n3. Sistem Informasi<br>\r\nJurusan sistem informasi adalah bidang ilmu yang menggabungkan ilmu komputer dengan bisnis manajemen. Mahasiswa akan belajar tentang identifikasi kebutuhan dan proses bisnis perusahaan berdasarkan data perusahaan, lalu merancang sistem yang sesuai dengan kebutuhan perusahaan.<br>\r\nPada sisi mata kuliahnya sendiri, jurusan sistem informasi lebih menekankan pada manajemen informasi. Oleh sebab itu, mahasiswa akan diminta untuk memiliki keahlian manajerial data hingga analisis yang baik.<br>\r\nItulah perbedaan jurusan teknik informatika, ilmu komputer, dan sistem informasi. Jika detikers tertarik dengan pembuatan aplikasi, maka lebih cocok mengambil jurusan teknik informatika.<br>\r\nApabila tertarik dengan pengolahan sistem informasi perusahaan, maka lebih cocok dengan jurusan sistem informasi. Namun, jika lebih suka dengan kode pemrograman dan proses pengolahannya, maka lebih sesuai dengan ilmu komputer.</p>', 'f202312062009476570729b84883.jpg', 't202312062009476570729b7e1fb.jpg', '2023-12-06 20:09:47', NULL),
(8, 'lab-002', 'tif', '5 Jurusan yang Bakal Banyak Diincar Perusahaan, Gaji Per Tahun Bisa 3 Digit', '<p>Daftar Jurusan dengan Prospek Paling Dicari pada 2025</p>\r\n\r\n<p><br>\r\n1. Sains Data<br>\r\nMenurut WEF, ahli sains data bakal memiliki peluang yang oke dalam pasar tenaga kerja 2025. Jurusan kuliah mengenai bidang ini belum cukup jamak ditawarkan di Indonesia. Namun, ada beberapa universitas, baik yang berstatus negeri maupun swasta yang sudah menyediakannya.<br>\r\n<br>\r\nInstitut Teknologi Bandung (ITB) misalnya, di sana terdapat jurusan Statistika dan Sains Data. Kemudian ada Universitas Airlangga (Unair) yang memiliki jurusan Teknologi dan Sains Data.<br>\r\n<br>\r\nLaman karier Indeed menerangkan, profesi dalam bidang ini dapat menyentuh gaji sampai 1,7 miliar per tahun.<br>\r\n<br>\r\n2. Pemasaran Digital<br>\r\nPemasaran digital atau yang kerap disebut sebagai digital marketing akan banyak diburu pada 3-5 tahun selanjutnya. Namun, sejumlah perusahaan telah mulai mencari seseorang yang ahli dalam bidang tersebut.<br>\r\n<br>\r\nJurusan ini sudah cukup banyak diajarkan di berbagai perguruan tinggi di Indonesia, misalnya di Binus University, Universitas Padjadjaran, Universitas Prasetya Mulya, dan lain sebagainya. Berdasarkan Economic Research Institute dalam laman Salary Expert, posisi pemasaran digital di Indonesia bisa mengantongi sampai 251 juta per tahun dan di Amerika Serikat bisa sampai 1 miliar per tahun.<br>\r\n<br>\r\n3. Teknik Informatika<br>\r\nPermintaan untuk information security analyst, software and application developers, sampai internet of things specialist akan meningkat. Demikian prediksi dalam laporan WEF. Jurusan yang dapat mengantarkan kepada ketiga profesi ini adalah Teknik Informatika. Umumnya, jurusan tersebut dapat ditemukan di Fakultas Teknik atau juga bisa berdiri sebagai fakultas tersendiri.<br>\r\n<br>\r\nPengembang perangkat lunak atau software developer di Indonesia bisa memperoleh gaji sampai 386 juta per tahunnya. Sementara, di Amerika Serikat seseorang yang menggeluti bidang ini bisa memasukkan hingga 1,5 miliar per tahun ke rekeningnya.<br>\r\n<br>\r\n4. Teknik Robotika dan Kecerdasan Buatan<br>\r\nAda beberapa kampus di Indonesia yang sudah mulai menyediakan jurusan mengenai robotika dan kecerdasan buatan (AI) atau paling tidak menawarkan mata kuliah tentangnya. Unair adalah satu-satunya universitas di Indonesia yang dengan spesifik membuka jurusan tersebut sejak 2020 lalu.<br>\r\n<br>\r\nKemudian, ada juga Universitas Indonesia (UI) yang menyertakan Artificial Intelligence (AI) menjadi salah satu mata kuliah di Fakultas Ilmu Komputer. Selain itu, Institut Teknologi Sepuluh Nopember (ITS) juga membuka jurusan Teknik Robotika secara khusus.<br>\r\n<br>\r\nDisebutkan oleh Economic Research Institute, posisi Ai bisa mengantarkan gaji sampai 418 juta setiap tahun. Di sisi lain, gaji per tahun bidang ini di Amerika Serikat bisa menyentuh angka 1,7 miliar.<br>\r\n<br>\r\n5. Bisnis<br>\r\nAda banyak prospek karier untuk seorang lulusan jurusan bisnis, contohnya analis keuangan, konsultan manajemen, dan banyak lagi. Sejumlah kampus yang dikenal punya jurusan bisnis terbaik adalah ITB, Unair, Undip, UGM, dan UB.<br>\r\n<br>\r\nGaji seorang analis bisnis di Indonesia biasanya bisa mencapai 335 juta per tahun. Sementara, di Amerika Serikat bisa sampai 1,3 miliar per tahun.</p>', 'f202312062011556570731b2b128.jpg', 't202312062011556570731b24ba8.jpg', '2023-12-06 20:11:55', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium`
--

CREATE TABLE `laboratorium` (
  `kodelab` varchar(10) NOT NULL,
  `nip` varchar(14) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `katlabid` int(11) NOT NULL,
  `namalab` varchar(255) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `laboratorium`
--

INSERT INTO `laboratorium` (`kodelab`, `nip`, `kodeprodi`, `katlabid`, `namalab`, `profile`, `foto`, `create`, `update`) VALUES
('lab-001', '19730520200212', 'tif', 5, 'Laboratorium Sistem Terditribusi', '<p>Sistem terdistribusi adalah bidang dalam ilmu komputer yang berkaitan dengan desain, implementasi, dan manajemen sistem yang terdiri dari beberapa komponen yang terdistribusi secara geografis. Profil laboratorium sistem terdistribusi mungkin mencakup berbagai aspek penelitian dan pengembangan terkait dengan sistem tersebut. Berikut ini adalah beberapa komponen umum yang mungkin termasuk dalam profil laboratorium sistem terdistribusi :</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Penelitian dan Pengembangan Sistem Terdistribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Fokus pada penelitian untuk meningkatkan efisiensi, kinerja, dan keandalan sistem terdistribusi.</li>\r\n  <li>Eksplorasi teknologi terbaru dalam domain ini seperti teknologi cloud computing, teknologi kontainer, dan teknologi serverless.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Keamanan Sistem Terdistribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian mengenai keamanan sistem terdistribusi, termasuk enkripsi data, otentikasi, dan keamanan jaringan.</li>\r\n  <li>Pengembangan metode keamanan yang dapat melindungi data yang dikirim antar node dalam sistem terdistribusi.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Manajemen Sumber Daya Terdistribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Pengembangan algoritma dan strategi untuk manajemen sumber daya terdistribusi seperti alokasi CPU, manajemen memori, dan manajemen penyimpanan terdistribusi.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Komputasi Terdistribusi Skala Besar:</strong></p>\r\n\r\n <ul>\r\n  <li>Studi tentang arsitektur dan algoritma untuk sistem terdistribusi pada skala besar, seperti infrastruktur cloud computing dan sistem big data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Komunikasi Antarproses dan Komunikasi Antar-Node:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian mengenai protokol komunikasi yang efisien antar proses dan antar node dalam lingkungan terdistribusi.</li>\r\n  <li>Pengembangan mekanisme komunikasi yang tahan terhadap kegagalan dan latensi rendah.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrograman Terdistribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Pengembangan dan evaluasi model pemrograman terdistribusi, seperti pemrograman asinkron, pemrograman berbasis pesan, atau pemrograman berbasis tugas.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Optimisasi Kinerja:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian mengenai teknik optimisasi kinerja untuk aplikasi terdistribusi, termasuk load balancing dan penjadwalan tugas.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Analisis Kegagalan dan Pemulihan:</strong></p>\r\n\r\n <ul>\r\n  <li>Studi tentang analisis kegagalan sistem terdistribusi dan pengembangan strategi pemulihan yang cepat dan efisien.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Simulasi dan Pengujian:</strong></p>\r\n\r\n <ul>\r\n  <li>Pengembangan alat simulasi dan pengujian untuk sistem terdistribusi guna mengevaluasi kinerja dan keandalan sistem dalam berbagai skenario.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Profil laboratorium dapat berbeda tergantung pada fokus penelitian dan keahlian khusus dari anggota tim penelitian. Sebuah laboratorium sistem terdistribusi yang baik akan terlibat dalam penelitian mendalam, pengembangan teknologi baru, dan aplikasi praktis dalam konteks sistem terdistribusi modern.</p>', '202312061900546570627600794.jpg', '2023-12-06 19:00:54', '2023-12-06 19:41:27'),
('lab-002', '19760627200801', 'tif', 6, 'Laboratorium Riset', '<p>Profil laboratorium riset teknik informatika akan sangat bervariasi tergantung pada fokus penelitian, keahlian anggota tim, dan tujuan laboratorium. Namun, berikut adalah beberapa komponen umum yang mungkin tercakup dalam profil laboratorium riset teknik informatika :</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Inteligensi Buatan (AI) dan Pembelajaran Mesin:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam pengembangan algoritma pembelajaran mesin dan teknik-teknik kecerdasan buatan untuk aplikasi tertentu.</li>\r\n  <li>Implementasi solusi AI dalam masalah dunia nyata seperti analisis data, pengenalan pola, atau pemrosesan bahasa alami.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Komputasi Awan dan Edge Computing:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian terkait infrastruktur dan teknologi cloud computing.</li>\r\n  <li>Pengembangan solusi untuk edge computing, di mana pemrosesan data terjadi dekat dengan sumber data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Keamanan Informatika:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian keamanan jaringan dan sistem komputer.</li>\r\n  <li>Pengembangan metode enkripsi, deteksi ancaman, dan strategi keamanan siber.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Internet of Things (IoT):</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian mengenai integrasi perangkat IoT dan pengembangan aplikasi IoT.</li>\r\n  <li>Pengembangan protokol komunikasi dan keamanan untuk lingkungan IoT.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pengolahan Citra dan Grafika Komputer:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam pengolahan citra dan analisis visual.</li>\r\n  <li>Pengembangan teknik grafika komputer untuk aplikasi seperti simulasi, desain, atau realitas virtual.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Sistem Terdistribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Studi tentang arsitektur, protokol, dan algoritma untuk sistem terdistribusi.</li>\r\n  <li>Pengembangan solusi terdistribusi untuk aplikasi khusus.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan Paralel dan Kinerja Tinggi:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian terkait dengan pemrosesan paralel dan sistem kinerja tinggi.</li>\r\n  <li>Pengembangan algoritma dan teknik untuk meningkatkan kinerja aplikasi dan sistem.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan Bahasa Alami (NLP):</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam pemrosesan bahasa alami dan aplikasi seperti penerjemahan otomatis, pengenalan suara, dan chatbot.</li>\r\n  <li>Pengembangan model bahasa alami yang canggih.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan Data Besar (Big Data):</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian tentang teknik pengelolaan, analisis, dan ekstraksi informasi dari data besar.</li>\r\n  <li>Pengembangan infrastruktur untuk penyimpanan dan pengolahan big data.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrograman dan Pengembangan Perangkat Lunak:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam metodologi pengembangan perangkat lunak.</li>\r\n  <li>Pengembangan alat dan teknik baru untuk meningkatkan produktivitas pengembang.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Interaksi Manusia dan Komputer:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian terkait desain antarmuka pengguna.</li>\r\n  <li>Pengembangan teknologi untuk meningkatkan interaksi antara manusia dan sistem komputer.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Rekayasa Perangkat Lunak dan Manajemen Proyek:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam praktik terbaik pengembangan perangkat lunak.</li>\r\n  <li>Pengembangan metodologi manajemen proyek yang efektif.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Profil laboratorium riset teknik informatika yang efektif akan mencakup kombinasi dari beberapa bidang ini untuk mencapai tujuan riset yang holistik dan berdampak. Selain itu, kolaborasi dengan industri, penerapan teknologi di dunia nyata, dan partisipasi dalam konferensi dan publikasi ilmiah sering kali menjadi bagian integral dari profil laboratorium ini.</p>', '202312061903576570632d62c90.jpg', '2023-12-06 19:03:57', NULL),
('lab-003', '19830305200604', 'tif', 7, 'Laboratoirum Multimedia', '<p>Profil laboratorium multimedia dapat mencakup berbagai aspek penelitian dan pengembangan dalam domain multimedia, yang melibatkan pengolahan dan manipulasi data multimedia seperti gambar, suara, video, dan teks. Berikut adalah beberapa komponen umum yang mungkin tercakup dalam profil laboratorium multimedia :</p>\r\n\r\n<ol>\r\n <li>\r\n <p><strong>Pengolahan Citra dan Video:</strong></p>\r\n\r\n <ul>\r\n  <li>Pengembangan algoritma untuk analisis dan pengolahan citra digital.</li>\r\n  <li>Pemrosesan video, termasuk deteksi objek, pelacakan objek, dan segmentasi video.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Audio dan Pengolahan Sinyal Suara:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam pengolahan sinyal audio, termasuk pengenalan suara, pemodelan akustik, dan pemrosesan sinyal audio.</li>\r\n  <li>Pengembangan algoritma untuk pengolahan suara dan pemahaman audio.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Sistem Multimedia Terdistribusi:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam sistem distribusi untuk menyebarkan konten multimedia.</li>\r\n  <li>Pengembangan protokol komunikasi dan arsitektur untuk distribusi konten multimedia secara efisien.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Rekayasa Multimedia dan Desain Antarmuka Pengguna:</strong></p>\r\n\r\n <ul>\r\n  <li>Pengembangan aplikasi multimedia, termasuk pengembangan perangkat lunak, permainan, dan aplikasi edukasi multimedia.</li>\r\n  <li>Desain antarmuka pengguna yang memadukan elemen-elemen multimedia.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Realitas Virtual (VR) dan Realitas Augmented (AR):</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam pengembangan teknologi VR dan AR.</li>\r\n  <li>Pengembangan konten VR dan AR untuk aplikasi seperti pelatihan, simulasi, dan hiburan.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan Teks dan Bahasa Alami:</strong></p>\r\n\r\n <ul>\r\n  <li>Analisis teks dan pemrosesan bahasa alami untuk ekstraksi informasi dan pengelompokan data teks.</li>\r\n  <li>Pengembangan aplikasi yang melibatkan pemahaman bahasa alami.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Teknologi Interaksi Multimodal:</strong></p>\r\n\r\n <ul>\r\n  <li>Studi tentang cara-cara untuk mengintegrasikan berbagai mode interaksi, seperti suara, gerakan, dan sentuhan, dalam aplikasi multimedia.</li>\r\n  <li>Pengembangan sistem yang mendukung antarmuka pengguna multimodal.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Pemrosesan dan Analisis Big Data Multimedia:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian terkait manajemen dan analisis data multimedia dalam skala besar.</li>\r\n  <li>Pengembangan teknik untuk mengekstrak wawasan dari data multimedia besar.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Kompresi Multimedia:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam teknik kompresi untuk mengurangi ukuran file multimedia tanpa kehilangan kualitas.</li>\r\n  <li>Pengembangan algoritma dan standar kompresi multimedia.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Keamanan Multimedia:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian dalam keamanan dan perlindungan hak cipta untuk data multimedia.</li>\r\n  <li>Pengembangan teknik watermarking dan enkripsi multimedia.</li>\r\n </ul>\r\n </li>\r\n <li>\r\n <p><strong>Manajemen Konten Multimedia:</strong></p>\r\n\r\n <ul>\r\n  <li>Penelitian terkait dengan penyimpanan, pengelolaan, dan penemuan konten multimedia.</li>\r\n  <li>Pengembangan sistem manajemen konten multimedia yang efisien.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n\r\n<p>Profil laboratorium multimedia yang efektif akan mencakup kombinasi dari beberapa bidang ini untuk mencapai pemahaman mendalam tentang berbagai aspek multimedia dan mengembangkan solusi inovatif dalam domain ini. Kolaborasi dengan industri, eksperimen praktis, dan partisipasi dalam konferensi dan publikasi ilmiah juga dapat menjadi bagian integral dari profil laboratorium ini.</p>', '20231206191940657066dcb8d60.jpg', '2023-12-06 19:19:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kodeprodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` text DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` tinytext DEFAULT NULL,
  `angkatan` varchar(15) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `kodeprodi`, `password`, `nama`, `alamat`, `angkatan`, `create`, `update`) VALUES
('170411100030', 'tif', '$2y$10$HO3L0AgE3HIkqYTEQ4yyJOeb2afx//lnA2joc6L.3l.hITANDwrJK', 'Rifki Avendika', 'Jl Jend Sudirman 125, Bandung, Jawa Barat', '2017', '2023-12-02 17:11:50', NULL),
('180411100076', 'tif', '$2y$10$9AHlHR.GO7GprBIyaQqtU.BUb4HBNQUN0OMjakbMO3CfqcWo6cRb.', 'Muhammad Fasih Auladi', 'Jl. Pesanggrahan, Kwanyar, Bangkalan, Jawa Timur', '2018', '2023-12-02 17:01:18', '2023-12-02 17:04:53'),
('180411100087', 'tif', '$2y$10$OrbXoO0wlYVFgm06yAR2sugo/uy1drgENm0.QindfJ0XPbyv5jSc.', 'Aldi saputra', 'JL. Jaksa Agung Suprapto, Malang, Malang', '2018', '2023-12-02 17:13:37', '2023-12-02 17:14:27'),
('190411100088', 'tif', '$2y$10$LJ//ZmVPEcoJBCvztPlnEuR5EjTFjC2o3G2iLLEth.7SmszJTbj9K', 'Muhammad Razzaaq', 'Jl Wonodri 22, Semarang. Jawa Tengah', '2019', '2023-12-02 17:04:19', NULL),
('210411100116', 'tif', '$2y$10$QSR1UF4B6X8te7OcCBxSw.Q/2jZLFkRJrC/1rPpqRnyh4jmwBcPLq', 'Kun Dayanah', 'Jl Plampitan Bokoran 165, Semarang, Jawa Tengah', '2021', '2023-12-02 17:10:07', NULL),
('210411100133', 'tif', '$2y$10$np9m/cbfwgX.3ucOTmztKOIZGDpd1ZE8/wmfH3KQSHITmnBi.cBaG', 'Zofan Afandi', 'Jl Kavling Agraria 73, Dki Jakarta, Dki Jakarta, Jakarta', '2021', '2023-12-02 17:06:27', '2023-12-02 17:13:55'),
('210411100176', 'tif', '$2y$10$2REIrPR/R8eJqjEqsxccau3vaP2Anvi8JB1dKV020jt.LHSj9ZZ62', 'Rahma Nurhaliza', 'Jl H Abd Rachman Syihab, Medan, Sumatera Utara', '2021', '2023-12-02 17:08:49', '2023-12-02 17:14:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutu`
--

CREATE TABLE `mutu` (
  `id` int(11) NOT NULL,
  `kategori` enum('Mutu','SOP') DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `mutu`
--

INSERT INTO `mutu` (`id`, `kategori`, `deskripsi`, `create`, `update`) VALUES
(7, 'Mutu', 'Dokumen Mutu Akademik', '2023-12-06 20:17:00', NULL),
(8, 'Mutu', 'Dokumen Mutu Sarana Prasarana', '2023-12-06 20:17:19', NULL),
(9, 'Mutu', 'Dokumen Mutu Kemahasiswaan', '2023-12-06 20:17:32', NULL),
(10, 'SOP', 'SOP Akademik', '2023-12-06 20:17:43', NULL),
(11, 'SOP', 'SOP Kemahasiswaan', '2023-12-06 20:17:56', NULL),
(12, 'SOP', 'SOP Sarana Dan Prasaranan', '2023-12-06 20:18:06', NULL),
(13, 'SOP', 'SOP Skripsi', '2023-12-06 20:18:25', NULL),
(14, 'SOP', 'SOP Kerja Praktek', '2023-12-06 20:18:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengabdianberita`
--

CREATE TABLE `pengabdianberita` (
  `id` int(11) NOT NULL,
  `kodeprodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL,
  `nip` varchar(14) NOT NULL,
  `kodejabatan` varchar(10) NOT NULL,
  `kodeprodi` varchar(10) DEFAULT NULL,
  `skjabatan` varchar(50) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peta`
--

CREATE TABLE `peta` (
  `id` int(11) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `kategori` enum('Mahasiswa','Dosen') DEFAULT NULL,
  `namadok` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `berkasphp` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi`
--

CREATE TABLE `prestasi` (
  `id` int(11) NOT NULL,
  `npm` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu` date DEFAULT NULL,
  `kategori` enum('Regional','Nasional','Internasional') DEFAULT NULL,
  `namaprestasi` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `kodeprodi` varchar(10) NOT NULL,
  `namaprodi` varchar(100) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `visimisi` text DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`kodeprodi`, `namaprodi`, `profile`, `visimisi`, `create`, `update`) VALUES
('si', 'Sistem Informasi', '<p>demo sistem Informasi</p>', '<p>Membanggakan bersama</p>', '2023-12-02 17:53:24', '2024-01-03 20:52:35'),
('tif', 'Teknik Informatika', '<p xss=removed><strong>Apa yang dipelajari di teknik informatika</strong></p>\r\n\r\n<p xss=removed>Kebutuhan praktisi IT kian berkembang seiring pesatnya perkembangan jaman dan teknologi, oleh karena itu Fakultas Teknik Universitas Pasundan memiliki jurusan atau program studi untuk memenuhi kebutuhan praktisi IT yang ahli dan professional.</p>\r\n\r\n<p xss=removed>Program Studi Teknik Informatika UNPAS telah terakreditasi B dari BAN-PT dan diharapkan dapat menghasilkan tenaga-tenaga muda profesional yang terampil dalam bidang teknologi informasi.</p>\r\n\r\n<p xss=removed>Kebanyakan orang sering tertukar antara istilah Teknik Informatika, Teknik Komputer, Sistem Informasi, dan istilah sejenis lainnya. Parahnya sebagian orang tidak ingin ambil pusing dan menyamakan semua istilah tersebut dan menjadikannya patokan jika semua ilmu komputer itu sama.</p>\r\n\r\n<p xss=removed><strong>Apa itu Teknik Informatika</strong></p>\r\n\r\n<p xss=removed>Teknik Informatika merupakan salah satu jurusan pendidikan tingkat perguruan tinggi yang mempelajari serta menerapkan prinsip-prinsip ilmu komputer dan analisis matematis dalam perancangan, pengujian, pengembangan, dan evaluasi sistem operasi, perangkat lunak (Software), dan kinerja komputer.</p>\r\n\r\n<p xss=removed>Sederhananya saat kamu menjadi mahasiswa Teknik Informatika maka kamu akan berkutat dengan pekerjaan yang namanya ngoding atau programming. Kemampuan dalam merancang dan mengembangkan ragam algoritma komputasi, seperti perangkat lunak untuk bisnis, pengelolaan jaringan, insfrastruktur teknologi informasi, hingga pengembangan aplikasi multimedia akan selalu diasah saat kuliah.</p>\r\n\r\n<p xss=removed>Di Teknik Informatika UNPAS, kamu akan belajar secara bertahap mulai dari memperkuat pemahamanmu tentang dasar-dasar programming, mulai membuat sebuah algoritma sederhana, merancang alur program, hingga membangun perangkat lunak baik itu aplikasi desktop, web, dan mobile.</p>\r\n\r\n<p xss=removed>Karena kuliah Teknik Informatika cenderung mempelajari hal yang berkaitan dengan software bukan berarti tidak mempelajari hardware, Teknik Informatika UNPAS juga mengajarkan bidang lain seperti hardware, jaringan, manajemen, dsbnya, jadi jangan khawatir.</p>\r\n\r\n<p xss=removed>Selain itu peluang kerja yang terbuka sangatlah besar, saat ini lulusan jurusan Teknik Informatika masih menjadi yang paling banyak dicari bukan hanya di Indonesia tapi di Dunia juga.</p>\r\n\r\n<p xss=removed><strong>Prospek Kerja lulusan Teknik Informatika UNPAS</strong></p>\r\n\r\n<p xss=removed>Pada dasarnya Alumni Teknik Informatika bisa kerja di bidang industri manapun, seperti yang diketahui jika saat ini era industri sudah mencapai era industri 4.0 dan sebentar lagi akan memasuki era industri 5.0, dimana teknologi yang digunakan membutuhkan tenaga IT profesional yang sangat banyak untuk membangun dan mengelolanya. Berikut pilihan karir bagi lulusan Teknik Informatika.</p>\r\n\r\n<p xss=removed>1. Karyawan IT</p>\r\n\r\n<p xss=removed>2. Programmer</p>\r\n\r\n<p xss=removed>3. Konsultan IT</p>\r\n\r\n<p xss=removed>4. Data Scientist</p>\r\n\r\n<p xss=removed>5. Web Developer</p>\r\n\r\n<ol>\r\n</ol>', '<p><strong>Visi</strong></p>\r\n\r\n<p>Menjadi universitas yang mandiri, inovatif, terkemuka di tingkat nasional dan internasional, pelopor pengembangan ilmu pengetahuan, teknologi, humaniora dan seni berdasarkan moral agama.</p>\r\n\r\n<p><strong>Misi</strong></p>\r\n\r\n<p>Menyelenggarakan dan mengembangkan pendidikan akademik, profesi, dan/atau vokasi dengan keunggulan kelas dunia berlandaskan nilai kebangsaan dan moral agama.</p>', '2023-12-02 17:53:40', '2024-01-03 20:39:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodiberita`
--

CREATE TABLE `prodiberita` (
  `id` int(11) NOT NULL,
  `kodeprodi` varchar(50) NOT NULL,
  `judul` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(50) DEFAULT NULL,
  `foto2` varchar(50) DEFAULT NULL,
  `thumbnail2` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `prodiberita`
--

INSERT INTO `prodiberita` (`id`, `kodeprodi`, `judul`, `content`, `foto`, `thumbnail`, `foto2`, `thumbnail2`, `create`, `update`) VALUES
(42, 'tif', 'Fakultas Ilmu Keperawatan UI Jadi yang Terbaik di Indonesia Versi EduRank 2023', '<p>Jakarta - Universitas Indonesia (UI) berhasil meraih peringkat pertama sebagai kampus dengan Fakultas Ilmu Keperawatan (FIK) terbaik di Indonesia versi EduRank 2023.</p>\r\n\r\n<p>Di tingkat Asia, FIK UI menduduki peringkat ke-36 terbaik sedangkan di tingkat dunia berada di posisi ke-379. Adapun penilaian masing-masing fakultas ilmu keperawatan ini didasarkan pada reputasi, kinerja penelitian, dan dampak yang dihasilkan oleh alumni.<br>\r\n<br>\r\nProduk akademis FIK UI berhasil unggul dari 1,3 juta kutipan dan 805 ribu makalah yang dibuat oleh 60 kampus lainnya di Indonesia. Atas capaian tersebut, dekan FIK UI, Agus Setiawan mengatakan bahwa penghargaan diperoleh karena kerja sama berbagai pihak kampus.</p>\r\n\r\n<p>\"Kami dengan rendah hati menerima pengakuan ini, yang mencerminkan komitmen FIK UI untuk keunggulan dalam pendidikan keperawatan. Ini adalah pencapaian kolaboratif yang menghargai kerja keras, semangat inovasi, dan dedikasi staf pengajar, mahasiswa, dan seluruh komunitas FIK UI,\" ungkap Agus, dikutip laman UI, Senin (23/10/2023).<br>\r\n </p>\r\n\r\n<p><strong>Terakreditasi Nasional-Internasional</strong></p>\r\n\r\n<p><br>\r\nSelain menjadi fakultas ilmu keperawatan terbaik di Indonesia, FIK UI kini telah terakreditasi unggul dari Lembaga Akreditasi Mandiri Pendidikan Tinggi Kesehatan Indonesia (LAMP-PTKes).<br>\r\n<br>\r\nKhususnya prodi Ilmu Keperawatan UI, telah terakreditasi Asean University Network (AUN QA) dan Accreditation Agency in Health and Social Sciences (AHPGS).<br>\r\n<br>\r\nCapaian-capaian FIK UI ini menurut Agus merupakan hasil dari komitmen dan tanggung jawab UI dalam pengabdian masyarakat.<br>\r\n<br>\r\n\"Hal ini dibuktikan dari beragam pengabdian masyarakat yang dilaksanakan hampir di seluruh penjuru Indonesia, hibah riset, pertukaran pelajar ke luar negeri melalui program Indonesian International Student Mobility Awards (IISMA), pengadaan summer course, serta menjuarai berbagai lomba di tingkat nasional maupun internasional,\" kata Agus.<br>\r\n </p>\r\n\r\n<p>Selanjutnya, Agus menyebut bawa UI akan terus berusaha dalam memajukan pendidikan dan penelitian di bidang keperawatan. Hal ini sesuai dengan visi FIK UI yakni menjadi pusat pengembangan IPTEK yang adaptif, mampu bersaingan dan berkontribusi untuk kesehatan Indonesia dan peka terhadap budaya.<br>\r\n<br>\r\n\"Menempati peringkat pertama di Indonesia, tentu menjadi sebuah amanah dan tanggung jawab besar. Maka dari itu, FIK UI senantiasa mengembangkan berbagai inovasi dan prestasi baik di bidang kesehatan maupun sosial masyarakat,\" tuturnya.<br>\r\n<br>\r\nTidak hanya akademik, FIK UI juga membuktikan prestasinya di bidang seni, olahraga bahkan kebahasaan.</p>', 'f20231202184859656b19ab9f197.jpg', 't20231202184859656b19ab993e6.jpg', NULL, NULL, '2023-12-02 18:48:59', '2024-01-03 20:54:31'),
(43, 'tif', 'Kuliah Psikologi: Ini yang Dipelajari dan Kampus Terbaiknya', '<p>Jakarta - Jurusan psikologi selalu dikaitkan dengan mempelajari tentang kehidupan manusia. Jurusan ini merupakan salah satu jurusan yang populer di Indonesia dengan peminat yang banyak. Tapi, apa saja ya yang dipelajari di jurusan psikologi?<br>\r\nJurusan psikologi dikenal sebagai salah satu jurusan yang memiliki peluang lapangan kerja atau prospek kerja yang luas. Sehingga lulus dari jurusan ini akan cukup menjanjikan.<br>\r\n<br>\r\nSebelum mengulik lebih dalam, ketahui dulu apa itu jurusan psikologi di bawah ini.</p>\r\n\r\n<p><strong>Apa Itu Jurusan Psikologi?</strong></p>\r\n\r\n<p>Mendengar kata psikologi pasti akan langsung terpikirkan mengenai memahami mental diri atau seseorang. Memang benar, pada jurusan psikologi juga akan mempelajari terkait mental, jiwa, kehidupan manusia sehari-hari.<br>\r\n<br>\r\nDikutip dari buku \"Pengantar Psikologi\" karya Wasty Soemanto, psikologi dapat didefinisikan secara singkat sebagai ilmu yang mempelajari tingkah laku manusia dan hubungan-hubungan antar manusia. Dari pengertian tersebut secara sederhana psikologi merupakan ilmu tentang tingkah laku manusia.<br>\r\n<br>\r\nSedangkan berdasarkan buku \"Psikologi Umum Dasar\" karya Ahmad Saifuddin, pengertian psikologi adalah suatu ilmu pengetahuan empiri yang mempelajari dinamika kejiwaan dan proses mental melalui perilaku manusia.<br>\r\n<br>\r\nBerdasarkan beberapa sumber tersebut maka dapat dirangkum pengertian psikologi adalah suatu ilmu pengetahuan yang mempelajari tingkah laku, jiwa, dan mental manusia.<br>\r\n<br>\r\nMelansir laman Binus University, jurusan psikologi di Indonesia pertama kali berkembang pada tahun 1952. Psikologi di Indonesia diperkenalkan oleh seorang profesor psikiater dari Universitas Indonesia yang bernama Slamet Imam Santoso dan menjadi jurusan psikologi pertama di Indonesia.</p>\r\n\r\n<p><strong><span xss=removed>Apa yang Dipelajari Jurusan Psikologi?</span></strong></p>\r\n\r\n<p>Jurusan psikologi pada umumnya terdapat di berbagai tingkat strata, mulai dari D4 atau S-1, S-2, sampai pada S-3. Biasanya, mahasiswa jurusan psikologi, pada semester awal akan berfokus mengenali psikologi terlebih dahulu.<br>\r\n<br>\r\nSaat kuliah, mahasiswa akan mempelajari hal-hal dasar ilmu psikologi, seperti sejarah, teori-teori, dan tokoh-tokoh yang terkenal dalam pengembangan ilmu psikologi. Pembelajaran tersebut merupakan hal-hal umum yang harus dipahami sebelum masuk pada pembelajaran lebih mendalam di semester berikutnya.<br>\r\n<br>\r\nPada semester selanjutnya mahasiswa akan mulai mempelajari penerapan teori yang telah dipahami sebelumnya. Mahasiswa akan terjun langsung menganalisis suatu kasus dan mengaitkannya dengan teori.<br>\r\n<br>\r\nPada jurusan psikologi terdapat bidang peminatan yang akan dipelajari secara lebih khusus dan spesifik untuk merujuk pada fokus bidang yang diminati mahasiswa. Dirangkum dari beberapa sumber kampus, bidang peminatan tersebut antara lain:<br>\r\n<br>\r\n- Psikologi Klinis<br>\r\nBidang ilmu psikologi ini akan mempelajari masalah kesehatan mental atau psikologi pada manusia<br>\r\n<br>\r\n- Psikologi Pendidikan<br>\r\nBidang ini mempelajari lingkup proses pendidikan yang mempengaruhi pribadi seseorang dalam perkembangan psikisnya<br>\r\n<br>\r\n- Psikologi Industri dan Organisasi<br>\r\nBidan ini mempelajari fenomena perilaku atau hal kesehatan mental seseorang yang terpengaruh pada lingkungan kerja atau organisasi<br>\r\n<br>\r\n- Psikologi Sosial<br>\r\nMempelajari tentang hubungan antar manusia satu dengan lainnya dan memiliki pengaruh pada mental atau perkembangan tingkah laku diri seseorang<br>\r\n<br>\r\n- Psikologi Perkembangan<br>\r\nBidang ini akan mempelajari segala perubahan dan perkembangan kondisi mental seseorang dari anak-anak sampai menjadi dewasa. Sebab mental tersebut memiliki karakter yang berbeda<br>\r\n<br>\r\n- Psikologi Umum dan Eksperimen<br>\r\nBidang ilmu ini akan berfokus pada kegiatan penelitian dan percobaan terkait proses pengembangan ilmu psikologi.</p>', 'f20231202185505656b1b198b0e7.jpg', 't20231202185505656b1b1985bc4.jpg', NULL, NULL, '2023-12-02 18:55:05', '2024-01-03 20:53:46'),
(44, 'tif', 'Aturan Baru Akreditasi Kampus dan Prodi', '<p>Jakarta - Akreditasi perguruan tinggi kini hanya terdiri dari Terakreditasi dan Tidak Terakreditasi saja. Sebelumnya, akreditasi kampus terdiri dari Akreditasi Unggul, Baik Sekali, Baik, dan Tidak Terakreditasi.<br>\r\nAkreditasi adalah kegiatan penilaian sesuai kriteria berdasarkan Standar Nasional Pendidikan Tinggi (SN Dikti). Aturan baru akreditasi perguruan tinggi ini tertuang dalam Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Perguruan Tinggi (Permendikbudristek) Nomor 53 Tahun 2023.<br>\r\n<br>\r\n\"Sekarang kita memindahkan, menyederhanakan, membuat ini lebih simpel. Status akreditasinya kita sederhanakan, Pemerintah yang akhirnya menanggung biaya akreditasi wajib, dan pengumpulan proses akreditasi di tingkat departemen,\" kata Mendikbudristek Nadiem Makarim di Merdeka Belajar Episode 26: Transformasi Standar Nasional dan Akreditasi Perguruan Tinggi, dikutip Jumat (1/8/2023).<br>\r\n </p>\r\n\r\n<p>Nadiem menjelaskan, adapun akreditasi prodi kini terdiri dari Terakreditasi oleh Lembaga Internasional, Akreditasi Unggul, Terakreditasi, dan Tidak Terakreditasi. Khusus prodi yang belum mendapat akreditasi wajib, maka biaya akreditasinya ditanggung Pemerintah.<br>\r\n<br>\r\nSedangkan bagi prodi yang sudah berstatus Terakreditasi dan mau meningkatkan status ke Akreditasi Unggul, maka biayanya ditanggung perguruan tinggi masing-masing. Khusus bagi prodi yang sudah Terakreditasi oleh Lembaga Internasional, maka tidak perlu akreditasi nasional lagi.</p>\r\n\r\n<p><strong>Apa Pentingnya Akreditasi Kampus dan Prodi?</strong></p>\r\n\r\n<p>Nadiem menjelaskan, status Terakreditasi artinya perguruan tinggi dan prodi tersebut sudah memenuhi Standar Nasional Pendidikan Tinggi (SN Dikti). Sedangkan status Akreditasi Unggul berarti memenuhi standar Lembaga Akreditasi Mandiri (LAM). Standar LAM harus melampaui SN Dikti yang merupakan standar minimum.<br>\r\n<br>\r\n\"Ini voluntary, tidak wajib. Bagi yang ingin Terakreditasi Unggul, approach LAM, dan itu voluntary. Tentunya standar LAM lebih tinggi dari standar SN Dikti,\" kata Nadiem.<br>\r\n<br>\r\n\"Status akreditasi itu wajib, tetapi unggul itu tidak wajib. Dan yang wajib, itu full ditanggung pemerintah. Ini penting untuk universitas-universitas kita yang skalanya lebih kecil, PTS (perguruan tinggi swasta), yang komplain atas betapa besarnya beban ini. Alhamdulillah sekarang itu beban ditanggung negara full,\" sambungnya.<br>\r\n<br>\r\nMenurutnya, perubahan kebijakan akreditasi di perguruan tinggi dan prodi membuat standar yang menjadi dasar akreditasi lebih jelas dan sederhana. Lebih lanjut, akreditasi per prodi kini disederhanakan sehingga bisa dilaksanakan di tingkat departemen. Kebijakan baru ini menurutnya memungkinkan permintaan data tidak bolak-balik diminta di fakultas dan perguruan tinggi.<br>\r\n<br>\r\n\"Dari perspektif perguruan tinggi, ini ribetnya (dulu) luar biasa. Saya mengakui. Jadi kepala prodi di mana-mana diminta data yang sama, overlap dengan prodi di bawah fakultas yang sama itu besar sekali. Meminta data yang sama again. Padahal data itu sudah ada di tingkat fakultas atau departemen. Tidak masuk akal,\" kata Nadiem.<br>\r\n<br>\r\n\"Jadi sekarang, untuk pertama kali, akreditasi itu bisa dilaksanakan di tingkat unit pengelola prodi tersebut, yaitu departemen, jurusan, sekolah, atau fakultas. Jadi dekannya saja yang repot, tetapi lebih efisien. Ini mengurangi sekali beban administrasi perguruan tinggi,\" pungkasnya.</p>', 'f20231202185917656b1c150136f.png', 't20231202185916656b1c14eb994.png', NULL, NULL, '2023-12-02 18:57:58', '2024-01-03 20:53:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukm`
--

CREATE TABLE `ukm` (
  `id` int(11) NOT NULL,
  `kodeprodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukmberita`
--

CREATE TABLE `ukmberita` (
  `id` int(11) NOT NULL,
  `ukmid` int(11) NOT NULL,
  `kodeprodi` varchar(10) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `level` varchar(2) DEFAULT NULL,
  `prodi` varchar(10) DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL DEFAULT 'aktif',
  `nama` varchar(255) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `create` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `prodi`, `jk`, `status`, `nama`, `foto`, `create`, `update`) VALUES
(1, 'admin', '$2y$10$Fl7Ad0RCTWPU8HEYy2aeUugOVQMfgJYn4jrxmLabHGgBzm4Y11MwG', 'SA', NULL, 'Laki-laki', 'aktif', 'Fasih Auladi 444', '20231202180319656b0ef797f69.jpg', '2023-10-01 04:25:09', '2023-12-02 18:03:19'),
(7, 'admin si', '123', 'AP', 'si', 'Laki-laki', 'aktif', 'Robi', '2023101020085265254ce40a799.jpg', '2023-10-10 20:08:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `npm` (`npm`);

--
-- Indeks untuk tabel `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `bidminat`
--
ALTER TABLE `bidminat`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `mutuid` (`mutuid`),
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `dosen_ibfk_1` (`bidminatid`),
  ADD KEY `dosen_ibfk_2` (`kodeprodi`);

--
-- Indeks untuk tabel `karyalab`
--
ALTER TABLE `karyalab`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kodelab` (`kodelab`),
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `karyapenelitian`
--
ALTER TABLE `karyapenelitian`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `nip` (`nip`),
  ADD KEY `kodeprodi` (`kodeprodi`),
  ADD KEY `katpenelitianid` (`katpenelitianid`);

--
-- Indeks untuk tabel `karyapengabdian`
--
ALTER TABLE `karyapengabdian`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `nip` (`nip`),
  ADD KEY `kodeprodi` (`kodeprodi`),
  ADD KEY `katpengabdianid` (`katpengabdianid`);

--
-- Indeks untuk tabel `katjabatan`
--
ALTER TABLE `katjabatan`
  ADD PRIMARY KEY (`kodejabatan`);

--
-- Indeks untuk tabel `katlab`
--
ALTER TABLE `katlab`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `katpenelitian`
--
ALTER TABLE `katpenelitian`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `katpengabdian`
--
ALTER TABLE `katpengabdian`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `labberita`
--
ALTER TABLE `labberita`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kodelab` (`kodelab`),
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`kodelab`) USING BTREE,
  ADD KEY `nip` (`nip`),
  ADD KEY `kodeprodi` (`kodeprodi`),
  ADD KEY `katlabid` (`katlabid`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`),
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `mutu`
--
ALTER TABLE `mutu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `pengabdianberita`
--
ALTER TABLE `pengabdianberita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kodejabatan` (`kodejabatan`);

--
-- Indeks untuk tabel `peta`
--
ALTER TABLE `peta`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `npm` (`npm`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`kodeprodi`) USING BTREE;

--
-- Indeks untuk tabel `prodiberita`
--
ALTER TABLE `prodiberita`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `prodiberita_ibfk_1` (`kodeprodi`);

--
-- Indeks untuk tabel `ukm`
--
ALTER TABLE `ukm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `ukmberita`
--
ALTER TABLE `ukmberita`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ukmid` (`ukmid`),
  ADD KEY `kodeprodi` (`kodeprodi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `bidminat`
--
ALTER TABLE `bidminat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `karyalab`
--
ALTER TABLE `karyalab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `karyapenelitian`
--
ALTER TABLE `karyapenelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `karyapengabdian`
--
ALTER TABLE `karyapengabdian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `katlab`
--
ALTER TABLE `katlab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `katpenelitian`
--
ALTER TABLE `katpenelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `katpengabdian`
--
ALTER TABLE `katpengabdian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `labberita`
--
ALTER TABLE `labberita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mutu`
--
ALTER TABLE `mutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pengabdianberita`
--
ALTER TABLE `pengabdianberita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peta`
--
ALTER TABLE `peta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `prodiberita`
--
ALTER TABLE `prodiberita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `ukm`
--
ALTER TABLE `ukm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ukmberita`
--
ALTER TABLE `ukmberita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bidminat`
--
ALTER TABLE `bidminat`
  ADD CONSTRAINT `bidminat_ibfk_1` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `dokumen_ibfk_3` FOREIGN KEY (`mutuid`) REFERENCES `mutu` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`bidminatid`) REFERENCES `bidminat` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyalab`
--
ALTER TABLE `karyalab`
  ADD CONSTRAINT `karyalab_ibfk_1` FOREIGN KEY (`kodelab`) REFERENCES `laboratorium` (`kodelab`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `karyalab_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyapenelitian`
--
ALTER TABLE `karyapenelitian`
  ADD CONSTRAINT `karyapenelitian_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `karyapenelitian_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `karyapenelitian_ibfk_3` FOREIGN KEY (`katpenelitianid`) REFERENCES `katpenelitian` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyapengabdian`
--
ALTER TABLE `karyapengabdian`
  ADD CONSTRAINT `karyapengabdian_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `karyapengabdian_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `karyapengabdian_ibfk_3` FOREIGN KEY (`katpengabdianid`) REFERENCES `katpengabdian` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `labberita`
--
ALTER TABLE `labberita`
  ADD CONSTRAINT `labberita_ibfk_1` FOREIGN KEY (`kodelab`) REFERENCES `laboratorium` (`kodelab`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `labberita_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD CONSTRAINT `laboratorium_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laboratorium_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laboratorium_ibfk_3` FOREIGN KEY (`katlabid`) REFERENCES `katlab` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengabdianberita`
--
ALTER TABLE `pengabdianberita`
  ADD CONSTRAINT `pengabdianberita_ibfk_1` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pengurus_ibfk_2` FOREIGN KEY (`kodejabatan`) REFERENCES `katjabatan` (`kodejabatan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peta`
--
ALTER TABLE `peta`
  ADD CONSTRAINT `peta_ibfk_1` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prodiberita`
--
ALTER TABLE `prodiberita`
  ADD CONSTRAINT `prodiberita_ibfk_1` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ukm`
--
ALTER TABLE `ukm`
  ADD CONSTRAINT `ukm_ibfk_1` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ukmberita`
--
ALTER TABLE `ukmberita`
  ADD CONSTRAINT `ukmberita_ibfk_1` FOREIGN KEY (`ukmid`) REFERENCES `ukm` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ukmberita_ibfk_2` FOREIGN KEY (`kodeprodi`) REFERENCES `prodi` (`kodeprodi`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
