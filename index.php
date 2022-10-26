<?php
//cek session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$akun = isset($_SESSION['akun']) ? $_SESSION['akun'] : null;
$level = array("Dokter", "Admin");
include './assets/include/function.php';
require("./assets/include/config.php");
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
?>

<!DOCTYPE html>
<html lang="id">

<?php include "./component/Header.php"; ?>


<body>
    <?php include "./component/loader.php"; ?>

    <?php
    if (isset($_SESSION['err'])) {
    ?>
    <div class="main alert alert-<?= $_SESSION['err'][0] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['err'][1] ?>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        unset($_SESSION['err']);
    }
    ?>
    <header>
        <nav class="container navbar sticky-top navbar-expand-lg navbar-light">

            <!-- Container wrapper -->
            <div class="container-fluid">
                <a class="navbar-brand mt-2 mt-lg-0 mx-auto" href="./">
                    <img src="./assets/images/logo-bulat.png" class="img-responsive col my-auto" height="60" alt=""
                        loading="lazy" />
                    <strong class='navbar-title col'>
                        Eye Care
                    </strong>
                </a>
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span>&#9776;</span>
                </button>
                <!-- Toggle button -->

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto ms-lg-3 mb-2 mb-lg-0 ">
                        <?php if (isset($_SESSION['akun']) && $akun["jenis_user"] == "admin") { ?>
                        <li class="nav-item <?= $page == 'model' ? 'text-muted' : '' ?>">
                            <a class="nav-link" href="?page=model">Model Ai</a>
                        </li>
                        <li class="nav-item <?= $page == 'user' ? 'text-muted' : '' ?>">
                            <a class="nav-link" href="?page=user">User</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= "http://" . $_SERVER['SERVER_NAME'] . ":8888/notebooks/Ai%20Development.ipynb" ?>"
                                target="_blank">
                                <u>Open
                                    Jupyter
                                    Notebook</u></a>
                        </li>
                        <?php
                        }
                        ?>
                        <?php if (isset($_SESSION['akun']) && $akun["jenis_user"] == "dokter") { ?>
                        <li class="nav-item <?= $page == 'classify' ? 'text-muted' : '' ?>">
                            <a class="nav-link" href="?page=classify">Classify</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav ms-auto me-lg-3 mb-2 mb-lg-0 ">
                        <?php if (isset($_SESSION['akun'])) { ?>
                        <li class="nav-item <?= $page == 'user' ? 'text-muted' : '' ?>">
                            <a class="nav-link" href="./logout.php">Logout</a>
                        </li>
                        <?php
                        } else {
                        ?>
                        <li class="nav-item <?= $page == 'user' ? 'text-muted' : '' ?>">
                            <a class="nav-link" href="./login.php">Login</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->
            </div>
        </nav>
    </header>
    <main>
        <div class="container">

            <?php
            if (isset($_POST['profile']) || isset($_POST['profileChange'])) {
                include "./component/modal_profile.php";
            }
            switch ($page) {
                case 'model':
                    include "./pages/model_cnn.php";
                    break;
                case 'classify':
                    include "./pages/klasifikasi.php";
                    break;
                case 'user':
                    include "./pages/manajemen_user.php";
                    break;
                case 'hasil':
                    include "./pages/hasil_klas.php";
                    break;
                default:
                    include "./pages/dashboard.php";
                    break;
            }
            ?>
        </div>
    </main>
    <?php include "./component/script.php";

    if (isset($script)) {
        echo $script;
    } ?>

    <script>
    $(document).ready(function() {
        $(".loading-Page").hide();
        $("#userModal").modal("show");
    });
    </script>
    <!-- Javascript END -->
</body>
<!-- Body END -->

</html>