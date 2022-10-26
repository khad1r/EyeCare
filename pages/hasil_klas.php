<div class="col-sm me-auto">
    <h2><strong> Hasil Klasifikasi Penyakit Mata </strong></h2>
</div>
<hr>
<?php
if (isset($_GET['noreg'])) {
    $noreg = sanitizeQuery($koneksi, $_GET['noreg']);
    $noreg          = sprintf("%015d", $noreg);
    $sql = mysqli_query($koneksi, "SELECT * FROM pasien WHERE no_registrasi='$noreg'") or die(mysqli_error($koneksi));
    $hasil = mysqli_fetch_assoc($sql);
    $klasifikasi = explode('~', $hasil['klasifikasi']);
    $file = explode('~', $hasil['foto_fundus']);
?>
<div class="row mt-5">
    <div class="col-md-5">
        <div class="mt-2 mb-5 mt-lg-0 mx-auto " style="width: 100%;">
            <div class="input-group mb-3">
                <span class="input-group-text">Nomor Registrasi</span>
                <input type="number" name="noreg" value='<?= $noreg; ?>' class="form-control" readonly>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Nama</span>
                <input type="text" name="nama" value='<?= $hasil['nama']; ?>' class="form-control" readonly>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Umur</span>
                <input type="number" name="umur" value='<?= $hasil['umur']; ?>' class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="klasifikasi_kiri" id="klasifikasi_kiri" value='<?= $klasifikasi[0]; ?>'
                    class="form-control" readonly>
                <img src="images/<?= $file[0]; ?>" class="img-responsive" id="kiri" style="width:100%">
            </div>
            <div class="col-md-6">
                <input type="text" name="klasifikasi_kanan" id="klasifikasi_kanan" value='<?= $klasifikasi[1]; ?>'
                    class="form-control" readonly>
                <img src="images/<?= $file[1]; ?>" class="img-responsive" id="kanan" style="width:100%">
            </div>
        </div>
    </div>
</div>
<?php
}
?>