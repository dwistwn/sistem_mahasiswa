<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2>Data Mahasiswa</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahMahasiswaModal">
                Tambah Mahasiswa
                </button>
                <a href="index.php" class="btn btn-secondary ml-2">Kembali ke Home</a>
            </div>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config.php';
                $stmt = $pdo->query("SELECT mahasiswa.id, mahasiswa.nama, mahasiswa.nim, jurusan.nama_jurusan, mahasiswa.id_jurusan FROM mahasiswa INNER JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id_jurusan");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama_jurusan']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editMahasiswaModal<?= $row['id']; ?>">Edit</button>
                        <a href="index.php?hapus_mahasiswa=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="editMahasiswaModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="editMahasiswaModalLabel<?= $row['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editMahasiswaModalLabel<?= $row['id']; ?>">Edit Data Mahasiswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="proses.php" method="post" name="edit_mahasiswa">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nim">NIM:</label>
                                        <input type="text" class="form-control" id="nim" name="nim" value="<?= $row['nim']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_jurusan">Jurusan:</label>
                                        <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                                            <?php
                                            $stmt_jurusan = $pdo->query("SELECT * FROM jurusan");
                                            while ($jurusan = $stmt_jurusan->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?= $jurusan['id_jurusan']; ?>" <?= ($row['id_jurusan'] == $jurusan['id_jurusan']) ? 'selected' : ''; ?>><?= $jurusan['nama_jurusan']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name="edit_mahasiswa">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="modal fade" id="tambahMahasiswaModal" tabindex="-1" aria-labelledby="tambahMahasiswaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Data Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="proses.php" method="post" name="tambah_mahasiswa">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM:</label>
                                <input type="text" class="form-control" id="nim" name="nim" required>
                            </div>
                            <div class="form-group">
                                <label for="jurusan_id">Jurusan:</label>
                                <select class="form-control" id="id_jurusan" name="id" required>
                                    <option value="">Pilih Jurusan</option>
                                    <?php
                                    $stmt_jurusan = $pdo->query("SELECT * FROM jurusan");
                                    while ($jurusan = $stmt_jurusan->fetch(PDO::FETCH_ASSOC)):
                                    ?>
                                    <option value="<?= $jurusan['id_jurusan']; ?>"><?= $jurusan['nama_jurusan']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" name="tambah_mahasiswa">Simpan</button>
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