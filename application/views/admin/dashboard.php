<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color:rgb(110, 80, 80);
        }
        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-radius: 12px;
        }
        .card-header {
            background-color:rgb(1, 254, 241);
            border-bottom: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📋 Dashboard Admin</h3>
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-warning btn-sm">Logout</a>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">👥 Jumlah User</h5>
                    <p class="fs-4 mb-0"><?= count($users); ?> User</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">💰 Total Seluruh Transaksi</h5>
                    <p class="fs-4 mb-0">
                        Rp <?= number_format(array_sum(array_map(fn($u) => array_sum(array_column($u->transaksi, 'jumlah')), $users)), 0, ',', '.'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Diagram Batang -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">📊 Grafik Transaksi per User</h5>
            <canvas id="barChart" height="100"></canvas>
        </div>
    </div>

    <!-- Tombol tambah user -->
    <div class="mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahUser">+ Tambah User</button>
    </div>

    <!-- Daftar User -->
    <?php foreach($users as $user): ?>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong><?= $user->username; ?> <span class="badge bg-secondary"><?= ucfirst($user->role); ?></span></strong>
            <div>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditUser<?= $user->id; ?>">✏️ Edit</button>
                <a href="<?= site_url('admin/hapus_user/'.$user->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">🗑️ Hapus</a>
            </div>
        </div>
        <div class="card-body">
            <h6 class="fw-bold">Transaksi:</h6>
            <?php if (!empty($user->transaksi)): ?>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($user->transaksi as $trx): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y', strtotime($trx->tanggal)); ?></td>
                            <td><?= htmlspecialchars($trx->keterangan); ?></td>
                            <td>
                                <span class="badge bg-<?= $trx->jenis == 'Pemasukan' ? 'success' : 'danger'; ?>">
                                    <?= $trx->jenis; ?>
                                </span>
                            </td>
                            <td>Rp <?= number_format($trx->jumlah, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <p class="text-muted">Belum ada transaksi.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="modalEditUser<?= $user->id; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= site_url('admin/edit_user/'.$user->id); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Username</label>
                            <input type="text" name="username" value="<?= $user->username; ?>" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Role</label>
                            <select name="role" class="form-select" required>
                                <option value="admin" <?= $user->role == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="user" <?= $user->role == 'user' ? 'selected' : ''; ?>>User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= site_url('admin/tambah_user'); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    const users = <?= json_encode($users); ?>;
    const labels = users.map(user => user.username);
    const data = users.map(user =>
        user.transaksi.reduce((sum, trx) => sum + trx.jumlah, 0)
    );

    const colors = [
        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)',
        'rgba(255, 140, 0, 0.6)',  'rgba(100, 255, 218, 0.6)'
    ];

    const ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Transaksi',
                data: data,
                backgroundColor: colors.slice(0, labels.length),
                borderColor: colors.map(c => c.replace('0.6', '1')).slice(0, labels.length),
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: val => 'Rp ' + val.toLocaleString('id-ID')
                    }
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
