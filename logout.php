<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['err'])) $err = $_SESSION['err'];
session_destroy();
if (isset($err)) {
    session_start();
    $_SESSION['err'] = $err;
}
header("Location: ./");
die();