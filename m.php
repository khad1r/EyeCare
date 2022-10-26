<?php
require("./assets/include/config.php");
if (isset($_POST['tgl'])) {
    $tgl = sanitizeQuery($koneksi, $_POST['tgl']);
    $sql = mysqli_query($koneksi, "INSERT INTO model_cnn VALUES(null,'$tgl',0)");
    if ($sql) {
        echo 'Operasi Berhasil';
    } else {
        echo 'Operasi Gagal';
    }
}