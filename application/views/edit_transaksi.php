<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .form-label {
            font-weight: 500;
        }
        .btn {
            border-radius: 30px;
            padding: 8px 20px;
        }
        .btn-primary {
            background-color: #0d6efd;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card p-4">
                <h4 class="mb-4 text-center text-primary">✏️ Edit Transaksi</h4>
                <form method="post">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $transaksi->tanggal; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $transaksi->keterangan; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-select" id="jenis" name="jenis" required>
                            <option value="Pemasukan" <?php echo ($transaksi->jenis == 'Pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                            <option value="Pengeluaran" <?php echo ($transaksi->jenis == 'Pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $transaksi->jumlah; ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo site_url('keuangan'); ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
