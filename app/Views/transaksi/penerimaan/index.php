<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Barang Masuk</h3>
        <a href="<?= base_url('transaksi/penerimaan/create') ?>" class="btn btn-primary">
            + Tambah Barang Masuk
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Dibuat Oleh</th>
                    <th>Status</th>
                    <th>Counter</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($masuk as $m): 
                    $hari = $m['status_masuk']=='pending' ? floor((time() - strtotime($m['created_at'])) / 86400) : 0;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $m['kode_masuk'] ?></strong></td>
                    <td><?= date('d/m/Y', strtotime($m['tanggal_masuk'])) ?></td>
                    <td><?= $m['pembuat'] ?? '-' ?></td>
                    <td>
                        <?php if($m['status_masuk']=='pending'): ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php else: ?>
                            <span class="badge badge-success">Approved</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($m['status_masuk']=='pending' && $hari >= 2): ?>
                            <span class="badge badge-danger"><?= $hari ?> hari</span>
                        <?php elseif($m['status_masuk']=='pending'): ?>
                            <span class="badge badge-warning"><?= $hari ?> hari</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('transaksi/penerimaan/detail/'.$m['id_barang_masuk']) ?>" class="btn btn-sm btn-info">Detail</a>
                        <?php if($m['status_masuk']=='pending' && session('level_user')=='supervisor'): ?>
                            <a href="<?= base_url('transaksi/penerimaan/approve/'.$m['id_barang_masuk']) ?>" 
                               class="btn btn-sm btn-success" onclick="return confirm('Approve sekarang?')">Approve</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>$(document).ready(function(){ $('#table').DataTable(); });</script>
<?= $this->endSection() ?>