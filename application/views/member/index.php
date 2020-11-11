    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">My Profile</h1>

        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-5 d-flex">
                    <img class="card-img img-fluid align-self-stretch" src="<?= base_url('assets/sbadmin/img/profile/' . ($user['image'] ?? 'default.png')); ?>" alt="Profile image">
                </div>
                <div class="col-md-7">
                    <div class="card-body h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><?= $user['name'] ?? '' ?></h5>
                            <p class="card-text"><?= $user['email'] ?? '' ?></p>
                        </div>
                        <p class="card-text"><small class="text-muted">Member since <?= ($user['created_date'] ? date('d F Y', $user['created_date']) : '-') ?></small></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->