<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Barang Keluar / Surat Jalan</h3>
        <a href="<?= base_url('transaksi/surat-jalan/create') ?>" class="btn btn-primary">+ Tambah</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>No</th><th>Kode</th><th>Tanggal</th><th>Status</th><th>Counter</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($keluar as $k): 
                    $hari = $k['status_keluar']=='pending' ? floor((time()-strtotime($k['created_at']))/86400) : 0;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $k['kode_keluar'] ?></strong></td>
                    <td><?= date('d/m/Y', strtotime($k['tanggal_keluar'])) ?></td>
                    <td>
                        <?= $k['status_keluar']=='pending' ? '<span class="badge badge-warning">Pending</span>' : '<span class="badge badge-success">Approved</span>' ?>
                    </td>
                    <td>
                        <?= $k['status_keluar']=='pending' && $hari>=2 ? '<span class="badge badge-danger">'.$hari.' hari</span>' : ($k['status_keluar']=='pending' ? $hari.' hari' : '') ?>
                    </td>
                    <td>
                        <?php if($k['status_keluar']=='pending' && session('level_user')=='supervisor'): ?>
                            <a href="<?= base_url('transaksi/surat-jalan/approve/'.$k['id_barang_keluar']) ?>" 
                               class="btn btn-success btn-sm" onclick="return confirm('Approve?')">Approve</a>
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