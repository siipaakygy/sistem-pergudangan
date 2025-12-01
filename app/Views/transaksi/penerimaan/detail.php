<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Detail Penerimaan Barang</h4>
        <a href="<?= base_url('transaksi/penerimaan') ?>" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <div class="card-body">
        <!-- Info Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-sm table-bordered">
                    <tr><th width="150">Kode Transaksi</th><td><strong><?= $header['kode_masuk'] ?></strong></td></tr>
                    <tr><th>Tanggal Masuk</th><td><?= date('d/m/Y', strtotime($header['tanggal_masuk'])) ?></td></tr>
                    <tr><th>Status</th>
                        <td>
                            <?php if($header['status_masuk'] == 'pending'): ?>
                                <span class="badge badge-warning">Menunggu Approval</span>
                            <?php else: ?>
                                <span class="badge badge-success">Sudah Diapprove</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php if($header['tanggal_approve']): ?>
                    <tr><th>Tanggal Approve</th><td><?= date('d/m/Y', strtotime($header['tanggal_approve'])) ?></td></tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>

        <!-- Detail Barang -->
        <h5>Daftar Barang</h5>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($detail as $d): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['kode_barang'] ?></td>
                    <td><?= $d['name_barang'] ?></td>
                    <td><strong><?= $d['qty_masuk'] ?> pcs</strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tombol Approve (hanya muncul kalau pending & supervisor) -->
        <?php if($header['status_masuk'] == 'pending' && session('level_user') == 'supervisor'): ?>
        <div class="mt-4">
            <a href="<?= base_url('transaksi/penerimaan/approve/'.$header['id_barang_masuk']) ?>"
               class="btn btn-success btn-lg"
               onclick="return confirm('Yakin APPROVE transaksi ini? Stok akan bertambah!')">
                APPROVE TRANSAKSI INI
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>