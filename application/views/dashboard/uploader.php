
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Upload</h1>
        <!-- Add button trigger -->
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
                        <th>Tanggal Upload</th>
                        <th>Jumlah Upload</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($all_upload as $key) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= substr($key['date'],0,10) ?></td>
                        <td><?= $key['total'] ?></td>
                        <td><a href="#" class="badge badge-warning" data-toggle="modal" data-target="#editUpload<?= $key['id'] ?>">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editUpload<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editUploadLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUploadLabel">Edit Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('uploader/edit/'.$key['id']) ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        <p>Data pada bulan ini akan terhapus dan <b>digantikan dengan yang baru</b>. Anda yakin ?</p>
                                    </div>
                                    <input type="hidden" name="date" value="<?= $key['month'] ?>">
                                    <div class="form-group">
                                        <label for="full_name">Uploader Name</label>
                                        <input type="text" class="form-control" id="full_name" value="<?= $user_info['full_name'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Upload Date</label>
                                        <input type="text" class="form-control" id="date" value="<?= substr($key['date'],0,10) ?>" readonly>
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
                    <?php $i++; endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Add Success Alert -->
<?php if(isset($_GET['safe']) && $_GET['safe'] == 1) : ?>
    <?= "<script>
        swal('Upload Data Success', ' ', 'success')
    </script>"; ?>
<?php endif; ?>

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
      <form method="post" action="<?= base_url('uploader/upload') ?>" enctype="multipart/form-data">
        <div class="modal-body">
            <?php if($getUploadCheck == 1) : ?>
            <div class="alert alert-danger" role="alert">
                <p>Anda <b>sudah mengupload</b> data pada bulan ini. Yakin akan melanjutkannya dan menghapus data sebelumnya ?</p>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="full_name">Uploader Name</label>
                <input type="text" class="form-control" id="full_name" value="<?= $user_info['full_name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="date">Upload Date</label>
                <input type="text" class="form-control" id="date" value="<?= date('d-M-Y') ?>" readonly>
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
          <button type="submit" class="btn btn-primary" >Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
