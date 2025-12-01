<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Master Barang</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Barang
        </button>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Gudang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($barangs as $b): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($b['kode_barang']) ?></td>
                    <td><?= esc($b['name_barang']) ?></td>
                    <td><?= esc($b['name_gudang']) ?></td>
                    <td><?= esc($b['name_kategori_barang']) ?></td>
                    <td><?= esc($b['stok_barang']) ?></td>
                    <td><?= esc($b['satuan_barang']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $b['id_barang'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="<?= base_url('master/barang/delete/'.$b['id_barang']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                            <i class="fas fa-trash"></i>
                        </a>
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
        <form action="<?= base_url('master/barang') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang *</label>
                        <input type="text" name="name_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gudang *</label>
                        <select name="id_gudang" class="form-control" required>
                            <option value="">Pilih Gudang</option>
                            <?php foreach ($gudangs as $g): ?>
                                <option value="<?= $g['id_gudang'] ?>"><?= esc($g['name_gudang']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Barang *</label>
                        <select name="id_kategori_barang" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategoris as $k): ?>
                                <option value="<?= $k['id_kategori_barang'] ?>"><?= esc($k['name_kategori_barang']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Satuan Barang *</label>
                        <input type="text" name="satuan_barang" class="form-control" required placeholder="Contoh: PCS, KG">
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
<?php foreach ($barangs as $b): ?>
<div class="modal fade" id="editModal<?= $b['id_barang'] ?>">
    <div class="modal-dialog">
        <form action="<?= base_url('master/barang/update/'.$b['id_barang']) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang *</label>
                        <input type="text" name="name_barang" class="form-control" value="<?= esc($b['name_barang']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gudang *</label>
                        <select name="id_gudang" class="form-control" required>
                            <?php foreach ($gudangs as $g): ?>
                                <option value="<?= $g['id_gudang'] ?>" <?= $g['id_gudang'] == $b['id_gudang'] ? 'selected' : '' ?>><?= esc($g['name_gudang']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Barang *</label>
                        <select name="id_kategori_barang" class="form-control" required>
                            <?php foreach ($kategoris as $k): ?>
                                <option value="<?= $k['id_kategori_barang'] ?>" <?= $k['id_kategori_barang'] == $b['id_kategori_barang'] ? 'selected' : '' ?>><?= esc($k['name_kategori_barang']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Satuan Barang *</label>
                        <input type="text" name="satuan_barang" class="form-control" value="<?= esc($b['satuan_barang']) ?>" required>
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

<!-- SweetAlert -->
<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session('success')): ?>
        Swal.fire('Sukses!', '<?= session('success') ?>', 'success');
    <?php endif; ?>
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>