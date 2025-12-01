<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3>
                <p>Total Barang</p>
            </div>
            <div class="icon"><i class="fas fa-boxes"></i></div>
            <a href="#" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>0</h3>
                <p>Penerimaan Hari Ini</p>
            </div>
            <div class="icon"><i class="fas fa-truck-loading"></i></div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>0</h3>
                <p>Menunggu Approval</p>
            </div>
            <div class="icon"><i class="fas fa-clock"></i></div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>0</h3>
                <p>Surat Jalan Hari Ini</p>
            </div>
            <div class="icon"><i class="fas fa-truck"></i></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Selamat datang, <?= session('name_user') ?>!</h3>
    </div>
    <div class="card-body">
        <p>Level: <strong><?= ucfirst(session('level_user')) ?></strong></p>
        <p>Sistem Pergudangan siap digunakan.</p>
    </div>
</div>

<?= $this->endSection() ?>