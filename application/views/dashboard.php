<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color:rgb(49, 239, 175);
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color:rgb(122, 175, 158);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
            color: #333;
        }
        .summary-card {
            border-radius: 20px;
            background: #fff;
            padding: 20px;
            box-shadow: 5px 5px 15px #d1d9e6, -5px -5px 15px #ffffff;
            text-align: center;
            transition: 0.3s;
        }
        .summary-card:hover {
            transform: translateY(-3px);
        }
        .summary-card h6 {
            color: #888;
        }
        .summary-card h4 {
            margin-top: 0.5rem;
        }
        .summary-income { color: #28a745; }
        .summary-expense { color: #dc3545; }
        .summary-balance { color: #0d6efd; }
        .btn-add {
            border-radius: 30px;
        }
        .table thead {
            background-color:rgb(105, 168, 231);
        }
        .btn-action .btn {
            padding: 4px 8px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">📒 KeuanganKu</a>
        <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    <!-- Tabel Transaksi -->
        <div class="card p-3 border-0 shadow-sm mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">📋 Riwayat Transaksi</h5>
                <a href="<?php echo site_url('keuangan/tambah'); ?>" class="btn btn-primary btn-sm btn-add">+ Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Jumlah (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksi)): ?>
                            <?php $no = 1; foreach ($transaksi as $item): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo date('d M Y', strtotime($item->tanggal)); ?></td>
                                    <td><?php echo htmlspecialchars($item->keterangan); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo ($item->jenis == 'Pemasukan') ? 'success' : 'danger'; ?>">
                                            <?php echo $item->jenis; ?>
                                        </span>
                                    </td>
                                    <td><?php echo number_format($item->jumlah, 0, ',', '.'); ?></td>
                                    <td class="btn-action">
                                        <a href="<?php echo site_url('keuangan/edit/'.$item->id); ?>" class="btn btn-outline-warning btn-sm">✏️</a>
                                        <a href="<?php echo site_url('keuangan/hapus/'.$item->id); ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">🗑️</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada transaksi.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Ringkasan di bawah -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-3">
            <div class="summary-card">
                <h6>Total Pemasukan</h6>
                <h4 class="summary-income">Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></h4>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="summary-card">
                <h6>Total Pengeluaran</h6>
                <h4 class="summary-expense">Rp <?php echo number_format($total_pengeluaran, 0, ',', '.'); ?></h4>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="summary-card">
                <h6>Saldo Akhir</h6>
                <h4 class="summary-balance">Rp <?php echo number_format($saldo, 0, ',', '.'); ?></h4>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
