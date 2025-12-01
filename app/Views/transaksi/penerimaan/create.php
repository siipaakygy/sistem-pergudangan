<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header"><h4>Tambah Barang Masuk</h4></div>
    <div class="card-body">
        <form action="<?= base_url('transaksi/penerimaan/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-6">
                    <label>Kode Transaksi</label>
                    <input type="text" class="form-control" value="<?= $kode ?>" readonly>
                    <input type="hidden" name="kode_masuk" value="<?= $kode ?>">
                </div>
                <div class="col-md-6">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
            </div>
            <hr>
            <table class="table table-bordered" id="tabelItem">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th><button type="button" class="btn btn-success btn-sm" onclick="tambahBaris()">+</button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="items[0][id_barang]" class="form-control" required>
                                <option value="">Pilih Barang</option>
                                <?php foreach($barangs as $b): ?>
                                    <option value="<?= $b['id_barang'] ?>"><?= $b['kode_barang'] ?> - <?= $b['name_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" name="items[0][qty]" class="form-control" min="1" required></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Simpan & Kirim Approval</button>
        </form>
    </div>
</div>

<script>
let i = 1;
function tambahBaris() {
    $('#tabelItem tbody').append(`
        <tr>
            <td>
                <select name="items[${i}][id_barang]" class="form-control" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach($barangs as $b): ?>
                        <option value="<?= $b['id_barang'] ?>"><?= $b['kode_barang'] ?> - <?= $b['name_barang'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="number" name="items[${i}][qty]" class="form-control" min="1" required></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()">–</button></td>
        </tr>
    `);
    i++;
}
</script>
<?= $this->endSection() ?>