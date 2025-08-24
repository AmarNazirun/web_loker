-- Membuat database dan tabel-tabel yang diperlukan
CREATE DATABASE web_loker;
USE web_loker;

-- Tabel-tabel utama aplikasi web loker

CREATE TABLE data_calon (
    id_calon INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap TEXT,
    handphone VARCHAR(20),
    tempat_lahir TEXT,
    tanggal_lahir DATE,
    jenis_kelamin VARCHAR(10),
    agama VARCHAR(20),
    status_kawin VARCHAR(20),
    email TEXT,
    foto TEXT,
    username TEXT
);

CREATE TABLE data_perusahaan (
    id_perusahaan INT AUTO_INCREMENT PRIMARY KEY,
    nama_perusahaan TEXT,
    alamat TEXT,
    telepon VARCHAR(20),
    email TEXT,
    facebook TEXT,
    instagram TEXT,
    x TEXT, 
    website TEXT,
    logo TEXT,
    username TEXT,
    deskripsi TEXT
);

CREATE TABLE lowongan (
    id_lowongan INT AUTO_INCREMENT PRIMARY KEY,
    posisi TEXT,
    pendidikan_minimal TEXT,
    jenis_pekerjaan VARCHAR(50),
    gaji TEXT,
    tanggal_dibuka DATE,
    tanggal_ditutup DATE,
    deskripsi TEXT,
    status VARCHAR(15),
    id_perusahaan INT,
    FOREIGN KEY (id_perusahaan) REFERENCES data_perusahaan(id_perusahaan)
);

CREATE TABLE pelamar (
    id_pelamar INT AUTO_INCREMENT PRIMARY KEY,
    tanggal_melamar DATE,
    id_lowongan INT,
    id_calon INT,
    status_lamaran VARCHAR(15),
    FOREIGN KEY (id_lowongan) REFERENCES lowongan(id_lowongan),
    FOREIGN KEY (id_calon) REFERENCES data_calon(id_calon)
);

CREATE TABLE organisasi_calon (
    id_organisasi INT AUTO_INCREMENT PRIMARY KEY,
    lembaga TEXT,
    bidang TEXT,
    tahun_awal VARCHAR(4),
    tahun_akhir VARCHAR(4),
    negara_kota TEXT,
    id_calon INT,
    FOREIGN KEY (id_calon) REFERENCES data_calon(id_calon)
);

CREATE TABLE pendidikan_calon (
    id_pendidikan INT AUTO_INCREMENT PRIMARY KEY,
    lembaga TEXT,
    jurusan TEXT,
    tahun_awal VARCHAR(4),
    tahun_akhir VARCHAR(4),
    kota TEXT,
    lulus VARCHAR(10),
    gpa TEXT,
    id_calon INT,
    FOREIGN KEY (id_calon) REFERENCES data_calon(id_calon)
);

CREATE TABLE pengalaman_kerja (
    id_pengalaman INT AUTO_INCREMENT PRIMARY KEY,
    perusahaan TEXT,
    alamat_perusahaan TEXT,
    telepon VARCHAR(20),
    tahun_awal VARCHAR(4),
    tahun_akhir VARCHAR(4),
    posisi TEXT,
    tanggung_jawab TEXT,
    alasan_keluar TEXT,
    gaji_terakhir TEXT,
    id_calon INT,
    FOREIGN KEY (id_calon) REFERENCES data_calon(id_calon)
);

CREATE TABLE prestasi_calon (
    id_prestasi INT AUTO_INCREMENT PRIMARY KEY,
    lembaga TEXT,
    bidang TEXT,
    tahun_awal VARCHAR(4),
    tahun_akhir VARCHAR(4),
    negara_kota TEXT,
    id_calon INT,
    FOREIGN KEY (id_calon) REFERENCES data_calon(id_calon)
);

CREATE TABLE user (
    username TEXT PRIMARY KEY,
    password TEXT,
    level VARCHAR(15)
);
