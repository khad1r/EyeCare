<div style="width: 60vw;" class="mx-auto">
    <div class="mb-5 mt-lg-0 mx-auto text-center">
        <h2><strong>Sistem Identifikasi Penyakit Mata</strong></h2>
    </div>
    <div class="mt-2 mb-5 mt-lg-0 mx-auto" style="width: 70%;">
        <form method="get">
            <input type="hidden" name="page" value="hasil">
            <div class="input-group mb-3">
                <span class="input-group-text">Nomor Registrasi</span>
                <input type="text" name="noreg" class="form-control" required>
                <input class="btn btn-outline-secondary" type="submit" class="btn w-100">
            </div>
        </form>
    </div>
    <div class="mt-5 mt-lg-0 mx-auto text-center">
        <h3><strong>Jenis Retinopathy</strong></h3>
    </div>
    <div class="mt-2 mx-auto">
        <table class="table table-responsive table-hover table-sm table-bordered mb-5 tabel-mata">
            <?php
            $sql = mysqli_query($koneksi, "SELECT * FROM deskripsi_penyakit") or die(mysqli_error($koneksi));
            while ($data = mysqli_fetch_assoc($sql)) {
            ?>
                <tr>
                    <td width="20%"><img src="./images/<?= $data['gambar'] ?>" alt=""></td>
                    <td width="20%"><?= $data['penyakit'] ?></td>
                    <td width="60%"><?= $data['penjelasan'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>