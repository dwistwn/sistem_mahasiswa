<?php
require 'config.php';

// === Mahasiswa ===
if (isset($_POST['tambah_mahasiswa'])) {
    $sql = "INSERT INTO mahasiswa (nama, nim, id_jurusan) VALUES (:nama, :nim, :id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nama' => $_POST['nama'],
        ':nim' => $_POST['nim'],
        ':id' => $_POST['id']
    ]);
    header("Location: mahasiswa.php");
    exit();
}

if (isset($_POST['edit_mahasiswa'])) {
    $sql = "UPDATE mahasiswa SET nama = :nama, nim = :nim, id_jurusan = :id_jurusan WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nama' => $_POST['nama'],
        ':nim' => $_POST['nim'],
        ':id_jurusan' => $_POST['id_jurusan'],
        ':id' => $_POST['id']
    ]);
    header("Location: mahasiswa.php");
    exit();
}

if (isset($_GET['hapus_mahasiswa'])) {
    $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
    $stmt->execute([':id' => $_GET['hapus_mahasiswa']]);
    header("Location: mahasiswa.php");
    exit();
}

// === Jurusan ===
if (isset($_POST['tambah_jurusan'])) {
    $stmt = $pdo->prepare("INSERT INTO jurusan (nama_jurusan) VALUES (:nama)");
    if ($stmt->execute([':nama' => $_POST['nama']])) {
        header("Location: jurusan.php");
        exit();
    } else {
        header("Location: jurusan.php");
        exit();
    }
}

if (isset($_POST['edit_jurusan'])) {
    $stmt = $pdo->prepare("UPDATE jurusan SET nama_jurusan = :nama WHERE id_jurusan = :id_jurusan");
    if ($stmt->execute([
        ':nama' => $_POST['nama'],
        ':id_jurusan' => $_POST['id_jurusan']
    ])) {
        header("Location: jurusan.php");
        exit();
    } else {
        header("Location: jurusan.php");
        exit();
    }
}

if (isset($_GET['hapus_jurusan'])) {
    $stmt = $pdo->prepare("DELETE FROM jurusan WHERE id_jurusan = :id_jurusan");
    if ($stmt->execute([':id_jurusan' => $_GET['hapus_jurusan']])) {
        header("Location: jurusan.php");
        exit();
    } else {
        header("Location: jurusan.php");
        exit();
    }
}

// === Mata Kuliah ===
if (isset($_POST['tambah_matakuliah'])) {
    $stmt = $pdo->prepare("INSERT INTO mata_kuliah (nama_mk, sks) VALUES (:nama, :sks)");
    $stmt->execute([
        ':nama' => $_POST['nama'],
        ':sks' => $_POST['sks'] 
    ]);
    header("Location: matakuliah.php");
    exit();
}

if (isset($_POST['edit_matakuliah'])) {
    $stmt = $pdo->prepare("UPDATE mata_kuliah SET nama_mk = :nama, sks = :sks WHERE id_mk = :id");
    $stmt->execute([
        ':nama' => $_POST['nama'],
        ':sks' => $_POST['sks'], 
        ':id' => $_POST['id_mk']
    ]);
    header("Location: matakuliah.php");
    exit();
}

if (isset($_GET['hapus_matakuliah'])) {
    $stmt = $pdo->prepare("DELETE FROM mata_kuliah WHERE id_mk = :id_mk");
    $stmt->execute([':id_mk' => $_GET['hapus_matakuliah']]);
    header("Location: matakuliah.php");
    exit();
}

// === Nilai ===
if (isset($_POST['tambah_nilai'])) {
    $stmt = $pdo->prepare("INSERT INTO nilai (id_mhs, id_mk, nilai) VALUES (:mhs, :mk, :nilai)");
    $stmt->execute([
        ':mhs' => $_POST['id_mhs'],
        ':mk' => $_POST['id_mk'],
        ':nilai' => $_POST['nilai']
    ]);
    header("Location: nilai.php");
    exit();
}

if (isset($_POST['edit_nilai'])) {
    $stmt = $pdo->prepare("UPDATE nilai SET id_mhs = :mhs, id_mk = :mk, nilai = :nilai WHERE id_nilai = :id_nilai");
    $stmt->execute([
        ':mhs' => $_POST['id_mhs'],
        ':mk' => $_POST['id_mk'],
        ':nilai' => $_POST['nilai'],
        ':id_nilai' => $_POST['id_nilai']
    ]);
    header("Location: nilai.php");
    exit();
}

if (isset($_GET['hapus_nilai'])) {
    $stmt = $pdo->prepare("DELETE FROM nilai WHERE id_nilai = :id_nilai");
    $stmt->execute([':id_nilai' => $_GET['hapus_nilai']]);
    header("Location: nilai.php");
    exit();
}
?>