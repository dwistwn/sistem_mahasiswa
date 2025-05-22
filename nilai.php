<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2>Data Nilai</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahNilaiModal">
                Tambah Nilai
                </button>
                <a href="index.php" class="btn btn-secondary ml-2">Kembali ke Home</a>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config.php';
                $stmt = $pdo->query("
                    SELECT nilai.id_nilai AS id, mahasiswa.nama AS nama_mahasiswa, mata_kuliah.nama_mk, nilai.nilai,
                           mahasiswa.id AS mahasiswa_id, mata_kuliah.id_mk AS matakuliah_id
                    FROM nilai
                    INNER JOIN mahasiswa ON nilai.id_mhs = mahasiswa.id
                    INNER JOIN mata_kuliah ON nilai.id_mk = mata_kuliah.id_mk
                ");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama_mahasiswa']; ?></td>
                    <td><?= $row['nama_mk']; ?></td>
                    <td><?= $row['nilai']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editNilaiModal<?= $row['id']; ?>">Edit</button>
                        <a href="proses.php?hapus_nilai=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="editNilaiModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="editNilaiModalLabel<?= $row['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editNilaiModalLabel<?= $row['id']; ?>">Edit Data Nilai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="proses.php" method="post" name="edit_nilai">
                                <div class="modal-body">
                                    <input type="hidden" name="id_nilai" value="<?= $row['id']; ?>">
                                    <div class="form-group">
                                        <label for="id_mhs">Mahasiswa:</label>
                                        <select class="form-control" id="id_mhs" name="id_mhs" required>
                                            <option value="">Pilih Mahasiswa</option>
                                            <?php
                                            $stmt_mhs = $pdo->query("SELECT * FROM mahasiswa");
                                            while ($mhs = $stmt_mhs->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?= $mhs['id']; ?>" <?= ($row['mahasiswa_id'] == $mhs['id']) ? 'selected' : ''; ?>><?= $mhs['nama']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_mk">Mata Kuliah:</label>
                                        <select class="form-control" id="id_mk" name="id_mk" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            <?php
                                            $stmt_mk = $pdo->query("SELECT * FROM mata_kuliah");
                                            while ($mk = $stmt_mk->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?= $mk['id_mk']; ?>" <?= ($row['matakuliah_id'] == $mk['id_mk']) ? 'selected' : ''; ?>><?= $mk['nama_mk']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nilai">Nilai:</label>
                                        <input type="number" class="form-control" id="nilai" name="nilai" value="<?= $row['nilai']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name="edit_nilai">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="modal fade" id="tambahNilaiModal" tabindex="-1" aria-labelledby="tambahNilaiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahNilaiModalLabel">Tambah Data Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="proses.php" method="post" name="tambah_nilai">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_mhs">Mahasiswa:</label>
                                <select class="form-control" id="id_mhs" name="id_mhs" required>
                                    <option value="">Pilih Mahasiswa</option>
                                    <?php
                                    $stmt_mhs = $pdo->query("SELECT * FROM mahasiswa");
                                    while ($mhs = $stmt_mhs->fetch(PDO::FETCH_ASSOC)):
                                    ?>
                                    <option value="<?= $mhs['id']; ?>"><?= $mhs['nama']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_mk">Mata Kuliah:</label>
                                <select class="form-control" id="id_mk" name="id_mk" required>
                                    <option value="">Pilih Mata Kuliah</option>
                                    <?php
                                    $stmt_mk = $pdo->query("SELECT * FROM mata_kuliah");
                                    while ($mk = $stmt_mk->fetch(PDO::FETCH_ASSOC)):
                                    ?>
                                    <option value="<?= $mk['id_mk']; ?>"><?= $mk['nama_mk']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nilai">Nilai:</label>
                                <input type="number" class="form-control" id="nilai" name="nilai" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>