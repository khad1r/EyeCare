<noscript>
    <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
</noscript>
<script src="./assets/script/jquery-3.3.1.slim.min.js"></script>
<script src="./assets/script/popper.min.js"></script>
<script src="./assets/script/bootstrap.min.js"></script>
<?php
if (isset($page) && ($page == 'model' or $page == 'classify')) {
?>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<?php
}