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
                                <th>Produk</th>
                                <th>Pertanyaan</th>
                                <th>Nama Penanya</th>
                                <th>Nama Responder</th>
                                <th>Modified By</th>
                                <th>Tanggal Pertanyaan</th>
                                <th>Tanggal Direspon</th>
                                <th>Tanggal Dimodifikasi</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($data->result_array() as $q) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $q['produk']; ?></td>
                                    <td><?= $q['question']; ?></td>
                                    <td><?= $q['asker_name']; ?></td>
                                    <td><?= $q['answer_name']; ?></td>
                                    <td><?= $q['modified_by'] ?></td>
                                    <td><?= substr($q['created_at'], 0, 10) ?></td>
                                    <td><?= $q['update_at'] ?></td>
                                    <td><?= $q['modified_at'] ?></td>
                                    <td>
                                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#detail<?= $q['id']; ?>">Detail</a>
                                    </td>
                                </tr>
                                <!-- Detail -->
                                <div class="modal fade" id="detail<?= $q['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detail">Answer Question</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="produk">Produk</label>
                                                    <input type="text" class="form-control" id="produk" value="<?= $q['produk'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Nama_Penanya">Nama Penanya</label>
                                                    <input type="text" class="form-control" id="Nama_Penanya" value="<?= $q['asker_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="NIP">NIP Penanya</label>
                                                    <input type="text" class="form-control" id="NIP" value="<?= $q['nip'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email_penanya">Email Penanya</label>
                                                    <input type="text" class="form-control" id="email_penanya" value="<?= $q['email'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="extention">Extention Penanya</label>
                                                    <input type="text" class="form-control" id="extention" value="<?= $q['extention'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="unit_kerja">Unit Kerja Penanya</label>
                                                    <input type="text" class="form-control" id="unit_kerja" value="<?= $q['extention'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="created_at">Tanggal Pertanyaan</label>
                                                    <input type="text" class="form-control" id="created_at" value="<?= substr($q['created_at'], 0, 10) ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pesan">Pertanyaan</label>
                                                    <textarea class="form-control" id="pesan" readonly><?= $q['question'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pesan">Jawaban</label>
                                                    <textarea class="form-control" id="pesan" readonly><?= $q['answer'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pesan">Link Jawaban</label>
                                                    <input class="form-control" id="pesan" readonly value="<?= $q['answer_link'] ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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