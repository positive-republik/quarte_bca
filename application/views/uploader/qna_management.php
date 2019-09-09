<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800">Qna Management</h1>
  </div>

  <!-- DataTales Users -->
  <div class="card shadow-sm mb-5">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penanya</th>
              <th>Produk</th>
              <th>Peranyaan</th>
              <th>Tanggal Pertanyaan</th>
              <th>Respon</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($data->result_array() as $q) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $q['asker_name']; ?></td>
                <td><?= $q['produk']; ?></td>
                <td><?= $q['question']; ?></td>
                <td><?= substr($q['created_at'], 0, 10) ?></td>
                <?php if ($q['status'] == null || $q['status'] == 1) : ?>
                  <td><a href="" data-id="<?= $q['id']; ?>" class="badge badge-primary mQnA">Respon</a></td>
                <?php else : ?>
                  <td><a href="" data-id="<?= $q['id']; ?>" class="badge badge-secondary mQnA">Respon</a></td>
                <?php endif; ?>
                <td>
                  <a href="" class="badge badge-success" data-toggle="modal" data-target="#detail">Detail</a>
                  <a href="<?= base_url('uploader/delete/qna/' . $q['id']) ?>" class="badge badge-danger" onclick="return alert('Yakin ingin menghapus');">Delete</a>
                </td>
              </tr>
              <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
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
                        <label for="created_at">Tanggal Pertanyaan</label>
                        <input type="text" class="form-control" id="created_at" value="<?= substr($q['created_at'], 0, 10) ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="pesan">Tanggal Pertanyaan</label>
                        <textarea class="form-control" id="pesan" readonly><?= $q['question'] ?></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add Data</button>
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

<!-- Modal Answer QnA -->
<form action="<?= base_url('uploader/updateAnswer/') ?>" method="post" id="answerQnA">
  <div class="modal fade" id="mAnswerQnA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Answer Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="setQnA">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Data</button>
        </div>
      </div>
    </div>
  </div>
</form>