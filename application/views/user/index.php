<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 justify-content-x">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php if($user['image'] == 'default.jpg'){
                    $img =  base_url() . 'assets/img/undraw_profile.svg';
                } else {
                    $img = base_url() . 'assets/img/profile/' . $user['image'];
                } ?>
                <img src="<?= $img; ?>" class="card-img" alt="..." style="margin-top: 16px; margin-left: 16px;">
            </div>
            <div class="col-md-8">
                <div class="card-body ml-4">
                    <h5 class="card-title"><?= $user['nama'];?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Jadi member sejak: <br><b><?= date('d F Y', strtotime($user['tanggal_input'])); ?></b></small></p>
                </div>
                <div class="btn btn-info ml-5 my-3">
                    <a href="<?= base_url() . 'user/ubahProfil'; ?>" class="text text-white"><i class="fas fa-user-edit"></i> Ubah Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->