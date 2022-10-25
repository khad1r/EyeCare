<!doctype html>
<html lang="en">

<head>
    <link href="./assets/images/logo-bulat-2.png" rel="shortcut icon">
    <title>404 Halaman Tidak ada</title>
    <link rel="stylesheet" type="text/css" href="./assets/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/style/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/style/style.min.css">
    <style type="text/css">
    h3 {
        font-size: 2.5em;
    }

    .mohon {
        font-size: 1.8em;
    }

    .text {
        font-size: 1.2em;
        text-align: center;
    }

    .btn-large {
        margin-top: 20px;
        font-size: 1.4em;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        /* place-content: center; */
        height: 100%;

    }

    body {
        height: 100vh;
    }

    h1 {
        font-size: 20rem
    }
    </style>

</head>

<body>
    <div class="container">
        <h1>404!!</h1>
        <h3 class="text-danger fw-bolder">
            <strong>
                Halaman yang di request tidak ada.
            </strong>
        </h3>
        <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/esurat' ?>" class="btn btn-info">
            Kembali</a>
    </div>
    <script src="./assets/script/jquery-3.3.1.slim.min.js"></script>
    <script src="./assets/script/popper.min.js"></script>
    <script src="./assets/script/bootstrap.min.js"></script>
</body>

</html>