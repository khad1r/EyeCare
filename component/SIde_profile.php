<?php
check_session();
?>
<div class="col-lg-3 d-lg-block d-sm-none d-md-none">
    <div class="card p-5 rounded shadow">
        <div class="card-body text-center d-flex justify-content-center flex-column">
            <img class="card-img-top" src="./assets/images/logo.png" alt="" style="width: 100%;">
            <h4 class="card-title mt-4 fw-bold" style="font-size:1.3vw">
                <?= $akun['nama'] ?>
            </h4>
            <p class="card-text text-capitalize" style="font-size:.9vw">
                <?= $akun['jenis_user'] ?>
            </p>
            <form method="post" name="profile">
                <button class="btn btn-outline-secondary" type="submit" name="profile">Profil</button>
            </form>
        </div>
    </div>
</div>