<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Banner Management</h1>
        <!-- Add button trigger -->
        <a href="#" class="d-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addUser"><i class="fas fa-upload fa-sm text-white-50"></i> Upload New Banner</a>
    </div>

    <!-- DataTales Users -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Banner</th>
                            <th>Nama File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($banner as $q) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><img class="w-50" src="<?= base_url('assets/img/slider/') . $q['img'] ?>"></td>
                                <td><?= $q['img'] ?></td>
                                <td>
                                    <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#delete<?= $q['id'] ?>">Delete</a>
                                </td>
                            </tr>
                            <!-- Add Modal -->
                            <div class="modal fade" id="delete<?= $q['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLabel">Delete Banner</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h3>Yakin menghapus banner ?</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('uploader/delete_banner/') . $q['id'] ?>" class="btn btn-danger">Delete Banner</a>
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

<!-- Add Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Upload New Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('uploader/upload_banner') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group mt-4 mb-2">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Browse<input type="file" id="media" name="banner" style="display: none;" required>
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