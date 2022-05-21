<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Jumlah Anggota -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Jumlah Anggota</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $this->ModelUser->getUserWhere(['role_id' => 2])->num_rows(); ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url() . 'user/anggota'; ?>"><i class="fas fa-users fa-3x text-warning"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Buku Terdaftar -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Stok Buku Terdaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php
                                $where = ['stok != 0'];
                                $totalStok = $this->ModelBuku->total('stok', $where);
                                echo $totalStok;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url() . 'buku'; ?>"><i class="fas fa-bookmark fa-3x text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Buku Dipinjam -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 bg-danger">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Buku Yang Dipinjam</div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php
                                $where = ['dipinjam != 0'];
                                $totalDipinjam = $this->ModelBuku->total('dipinjam', $where);
                                echo $totalDipinjam;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url() . 'user'; ?>"><i class="fas fa-book-reader text-success fa-3x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buku Dibooking -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Buku Yang Dibooking</div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php
                                $where = ['dibooking != 0'];
                                $totalDibooking = $this->ModelBuku->total('dibooking', $where);
                                echo $totalDibooking;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url() . 'user'; ?>"><i class="fas fa-shopping-cart text-danger fa-3x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr class="sidebar-divider">

    <div class="row">
        <!-- tampil user -->
        <div class="table-responsive table-bordered col-sm-5 ml-auto mr-auto mt-2">
            <div class="page-header">
                <span class="fas fa-users text-primary mt-2 fa-2x"> Data User</span><br>
                <a href="<?= base_url() . 'user/data_user'; ?>" class="text-danger"><i class="fas fa-search mt-2"></i> Tampilkan</a>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Anggota</th>
                        <th>Email</th>
                        <th>Role ID</th>
                        <th>Aktif</th>
                        <th>Member Sejak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach($anggota as $a):
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $a['nama']; ?></td>
                        <td><?= $a['email']; ?></td>
                        <td><?= $a['role_id']; ?></td>
                        <td><?= $a['is_active']; ?></td>
                        <td><?= date('d F Y', strtotime($a['tanggal_input'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- tampil buku -->
        <div class="table-responsive table-bordered col-sm-5 ml-auto mr-auto mt-2">
            <div class="page-header">
                <span class="fas fa-book text-warning mt-2 fa-2x"> Data Buku</span><br>
                <a href="<?= base_url() . 'buku'; ?>" class="text-danger"><i class="fas fa-search mt-2"></i> Tampilkan</a>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>ISBN</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach($buku as $b):
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $b['judul_buku']; ?></td>
                        <td><?= $b['pengarang']; ?></td>
                        <td><?= $b['penerbit']; ?></td>
                        <td><?= $b['tahun_terbit']; ?></td>
                        <td><?= $b['isbn']; ?></td>
                        <td><?= $b['stok']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->