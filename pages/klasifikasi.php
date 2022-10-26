<?php
ini_set('max_execution_time', 600);
ini_set('memory_limit', '2048M');
$akun = $_SESSION['akun'];
check_session();
if ($akun['jenis_user'] != 'dokter') {
    header('Location: ./');
    $_SESSION['err'] = array('danger', 'Anda Tidak Memiliki Akses ke Halaman ini');
    return;
}
$sql = mysqli_query($koneksi, "SELECT * FROM model_cnn WHERE applied='1'") or die(mysqli_error($koneksi));
$model = mysqli_fetch_assoc($sql);

if (isset($_POST['Simpan'])) {
    $noreg          = sanitizeQuery($koneksi, $_POST['noreg']);
    $noreg          = sprintf("%015d", $noreg);
    $nama           = sanitizeQuery($koneksi, $_POST['nama']);
    $umur           = sanitizeQuery($koneksi, $_POST['umur']);
    $kiri           = sanitizeQuery($koneksi, $_POST['klasifikasi_kiri']);
    $kanan          = sanitizeQuery($koneksi, $_POST['klasifikasi_kanan']);
    $klasifikasi    = $kiri . '~' . $kanan;
    $files          = array($_FILES['kiri'], $_FILES['kanan']);
    $berkas         = array();
    $dokter         = $akun['username'];
    $i = 0;
    foreach ($files as $file) {
        $x = explode('.', $file['name']);
        $ekstensi = strtolower(end($x));
        if (!in_array($ekstensi, array('png', 'jpg'))) {
            header("Refresh:0");
            $_SESSION['err'] = array('warning', 'Format file yang diperbolehkan hanya *.png, *.jpg!!');
            return;
        }
        $kla = ($i == 0) ? $kiri : $kanan;
        $lr = ($i == 0) ? 'kiri' : 'kanan';
        $document =   $kla . '/' . $noreg . '-' . $lr . '.' . $ekstensi;
        $tujuan = "images/" . $document;
        if (!move_uploaded_file($file['tmp_name'], $tujuan)) {
            foreach ($berkas as $gambar) {
                if (is_file("images/" . $gambar)) unlink("images/" . $gambar);
            }
            header("Refresh:0");
            $_SESSION['err'] = array('danger', 'Foto Gagal diupload!');
            return;
        }
        array_push($berkas, $document);
        $i++;
    }
    $file = $berkas[0] . '~' . $berkas[1];
    $sql = mysqli_query($koneksi, "INSERT INTO pasien VALUES('$noreg','$nama','$umur','$file','$klasifikasi','$dokter')");
    if ($sql) {
        // header("Location: ?page=classify");
        header("Location: ?page=hasil&noreg=$noreg");
        $_SESSION['err'] = array('success', 'Operasi Berhasil');
    } else {
        header("Refresh:0");
        $_SESSION['err'] = array('danger', 'Operasi Gagal');
    }
}

?>
<div class="row">
    <?php include "./component/SIde_profile.php"; ?>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-sm me-auto">
                <h2><strong> Klasifikasi Penyakit Mata </strong></h2>
            </div>
        </div>
        <form method="post" enctype="multipart/form-data">
            <hr>
            <div class="mt-2 mb-5 mt-lg-0 mx-auto" style="width: 70%;">
                <div class="input-group mb-3">
                    <span class="input-group-text">Nomor Registrasi</span>
                    <input type="text" name="noreg" class="form-control" pattern="\d*" maxlength="15" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Nama</span>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Umur</span>
                    <input type="text" name="umur" class="form-control" maxlength="3" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-primary w-25" id="loadModel"
                    onclick="loadd(this); this.onclick=null;">
                    Muat AI
                </button>
            </div>
            <div class="row" id="imagesUpload" style="display: none">
                <div class="col-md-6">
                    <input type="text" name="klasifikasi_kiri" id="klasifikasi_kiri" value='baru' class="form-control"
                        readonly style="display: none;">
                    <div class="file-input mt-3">
                        <img src="" class="img-responsive" id="kiri" style="width: 224px; height: 224px;">
                        <input type="file" id="funduskiri" name="kiri" class="file" accept="image/png, image/jpeg"
                            onchange="showPreview(event,'kiri');" required>
                        <label for="funduskiri" class="mb-2">
                            <span class="btn w-100">
                                Upload Fundus Mata kiri
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="text" name="klasifikasi_kanan" id="klasifikasi_kanan" value='baru' class="form-control"
                        readonly style="display: none;">
                    <div class="file-input mt-3">
                        <img src="" class="img-responsive" id="kanan" style="width: 224px; height: 224px;">
                        <input type="file" id="funduskanan" name="kanan" class="file" accept="image/png, image/jpeg"
                            onchange="showPreview(event,'kanan');" required>
                        <label for="funduskanan" class="mb-2 ">
                            <span class="btn w-100">
                                Upload Fundus Mata kanan
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <input class="btn btn-outline-primary w-25" id="submit" type="submit" value="Simpan" name="Simpan"
                    style="display: none">
            </div>
        </form>
    </div>
</div>
<script>
let model;
let predictions = [];
let className = ['Age related Macular Degeneration', 'Cataract', 'Diabetes', 'Glaucoma', 'Hypertension',
    'Myopia', 'Normal', 'Other diseases'
]

function showPreview(event, mata) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById(mata);
        preview.src = src;
        preview.style.display = "block";
        predict(preview, mata);
    }
}

async function predict(image, mata) {
    const t = {}; // container that will hold all tensor variables
    t.decoded = tf.browser.fromPixels(image); // in browser use tf.browser.fromPixels
    t.resized = tf.image.resizeBilinear(t.decoded, [224, 224]);
    t.expanded = tf.expandDims(t.resized, 0);
    let predict = await model.predict(t.expanded);
    image_class = await tf.argMax(predict.dataSync());
    prediction = className[image_class.dataSync()]
    console.log(prediction);
    document.getElementById("klasifikasi_" + mata).value = prediction;
    document.getElementById("klasifikasi_" + mata).style.display = "block";
    predictions.push(prediction);
    if (predictions.length === 2) {
        document.getElementById("submit").style.display = "block";
    }
}

async function loadd(event) {
    event.innerHTML = "<i class='spinner-border spinner-border-sm'></i>"
    try {
        model = await tf.loadLayersModel('./assets/model/<?= $model['tgl_upload'] ?>/model.json');
        document.getElementById("imagesUpload").style.display = "flex";
        event.style.display = "none";
    } catch (e) {
        alert("the model could not be loaded, Please Contact The Admin");
        console.log(e);
        event.innerHTML = "Error!!";
        event.classList.remove('btn-outline-primary');
        event.classList.add('btn-outline-danger');
    }
}
</script>
<?php
// $script = "
//     <script>
//     $(document).ready(function(){
//         $('#TulisDisposisi').on('hidden.bs.modal', function (event) {
//             document.getElementById('Dkepada').value = '';
//             document.getElementById('DkepadaAsli').value = '';
//             document.getElementById('berita').value = '';
//             document.getElementById('Dtgl').value = '';
//             document.getElementById('Dkepada').disabled = false;
//         })
//     })
//     </script>";