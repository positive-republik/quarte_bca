<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">Filing Cabinet</h1>
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
                            <th>File Excel</th>
                            <th>Link Share</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i =1;
                    foreach ( $data as $q ) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $q['nama_file']; ?></td>
                            <td><?= $q['kategori'] ?></td>
                            <td><?= $q['produk'] ?></td>
                            <td><?= $q['start'] ?></td>
                            <td><?= $q['end'] ?></td>
                            <td><?= $q['created_by'] ?></td>
                            <td><?= substr($q['created_at'],0,10) ?></td>
                            <td><?= $q['file'] ?></td>
                            <td><a href="#" class="badge badge-primary mQnA" data-toggle="modal" data-target="#copy">Copy Link</a></td>
                        </tr>
                        <!-- Add Modal -->
                        <div class="modal fade" id="copy" tabindex="-1" role="dialog" aria-labelledby="copyLabel" aria-hidden="true">
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
                                            <input class="form-control" value="<?= base_url('assets/vendor/phpspreadsheet/file/'.$q['file'])  ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="<?= base_url('assets/vendor/phpspreadsheet/file/'.$q['file'])  ?>" class="btn btn-success" target="_blank" rel="noopener noreferrer" download>Download File</a>
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