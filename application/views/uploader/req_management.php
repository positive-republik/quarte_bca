<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">Request Management</h1>
    </div>

    <!-- DataTales Users -->
    <div class="card shadow-sm mb-5">    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Permintaan</th>
                            <th>Tujuan Permintaan</th>
                            <th>Nama Peminta</th>
                            <th>Awal Bulan</th>
                            <th>Akhir Bulan</th>
                            <th>Prioritas</th>
                            <th>Respon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($reqDataManage->result_array() AS $key) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $key['req_title'] ?></td>
                            <td><?= $key['req_purpose'] ?></td>
                            <td><?= $key['requester_name'] ?></td>
                            <td><?= $key['req_start'] ?></td>
                            <td><?= $key['req_end'] ?></td>
                            <td><?= $key['req_priority'] ?></td>
                            <td><a href="#" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal">Respon</a></td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Respon Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('uploader/responeReq') ?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
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
