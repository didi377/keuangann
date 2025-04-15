<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
    <h3 class="mb-4">📋 Dashboard Admin</h3>
    <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-outline-danger btn-sm">Logout</a>

    <!-- Tombol tambah user -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahUser">+ Tambah User</button>

    <!-- Daftar User -->
    <?php foreach($users as $user): ?>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong><?= $user->username; ?> (<?= $user->role; ?>)</strong>
            <div>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditUser<?= $user->id; ?>">✏️</button>
                <a href="<?= site_url('admin/hapus_user/'.$user->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">🗑️</a>
            </div>
        </div>
        <div class="card-body">
            <h6>Transaksi:</h6>
            <?php if (!empty($user->transaksi)): ?>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
