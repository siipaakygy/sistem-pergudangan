<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Master User</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </div>

    <div class="card-body">
        <!-- Notifikasi -->
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <?= session('success') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <?= session('error') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $err): ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Phone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($users as $u): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($u['name_user']) ?></td>
                    <td><?= esc($u['username_user']) ?></td>
                    <td>
                        <span class="badge badge-<?= $u['level_user'] == 'superadmin' ? 'danger' : ($u['level_user'] == 'supervisor' ? 'warning' : 'info') ?>">
                            <?= ucfirst($u['level_user']) ?>
                        </span>
                    </td>
                    <td><?= esc($u['phone_user'] ?? '-') ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $u['id_user'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <?php if ($u['id_user'] != session('id_user')): ?>
                            <a href="<?= base_url('master/user/delete/'.$u['id_user']) ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Yakin hapus?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('master/user') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title">Tambah User Baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name_user" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" name="username_user" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_user" class="form-control" required minlength="6">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Level User <span class="text-danger">*</span></label>
                                <select name="level_user" class="form-control" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="superadmin">Superadmin</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No. HP (Opsional)</label>
                        <input type="text" name="phone_user" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<?php foreach ($users as $u): ?>
<div class="modal fade" id="editModal<?= $u['id_user'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('master/user/update/'.$u['id_user']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit User: <?= esc($u['name_user']) ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Sama seperti modal tambah, tapi value sudah terisi -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name_user" class="form-control" value="<?= esc($u['name_user']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" name="username_user" class="form-control" value="<?= esc($u['username_user']) ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password Baru <small>(kosongkan jika tidak ganti)</small></label>
                                <input type="password" name="password_user" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Level User <span class="text-danger">*</span></label>
                                <select name="level_user" class="form-control" required>
                                    <option value="superadmin" <?= $u['level_user'] == 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                                    <option value="supervisor" <?= $u['level_user'] == 'supervisor' ? 'selected' : '' ?>>Supervisor</option>
                                    <option value="admin" <?= $u['level_user'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="phone_user" class="form-control" value="<?= esc($u['phone_user'] ?? '') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection() ?>