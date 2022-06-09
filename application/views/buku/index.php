<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#bukuBaruModal"><i class="fas fa-file-alt"></i> Buku Baru</a>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="tblBuku">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Pengarang</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Tahun Terbit</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Stok</th>
                                <th scope="col">DiPinjam</th>
                                <th scope="col">DiBooking</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;
                            foreach ($buku as $b) { ?>
                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td><?= $b['judul_buku']; ?></td>
                                    <td><?= $b['pengarang']; ?></td>
                                    <td><?= $b['penerbit']; ?></td>
                                    <td><?= $b['tahun_terbit']; ?></td>
                                    <td><?= $b['isbn']; ?></td>
                                    <td><?= $b['stok']; ?></td>
                                    <td><?= $b['dipinjam']; ?></td>
                                    <td><?= $b['dibooking']; ?></td>
                                    <td>
                                        <picture>
                                            <source srcset="" type="image/svg+xml">
                                            <img src="<?= base_url('assets/img/upload/') . $b['image']; ?>" class="img-fluid img-thumbnail" alt="...">
                                        </picture>
                                    </td>
                                    <td>
                                        <a class="badge badge-info" data-toggle="modal" data-target="#editBukuModal<?= $b['id']; ?>"><i class="fas fa-edit"></i> Ubah</a>
                                        <a href="<?= base_url('buku/hapusbuku/') . $b['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $b['judul_buku']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal Tambah buku baru-->
<div class="modal fade" id="bukuBaruModal" tabindex="-1" role="dialog" aria-labelledby="bukuBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bukuBaruModalLabel">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('buku'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit">
                    </div>
                    <div class="form-group">
                        <select name="tahun_terbit" class="form-control form-control-user">
                            <option value="">Pilih Tahun</option>
                            <?php
                            for ($i = date('Y'); $i > 1900; $i--) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="isbn" name="isbn" placeholder="Masukkan ISBN">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit buku-->
<?php foreach ($buku as $b) { ?>
    <div class="modal fade" id="editBukuModal<?= $b['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editBukuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBukuModalLabel">Edit Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('buku/ubahBuku'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku" value="<?= $b['judul_buku']; ?>">
                            <input type="hidden" value="<?= $b['id']; ?>">
                        </div>
                        <div class="form-group">
                            <select name="id_kategori" class="form-control form-control-user">
                                <?php foreach ($kategori as $k) { ?>
                                    <option <?php if ($k['id_kategori'] == $b['id_kategori']) {
                                                echo "selected = 'selected'";
                                            } ?> value="<?= $k['id_kategori']; ?>"><?= $k['kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" value="<?= $b['pengarang']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" value="<?= $b['penerbit']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" name="tahun_terbit" value="<?= $b['tahun_terbit']; ?>" class="form-control form-control-user">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="isbn" name="isbn" placeholder="Masukkan ISBN" value="<?= $b['isbn']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $b['stok']; ?>">
                        </div>
                        <div class="form-group">
                            <img src="<?= base_url() . 'assets/img/upload/' . $b['image']; ?>" id="output" style="width: 72px;">
                            <input type="file" accept="image/*" class="custom-file-input" id="image" name="image" onchange="loadFile(event)" style="display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>