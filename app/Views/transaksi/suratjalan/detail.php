<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-danger text-white">
        <h4>Detail Surat Jalan: <?= $header['kode_keluar'] ?></h4>
    </div>
    <div class="card-body">
        <p><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($header['tanggal_keluar'])) ?></p>
        <p><strong>Status:</strong> 
            <?php if($header['status_keluar'] == 'pending'): ?>
                <span class="badge badge-warning">Pending</span>
            <?php else: ?>
                <span class="badge badge-success">Approved</span>
            <?php endif; ?>
        </p>

        <h5>Daftar Barang</h5>
        <table class="table table-bordered">
            <thead>
                <tr><th>Kode</th><th>Nama Barang</th><th>Qty Keluar</th></tr>
            </thead>
            <tbody>
                <?php foreach($detail as $d): ?>
                <tr>
                    <td><?= $d['kode_barang'] ?></td>
                    <td><?= $d['name_barang'] ?></td>
                    <td><strong><?= $d['qty_keluar'] ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if($header['status_keluar'] == 'pending' && session('level_user') == 'supervisor'): ?>
        <a href="<?= base_url('transaksi/surat-jalan/approve/'.$header['id_barang_keluar']) ?>"
           class="btn btn-success btn-lg" onclick="return confirm('Yakin APPROVE? Stok akan berkurang!')">
           APPROVE SEKARANG
        </a>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>