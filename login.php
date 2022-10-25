<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("./assets/include/config.php");
if (isset($_SESSION['akun'])) {
    header("Location: ./");
}

if (isset($_POST['login'])) {
    $username = sanitizeQuery($koneksi, $_REQUEST['username']);
    $password = sanitizeQuery($koneksi, $_REQUEST['password']);
    $query = mysqli_query($koneksi, "SELECT * FROM t_user WHERE username='$username' AND password=MD5('$password')") or die(mysqli_error($koneksi));
    if (mysqli_num_rows($query) > 0) {
        $akun = mysqli_fetch_assoc($query);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['akun'] = $akun;
        if ($akun["jenis_user"] == "admin") {
            header("location: ./?page=model");
        } else {
            header("location: ./?page=classify");
        }
        header("Refresh:0");
        die();
    } else {
        $_SESSION['err'] = array('danger', 'Username atau Password Salah');
        // header("Location: ./");
        header("Refresh:0");
        die();
    }
}
?>
<!DOCTYPE html>
<html>

<?php include "./component/Header.php"; ?>


<body style="background: #75caf3 !important;">
    <?php include "./component/loader.php"; ?>

    <div class="login-form" name="login">
        <form method="post">
            <!---LOGO--->
            <div style="display: grid;justify-content: center; margin-bottom:2rem">
                <img src="./assets/images/logo.png" style="height: 30vh;" class="img-fluid" alt="">
            </div>
            <!---LOGO--->
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
            </div>
            <?php
            if (isset($_SESSION['err'])) {
            ?>
            <div class="alert alert-<?= $_SESSION['err'][0] ?> ">
                <strong>
                    <?= $_SESSION['err'][1] ?>
                </strong>
            </div>
            <?php
                unset($_SESSION['err']);
            }
            ?>
            <hr>
            <input type="submit" class="btn w-100" value="Login" name="login">
        </form>
    </div>
    <?php include "./component/script.php"; ?>

    <script type="text/javascript">
    $(document).ready(function() {
        $(".loading-Page").hide();
        $(".alert").alert().delay(3000).slideUp('slow');
    });
    </script>
</body>

</html>