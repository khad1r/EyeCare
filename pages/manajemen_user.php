<?php
check_session();
if ($akun['jenis_user'] != 'admin') {
    header('Location: ./');
    $_SESSION['err'] = array('danger', 'Anda Tidak Memiliki Akses ke Halaman ini');
    return;
}

if (isset($_POST['submit'])) {
    $username       = sanitizeQuery($koneksi, $_POST['username']);
    $password       = empty($_POST['password']) ? $_POST['prevPassword'] : md5(sanitizeQuery($koneksi, $_POST['password']));
    $nama           = sanitizeQuery($koneksi, $_POST['nama']);
    $jenis_user     = sanitizeQuery($koneksi, $_POST['jenis_user']);
    $editUsername   = isset($_GET['edit']) ? sanitizeQuery($koneksi, $_GET['edit']) : $username;

    if (!isset($_GET['edit']) xor $editUsername != $username) {
        $queryUsername = mysqli_query($koneksi, "SELECT * FROM t_user WHERE username='$username'");
        if (mysqli_num_rows($queryUsername) > 0) {
            header("Refresh:0");
            $_SESSION['err'] = array('Warning', 'Username telah digunakan');
        }
    }
    if (!isset($_GET['edit'])) {
        $sql = mysqli_query($koneksi, "INSERT INTO t_user VALUES('$username','$password','$nama','$jenis_user')");
    } else {
        $sql = mysqli_query($koneksi, "UPDATE t_user SET username='$username', password='$password', nama='$nama', jenis_user='$jenis_user' WHERE username='$editUsername'");
    }
    if ($sql) {
        header("Location: ?page=user");
        $_SESSION['err'] = array('success', 'Operasi Berhasil');
    } else {
        header("Refresh:0");
        $_SESSION['err'] = array('danger', 'Operasi Gagal');
    }
}

if (isset($_GET['hapus'])) {
    $id = sanitizeQuery($koneksi, $_GET['hapus']);
    $hapus = mysqli_query($koneksi, "DELETE FROM t_user WHERE username='$id'");
    if ($hapus) {
        header("Location: ?page=user");
        $_SESSION['err'] = array('success', 'Operasi Berhasil');
    } else {
        header("Location: ?page=user");
        $_SESSION['err'] = array('danger', 'Operasi Gagal');
    }
}
?>
<div class="row">
    <?php include "./component/SIde_profile.php"; ?>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-sm me-auto">
                <h2><strong> Manajemen User </strong></h2>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-outline-primary btn-xl float-end" data-toggle="modal" data-target="#userAddModal">
                    Tambah User
                </button>
            </div>
        </div>
        <hr>
        <div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" name="submit">
                    <div class="modal-content">

                        <div class="modal-header">
                            <?php
                            if (!isset($_GET['edit'])) {
                            ?>
                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah User</h5>
                                <a class="btn btn-lg close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            <?php
                            } else {
                            ?>
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                                <a class="btn btn-lg close" href="?page=user" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="modal-body">
                            <input id="prevPassword" name="prevPassword" type="hidden" value="">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control" <?= !isset($_GET['edit']) ? 'required' : '' ?>>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis User</label>
                                <select required name="jenis_user" id="jenis_user" class="form-control">
                                    <Option disabled selected>Jenis User</Option>
                                    <option value="dokter"> Dokter </option>
                                    <option value="admin"> Admin </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php
                            if (!isset($_GET['edit'])) {
                            ?>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <?php
                            } else {
                            ?>
                                <a class="btn btn-danger" href="?page=user">Batal</a>
                            <?php
                            }
                            ?>
                            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead class="thead-inverse">
                    <tr>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Jenis User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q_user = mysqli_query($koneksi, "SELECT * FROM t_user ORDER BY username DESC");
                    while ($users = mysqli_fetch_array($q_user)) {
                    ?>
                        <tr>
                            <td data-label="Username">
                                <?= $users['username']; ?>
                            </td>
                            <td data-label="Nama">
                                <?= $users['nama']; ?>
                            </td>
                            <td data-label="Jenis User">
                                <?= $users['jenis_user']; ?>
                            </td>
                            <td class="aksi">
                                <?php
                                if ($users['username'] == $akun['username'] xor ($users['jenis_user'] == "admin" && $akun['jenis_user'] != "admin")) {

                                ?>
                                    <i class="btn btn-secondary">No Action</i>
                                <?php
                                } else {
                                ?>
                                    <a href="?page=user&edit=<?= $users['username']; ?>" class="btn btn-sm btn-warning fw-bold h4" title="Edit Data">
                                        <span class="" aria-hidden="true">&#x270E;</span> Edit
                                    </a>&nbsp;
                                    <a href="?page=user&hapus=<?= $users['username']; ?>" class="btn btn-sm btn-danger fw-bold h3" title="Hapus Data" onclick="return confirm('Ingin Menghapus User <?= $users['username'] ?>...?')">
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
<?php

if (isset($_GET['edit'])) {
    $id = sanitizeQuery($koneksi, $_GET['edit']);
    $cari = mysqli_query($koneksi, "SELECT * from t_user where username='$id'");
    $data = mysqli_fetch_assoc($cari);
    $script = '
    <script type="text/javascript">
        $("#username").val("' . $data['username'] . '");
        $("#prevPassword").val("' . $data['password'] . '");
        $("#nama").val("' . $data['nama'] . '");
        $("#jenis_user").val("' . $data['jenis_user'] . '");
        $("#userAddModal").modal("show");
    </script>
    ';
}
