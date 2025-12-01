<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= base_url() ?>" class="brand-link">
    <span class="brand-text font-weight-light"><i class="fas fa-warehouse"></i> Pergudangan</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

        <li class="nav-item">
          <a href="<?= base_url() ?>" class="nav-link <?= uri_string() == '' || uri_string() == '/' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <?php if (in_array(session('level_user'), ['superadmin'])): ?>
        <li class="nav-header">MASTER DATA</li>
        
        <li class="nav-item">
          <a href="<?= base_url('master/user') ?>" class="nav-link <?= uri_string() == 'master/user' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Master User</p>
          </a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
          <a href="<?= base_url('master/gudang') ?>" class="nav-link <?= uri_string() == 'master/gudang' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-building"></i>
            <p>Master Gudang</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('master/kategori') ?>" class="nav-link <?= uri_string() == 'master/kategori' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tags"></i>
            <p>Master Kategori</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('master/barang') ?>" class="nav-link <?= uri_string() == 'master/barang' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-boxes"></i>
            <p>Master Barang</p>
          </a>
        </li>

        <li class="nav-header">TRANSAKSI</li>

        <li class="nav-item">
          <a href="<?= base_url('penerimaan') ?>" class="nav-link <?= uri_string() == 'penerimaan' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-truck-loading"></i>
            <p>Barang Masuk</p>
            <?php if ($pending_penerimaan ?? 0 > 0): ?>
              <span class="right badge badge-danger"><?= $pending_penerimaan ?></span>
            <?php endif; ?>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('surat-jalan') ?>" class="nav-link <?= uri_string() == 'surat-jalan' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-truck"></i>
            <p>Barang Keluar</p>
            <?php if ($pending_sj ?? 0 > 0): ?>
              <span class="right badge badge-danger"><?= $pending_sj ?></span>
            <?php endif; ?>
          </a>
        </li>

        <li class="nav-header">AKUN</li>
        <li class="nav-item">
          <a href="<?= base_url('master/user') ?>" class="nav-link <?= uri_string() == 'master/user' ? 'active' : '' ?>">
    <i class="nav-icon fas fa-users"></i>
    <p>Master User</p>
</a>
        </li>
      </ul>
    </nav>
  </div>
</aside>