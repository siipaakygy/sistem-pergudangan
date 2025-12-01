<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Master Kategori Barang</h4>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal">
            Tambah Kategori
        </button>
    </div>
    <div class="card-body">
        <?php if (session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session('success') ?><button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        <?php endif ?>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th width="8%">No</th>
                    <th>Kode</th>
                    <th>Nama Kategori</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($kategoris as $k): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= esc($k['kode_kategori_barang']) ?></strong></td>
                    <td><?= esc($k['name_kategori_barang']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" 
                                data-target="#editModal<?= $k['id_kategori_barang'] ?>">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="<?= base_url('master/kategori/delete/'.$k['id_kategori_barang']) ?>" 
                           class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus <?= esc($k['name_kategori_barang']) ?>?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $k['id_kategori_barang'] ?>">
                    <div class="modal-dialog">
                        <form action="<?= base_url('master/kategori/update/'.$k['id_kategori_barang']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h5>Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Kode Kategori</label>
                                        <input type="text" class="form-control" value="<?= esc($k['kode_kategori_barang']) ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" name="name_kategori_barang" class="form-control" 
                                               value="<?= esc($k['name_kategori_barang']) ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah (tetap seperti semula) -->
<div class="modal fade" id="tambahModal">
    <div class="modal-dialog">
        <form action="<?= base_url('master/kategori') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5>Tambah Kategori Baru</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="name_kategori_barang" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>