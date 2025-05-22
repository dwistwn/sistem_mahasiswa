<?php
require 'config.php';

// Tampilkan pesan status jika ada (dari proses.php)
$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? urldecode($_GET['message']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jurusan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2>Data Jurusan</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal">
                Tambah Jurusan
                </button>
                <a href="index.php" class="btn btn-secondary ml-2">Kembali ke Home</a>
            </div>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Jurusan</th>
                    <th>Nama Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM jurusan");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= $row['id_jurusan']; ?></td>
                    <td><?= $row['nama_jurusan']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editJurusanModal<?= $row['id_jurusan']; ?>">Edit</button>
                        <a href="proses.php?hapus_jurusan=<?= $row['id_jurusan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="editJurusanModal<?= $row['id_jurusan']; ?>" tabindex="-1" aria-labelledby="editJurusanModalLabel<?= $row['id_jurusan']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editJurusanModalLabel<?= $row['id_jurusan']; ?>">Edit Data Jurusan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="proses.php" method="post" name="edit_jurusan">
                                <div class="modal-body">
                                    <input type="hidden" name="id_jurusan" value="<?= $row['id_jurusan']; ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama Jurusan:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama_jurusan']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name="edit_jurusan">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="modal fade" id="tambahJurusanModal" tabindex="-1" aria-labelledby="tambahJurusanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahJurusanModalLabel">Tambah Data Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="proses.php" method="post" name="tambah_jurusan">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Jurusan:</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" name="tambah_jurusan">Simpan</button>
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