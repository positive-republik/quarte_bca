<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">Filing Cabinet</h1>
        <a href="#" class="d-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addUser"><i class="fas fa-upload fa-sm text-white-50"></i> Upload Data</a>
    </div>

    <!-- DataTales Users -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Kategori File</th>
                            <th>Produk</th>
                            <th>Priode Awal</th>
                            <th>Priode Akhir</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>File Upload</th>
                            <th>Link Share</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $q) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $q['nama_file']; ?></td>
                                <td><?= $q['kategori'] ?></td>
                                <td><?= $q['produk'] ?></td>
                                <td><?= $q['start'] ?></td>
                                <td><?= $q['end'] ?></td>
                                <td><?= $q['created_by'] ?></td>
                                <td><?= substr($q['created_at'], 0, 10) ?></td>
                                <td><?= $q['file'] ?></td>
                                <td><a href="#" class="badge badge-primary mQnA" data-toggle="modal" data-target="#copy<?= $q['id'] ?>">Copy Link</a></td>
                                <td><a href="#" class="badge badge-warning" data-toggle="modal" data-target="#edit<?= $q['id'] ?>">Edit</a></td>
                                <td><a href="<?= base_url('uploader/deleteFilingCabinet/') . $q['id'] ?>" class="badge badge-danger" onclick="return alert('Yakin ingin menghapus');">Delete</a></td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="edit<?= $q['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editLabel">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('uploader/edit_filling_cabinet') ?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" value="<?= $q['id'] ?>" name="id">
                                                <div class="form-group">
                                                    <label for="name">Nama File</label>
                                                    <input type="text" class="form-control" id="name" name="file_name" value="<?= $q['nama_file'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategori">Kategori File</label>
                                                    <input type="text" class="form-control" id="kategori" name="file_kategori" value="<?= $q['kategori'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="produk">Produk</label>
                                                    <input type="text" class="form-control" id="produk" name="file_produk" value="<?= $q['produk'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="awalBulan4">Priode Awal</label>
                                                    <input type="text" class="form-control" id="awalBulan4" value="<?= $q['start'] ?>" name="start">
                                                </div>
                                                <div class="form-group">
                                                    <label for="akhirBulan4">Priode Akhir</label>
                                                    <input type="text" class="form-control" id="akhirBulan4" value="<?= $q['end'] ?>" name="end">
                                                </div>
                                                <div class="input-group mt-4 mb-2">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary">
                                                            Browse<input type="file" id="media" name="excel" style="display: none;" required>
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control input-lg" size="40" placeholder="File Excel..." readonly required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Link Modal -->
                            <div class="modal fade" id="copy<?= $q['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="copyLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="copyLabel">Copy Link</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Link File</label>
                                                <input class="form-control" value="<?= base_url('assets/vendor/phpspreadsheet/file/' . $q['file']) ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('assets/vendor/phpspreadsheet/file/' . $q['file'])  ?>" class="btn btn-success" target="_blank" rel="noopener noreferrer" download>Download File</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Add Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Upload Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('uploader/add_filing_cabinet') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="full_name">Uploader Name</label>
                        <input type="text" class="form-control" id="full_name" value="<?= $user_info['full_name'] ?>" readonly>
                        <input type="hidden" class="form-control" id="full_name" value="<?= $user_info['full_name'] ?>" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="date">Upload Date</label>
                        <input type="text" class="form-control" id="date" value="<?= date('d-M-Y') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_file">Nama File</label>
                        <input type="text" id="nama_file" class="form-control" name="nama_file" required>
                    </div>
                    <div class="form-group">
                        <label for="produk ">Produk</label>
                        <input type="text" id="produk" class="form-control" name="produk" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori ">kategori</label>
                        <input type="text" id="kategori" class="form-control" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="awalBulan3">Bulan Awal</label>
                        <input id="awalBulan3" class="form-control" name="start" required>
                    </div>
                    <div class="form-group">
                        <label for="akhirBulan3">Bulan Akhir</label>
                        <input id="akhirBulan3" class="form-control" name="end" required>
                    </div>
                    <div class="input-group mt-4 mb-2">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Browse<input type="file" id="media" name="excel" style="display: none;" required>
                            </span>
                        </label>
                        <input type="text" class="form-control input-lg" size="40" placeholder="File Excel..." readonly required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>