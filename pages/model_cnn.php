<?php
check_session();
if ($akun['jenis_user'] != 'admin') {
    header('Location: ./');
    $_SESSION['err'] = array('danger', 'Anda Tidak Memiliki Akses ke Halaman ini');
    return;
}

if (isset($_GET['hapus'])) {
    $id = sanitizeQuery($koneksi, $_GET['hapus']);
    $sql = mysqli_query($koneksi, "SELECT * FROM model_cnn WHERE id_model='$id'") or die(mysqli_error($koneksi));
    $model = mysqli_fetch_assoc($sql);
    $hapus = mysqli_query($koneksi, "DELETE FROM model_cnn WHERE id_model='$id'");
    if ($hapus) {
        $modelname = $model['model'];
        array_map('unlink', glob("./assets/model/$modelname/*.*"));
        rmdir("./assets/model/$modelname");
        header("Location: ?page=model");
        $_SESSION['err'] = array('success', 'Operasi Berhasil');
    } else {
        header("Location: ?page=model");
        $_SESSION['err'] = array('danger', 'Operasi Gagal');
    }
}
if (isset($_GET['apply'])) {
    $id = sanitizeQuery($koneksi, $_GET['apply']);
    $remove = mysqli_query($koneksi, "UPDATE model_cnn SET applied='0' WHERE applied='1'");
    $apply = mysqli_query($koneksi, "UPDATE model_cnn SET applied='1' WHERE id_model=$id");
    if ($remove && $apply) {
        header("Location: ?page=model");
        $_SESSION['err'] = array('success', 'Operasi Berhasil');
    } else {
        header("Location: ?page=model");
        $_SESSION['err'] = array('danger', 'Operasi Gagal');
    }
}
?>

<div class="row">
    <?php include "./component/SIde_profile.php"; ?>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-sm me-auto">
                <h2><strong> Manajemen Model AI </strong></h2>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead class="thead-inverse">
                    <tr>
                        <th>Terapkan</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    setlocale(LC_ALL, 'id_ID');
                    $date =
                        // echo "Saat ini: " . $date;
                        $q_model = mysqli_query($koneksi, "SELECT * FROM model_cnn ORDER BY id_model DESC");
                    while ($model = mysqli_fetch_array($q_model)) {
                    ?>
                    <tr>
                        <td data-label="Terapkan" data-id="<?= $model['id_model'] ?>" data-bs-toggle="tooltip"
                            title="Klik 2x untuk membuka" ondblclick="bukaSurat(this);">
                            <h2 class=" text-success"><?= ($model['applied']) ? "✓" : "☐" ?></h2>
                        </td>
                        <td data-label="Tanggal Upload">
                            <?= tgl_indo($model['tgl_upload']); ?>
                        </td>
                        <td>
                            <?php
                                if (!$model['applied']) { ?>
                            <a href="?page=model&hapus=<?= $model['id_model'] ?>"
                                class="btn btn-sm btn-danger fw-bold h3" title="Hapus Data"
                                onclick="return confirm('Ingin Menghapus Model ini ...?')">
                                <span aria-hidden="true">&times;</span> Hapus
                            </a>
                            <?php
                                }
                                ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
document.getElementById("formFile").addEventListener("change", async (event) => {
    console.log(event.target.value.length);
    if (event.target.value.length) {
        try {
            model = await tf.loadLayersModel(tf.io.browserFiles([event.target.files[0]]))
            const [file] = event.target.files;
            const {
                name: fileName,
                size
            } = file;
            document.querySelector(".file-name").textContent = fileName;
        } catch (e) {
            alert("the model could not be loaded")
            event.target.value = null;
        }
    } else {
        event.target.value = '';
        document.querySelector(".file-name").textContent = '';
    }
});

function bukaSurat(e) {
    var id = "" + e.getAttribute("data-id");
    location.replace("?page=model&apply=" + id);
}
</script>