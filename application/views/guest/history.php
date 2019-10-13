<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">History</h1>
        <!-- Add button trigger -->
    </div>

    <?php if ($data->num_rows() == 0) : ?>
        <!-- Alert err history -->
        <div class="alert alert-danger font-weight-bold text-center" role="alert">
            History is empty
        </div>
    <?php else : ?>
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Request</th>
                                <th>Tanggal Request</th>
                                <th>Awal Bulan</th>
                                <th>Akhir Bulan</th>
                                <th>Prioritas</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data->result_array() as $key) : ?>
                                <tr>
                                    <td><?= $key['id'] ?></td>
                                    <td><?= $key['req_title'] ?></td>
                                    <td><?= substr($key['created_at'], 0, 10) ?></td>
                                    <td><?= $key['req_start'] ?></td>
                                    <td><?= $key['req_end'] ?></td>
                                    <?php if ($key['req_priority'] == 1) : ?>
                                        <td><button type="button" class="badge badge-danger">Urgent</button></td>
                                    <?php elseif ($key['req_priority'] == 2) : ?>
                                        <td><button type="button" class="badge badge-warning">High</button></td>
                                    <?php elseif ($key['req_priority'] == 3) : ?>
                                        <td><button type="button" class="badge badge-primary">Medium</button></td>
                                    <?php elseif ($key['req_priority'] == 4) : ?>
                                        <td><button type="button" class="badge badge-info">Low</button></td>
                                    <?php endif; ?>
                                    <td><a href="#" class="badge badge-primary" data-toggle="modal" data-target="#ressModal<?= $key['id'] ?>">Detail</a></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="ressModal<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ressModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ressModalLabel">Detail Request</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama Requester</label>
                                                    <input type="text" class="form-control" id="name" value="<?= $key['requester_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Email Requester</label>
                                                    <input type="text" class="form-control" id="name" value="<?= $key['req_email'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Extention Requester</label>
                                                    <input type="text" class="form-control" id="name" value="<?= $key['req_extention'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tujuan">Tujuan Request</label>
                                                    <textarea class="form-control" id="tujuan" name="" id="" readonly><?= $key['req_purpose'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="responder">Nama Responder</label>
                                                    <input type="text" class="form-control" id="responder" value="<?= $key['answer_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="responder">Tanggal Respon</label>
                                                    <input type="text" class="form-control" id="responder" value="<?= $key['update_at'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="note">Catatan Request</label>
                                                    <textarea class="form-control" id="note" name="note" readonly><?= $key['req_note'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="link">Link Request</label>
                                                    <input type="text" class="form-control" id="link" name="req_link" value="<?= $key['req_link'] ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="<?= $key['req_link'] ?>" class="btn btn-primary" download>Download</a>
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

    <?php endif; ?>

</div>