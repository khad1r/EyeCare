<?php
if (isset($_POST['profileChange'])) {
    $originalUser   = $akun['username'];
    $username       = sanitizeQuery($koneksi, $_POST['username']);
    $password       = empty($_POST['password']) ? $akun['password'] : md5(sanitizeQuery($koneksi, $_POST['password']));
    $nama           = sanitizeQuery($koneksi, $_POST['nama']);

    if ($originalUser != $username) {
        $queryUsername = mysqli_query($koneksi, "SELECT * FROM t_user WHERE username='$username'");
        if (mysqli_num_rows($queryUsername) > 0) {
            header("Refresh:0");
            $_SESSION['err'] = array('warning', 'Username telah digunakan');
            return;
        }
    }
    $sql = mysqli_query($koneksi, "UPDATE t_user SET username='$username', password='$password', nama='$nama' WHERE username='$originalUser'");
    if ($sql) {
        $_SESSION['err'] = array('success', 'Operasi Berhasil');
        header("Location: logout.php");
    } else {
        header("Refresh:0");
        $_SESSION['err'] = array('danger', 'Operasi Gagal');
    }
}
?>
<div class="modal fade" id="userModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" onload="">
    <div class="modal-dialog" role="document">
        <form method="post" name="profileChange" enctype="multipart/form-data">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Profil
                        <?= $akun['nama'] ?>
                        <br>
                        <i class="text-muted small">
                            <?= $akun['jenis_user'] ?>
                        </i>
                    </h5>
                    <a class="btn btn-lg close" onclick="location.replace(window.location.href)" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <input id="prevPassword" name="prevPassword" type="hidden" value="<?= $akun['password'] ?>">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" value="<?= $akun['username'] ?>"
                            placeholder="Username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" value="" placeholder="Password"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="nama" value="<?= $akun['nama'] ?>" class="form-control"
                            placeholder="Nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="location.replace(window.location.href)" class="btn btn-danger"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" name="profileChange" class="btn btn-success">Ganti</button>
                </div>
            </div>
        </form>
    </div>
</div>