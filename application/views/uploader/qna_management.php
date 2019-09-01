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
                            <th>Produk</th>
                            <th>Peranyaan</th>
                            <th>Respon</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i =1;
                    foreach ( $qna->result_array() as $q ) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $q['produk']; ?></td>
                            <td><?= $q['question']; ?></td>
                            <td><a href="" data-id="<?= $q['id']; ?>" class="badge badge-primary mQnA">Respon</a></td>
                        </tr>
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
