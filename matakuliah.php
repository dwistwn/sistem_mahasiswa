<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2>Data Matakuliah</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahMatakuliahModal">
                Tambah Mata Kuliah
                </button>
                <a href="index.php" class="btn btn-secondary ml-2">Kembali ke Home</a>
            </div>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config.php';
                $stmt = $pdo->query("SELECT * FROM mata_kuliah");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= $row['id_mk']; ?></td>
                    <td><?= $row['nama_mk']; ?></td>
                    <td><?= $row['sks']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editMatakuliahModal<?= $row['id_mk']; ?>">Edit</button>
                        <a href="proses.php?hapus_matakuliah=<?= $row['id_mk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="editMatakuliahModal<?= $row['id_mk']; ?>" tabindex="-1" aria-labelledby="editMatakuliahModalLabel<?= $row['id_mk']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editMatakuliahModalLabel<?= $row['id_mk']; ?>">Edit Data Mata Kuliah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="proses.php" method="post" name="edit_matakuliah">                                
                                <div class="modal-body">
                                    <input type="hidden" name="id_mk" value="<?= $row['id_mk']; ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama Mata Kuliah:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama_mk']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sks">SKS:</label>
                                        <input type="number" class="form-control" id="sks" name="sks" value="<?= $row['sks']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" name="edit_matakuliah">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="modal fade" id="tambahMatakuliahModal" tabindex="-1" aria-labelledby="tambahMatakuliahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMatakuliahModalLabel">Tambah Data Mata Kuliah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="proses.php" method="post" name="tambah_matakuliah">                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Mata Kuliah:</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="sks">SKS:</label>
                                <input type="number" class="form-control" id="sks" name="sks" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" name="tambah_matakuliah">Simpan</button>
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