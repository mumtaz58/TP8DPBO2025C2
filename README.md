**Janji**

Saya Armelia Zahrah Mumtaz dengan NIM 2300801 berjanji mengerjakan TP8 DPBO dengan keberkahan-Nya, maka saya tidak akan melakukan kecurangan sesuai yang telah di spesifikasikan, Aamiin

# Desain dan Alur Database Sistem Informasi Akademik

## Struktur Database

Database `db_mvc` dirancang untuk sistem informasi akademik dengan pola arsitektur MVC (Model-View-Controller). Database ini terdiri dari 3 tabel utama:

1. **Tabel `students`** - Menyimpan data mahasiswa
2. **Tabel `courses`** - Menyimpan data mata kuliah
3. **Tabel `student_courses`** - Menyimpan relasi antara mahasiswa dan mata kuliah (tabel junction)

## Penjelasan Tabel

### 1. Tabel `students`
- Menyimpan informasi mahasiswa
- Kolom:
  - `id` - Primary key, auto-increment
  - `name` - Nama mahasiswa
  - `nim` - Nomor Induk Mahasiswa
  - `phone` - Nomor telepon
  - `join_date` - Tanggal bergabung/masuk

### 2. Tabel `courses`
- Menyimpan informasi mata kuliah yang tersedia
- Kolom:
  - `id` - Primary key, auto-increment
  - `course_code` - Kode mata kuliah (contoh: "PPROG001")
  - `course_name` - Nama mata kuliah
  - `credits` - Jumlah SKS (Satuan Kredit Semester)

### 3. Tabel `student_courses`
- Tabel penghubung yang mengimplementasikan relasi many-to-many antara mahasiswa dan mata kuliah
- Kolom:
  - `id` - Primary key, auto-increment
  - `student_id` - Foreign key ke tabel students
  - `course_id` - Foreign key ke tabel courses
  - `semester` - Semester saat mata kuliah diambil

## Relasi Antar Tabel

1. **One-to-Many**: Satu mahasiswa dapat mengambil banyak mata kuliah
2. **One-to-Many**: Satu mata kuliah dapat diambil oleh banyak mahasiswa
3. **Many-to-Many**: Hubungan mahasiswa-mata kuliah diimplementasikan melalui tabel `student_courses`

## Constraint dan Integritas Data

- **Foreign Key Constraints**:
  - `student_courses.student_id` merujuk ke `students.id` dengan `ON DELETE CASCADE`
  - `student_courses.course_id` merujuk ke `courses.id` dengan `ON DELETE CASCADE`
  - Constraint ini memastikan bahwa jika mahasiswa atau mata kuliah dihapus, semua relasi terkait di tabel `student_courses` juga akan dihapus secara otomatis

## Alur Program

1. **Pendaftaran Mahasiswa**:
   - Data mahasiswa baru dimasukkan ke tabel `students`
   - Setiap mahasiswa memiliki NIM unik dan informasi kontak

2. **Pengelolaan Mata Kuliah**:
   - Informasi mata kuliah disimpan di tabel `courses`
   - Setiap mata kuliah memiliki kode unik, nama, dan jumlah SKS

3. **Pendaftaran Mata Kuliah**:
   - Ketika mahasiswa mendaftar untuk mata kuliah, data disimpan di tabel `student_courses`
   - Tabel ini mencatat mahasiswa mana yang mengambil mata kuliah apa pada semester tertentu

4. **Queries yang Memungkinkan**:
   - Melihat semua mata kuliah yang diambil seorang mahasiswa
   - Melihat semua mahasiswa yang mengambil mata kuliah tertentu
   - Mengelompokkan mahasiswa berdasarkan semester
   - Menghitung jumlah SKS yang diambil oleh seorang mahasiswa

