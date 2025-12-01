<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header bg-danger text-white">
        <h4><i class="fas fa-truck"></i> Tambah Surat Jalan / Barang Keluar</h4>
    </div>

    <div class="card-body">
        <form action="<?= base_url('transaksi/surat-jalan/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Surat Jalan</label>
                        <input type="text" class="form-control bg-light" value="<?= $kode ?>" readonly>
                        <input type="hidden" name="kode_keluar" value="<?= $kode ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
            </div>

            <hr>
            <h5 class="mb-3">
                <i class="fas fa-boxes"></i> Daftar Barang yang Akan Dikeluarkan
                <button type="button" class="btn btn-success btn-sm float-right" onclick="tambahBaris()">
                    <i class="fas fa-plus"></i> Tambah Barang
                </button>
            </h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabelItem">
                    <thead class="thead-dark">
                        <tr>
                            <th width="40%">Barang</th>
                            <th width="15%">Stok Tersedia</th>
                            <th width="20%">Qty Keluar</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="items[0][id_barang]" class="form-control select-barang" required onchange="updateStok(this)">
                                    <option value="">— Pilih Barang —</option>
                                    <?php foreach($barangs as $b): ?>
                                        <option value="<?= $b['id_barang'] ?>" data-stok="<?= $b['stok_barang'] ?>">
                                            <?= $b['kode_barang'] ?> - <?= $b['name_barang'] ?> (Stok: <?= $b['stok_barang'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="text-center align-middle">
                                <span class="stok-display">0</span>
                            </td>
                            <td>
                                <input type="number" name="items[0][qty]" class="form-control qty-input" min="1" required placeholder="Jumlah">
                            </td>
                            <td class="text-center align-middle"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-danger btn-lg">
                    <i class="fas fa-paper-plane"></i> Simpan & Kirim Approval Supervisor
                </button>
                <a href="<?= base_url('transaksi/surat-jalan') ?>" class="btn btn-secondary btn-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Counter untuk index baris
let index = 1;

function tambahBaris() {
    const tableBody = document.querySelector('#tabelItem tbody');
    const row = document.createElement('tr');

    row.innerHTML = `
        <td>
            <select name="items[${index}][id_barang]" class="form-control select-barang" required onchange="updateStok(this)">
                <option value="">— Pilih Barang —</option>
                <?php foreach($barangs as $b): ?>
                    <option value="<?= $b['id_barang'] ?>" data-stok="<?= $b['stok_barang'] ?>">
                        <?= $b['kode_barang'] ?> - <?= $b['name_barang'] ?> (Stok: <?= $b['stok_barang'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td class="text-center align-middle"><span class="stok-display">0</span></td>
        <td><input type="number" name="items[${index}][qty]" class="form-control qty-input" min="1" required></td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tableBody.appendChild(row);
    index++;
}

function updateStok(select) {
    const stok = select.options[select.selectedIndex].dataset.stok || 0;
    const row = select.closest('tr');
    row.querySelector('.stok-display').textContent = stok;
    
    // Reset qty kalau ganti barang
    row.querySelector('.qty-input').value = '';
}
</script>

<style>
.select-barang { font-size: 0.95rem; }
.qty-input { text-align: center; }
</style>

<?= $this->endSection() ?>