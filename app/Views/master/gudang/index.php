<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Master Gudang</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Gudang
        </button>
    </div>

    <div class="card-body">
        <?php if (session('success')): ?>
            <script>Swal.fire('Sukses!', '<?= session('success') ?>', 'success');</script>
        <?php endif; ?>
        <?php if (session('errors')): ?>
            <script>
                let msg = '<ul>';
                <?php foreach (session('errors') as $e): ?>
                    msg += '<li><?= addslashes($e) ?></li>';
                <?php endforeach; ?>
                msg += '</ul>';
                Swal.fire('Gagal!', msg, 'error');
            </script>
        <?php endif; ?>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Gudang</th>
                    <th>Nama Gudang</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($gudangs as $g): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= esc($g['kode_gudang']) ?></strong></td>
                    <td><?= esc($g['name_gudang']) ?></td>
                    <td><?= esc($g['lokasi_gudang'] ?? '-') ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $g['id_gudang'] ?>">Edit</button>
                        <a href="<?= base_url('master/gudang/delete/'.$g['id_gudang']) ?>" 
                           class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal">
    <div class="modal-dialog">
        <form action="<?= base_url('master/gudang') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5>Tambah Gudang Baru</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Gudang <span class="text-danger">*</span></label>
                        <input type="text" name="name_gudang" class="form-control" required minlength="3">
                    </div>
                    <div class="form-group">
                        <label>Lokasi Gudang</label>
                        <textarea name="lokasi_gudang" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($gudangs as $g): ?>
<div class="modal fade" id="edit<?= $g['id_gudang'] ?>">
    <div class="modal-dialog">
        <form action="<?= base_url('master/gudang/update/'.$g['id_gudang']) ?>" method="post">
            <?= csrf_field() ?> <input type="hidden" name="_method" value="PATCH">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5>Edit: <?= esc($g['name_gudang']) ?></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Gudang</label>
                        <input type="text" name="name_gudang" class="form-control" value="<?= esc($g['name_gudang']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Lokasi Gudang</label>
                        <textarea name="lokasi_gudang" class="form-control" rows="3"><?= esc($g['lokasi_gudang']) ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>