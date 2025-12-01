<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="row">

    <!-- TOTAL BARANG -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_barang ?></h3>
                <p>Total Barang</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
            <a href="<?= base_url('master/barang') ?>" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- PENERIMAAN HARI INI -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $penerimaan_hari_ini ?></h3>
                <p>Penerimaan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-truck-loading"></i>
            </div>
            <a href="<?= base_url('transaksi/penerimaan') ?>" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- MENUNGGU APPROVAL -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $menunggu_approval ?></h3>
                <p>Menunggu Approval</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="<?= base_url('transaksi/penerimaan') ?>" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- SURAT JALAN HARI INI -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $suratjalan_hari_ini ?></h3>
                <p>Surat Jalan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-truck"></i>
            </div>
            <a href="<?= base_url('transaksi/surat-jalan') ?>" class="small-box-footer">
                Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<!-- SELAMAT DATANG -->
<div class="mt-4">
    <div class="alert alert-info alert-dismissible">
        <h5><i class="icon fas fa-user"></i> Selamat datang, <?= session('name_user') ?>!</h5>
        <p>Level: <strong><?= ucfirst(session('level_user')) ?></strong> • Sistem Pergudangan siap digunakan.</p>
    </div>
</div>

<?= $this->endSection() ?>