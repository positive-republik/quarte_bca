<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">QnA</h1>
        <!-- Add button trigger -->
        <button href="#" class="d-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addQnA"><i class="fas fa-comment-medical fa-sm text-white-50"></i> Add New Question</button>
    </div>


    <!-- Search qna -->
    <form class="my-5" action="" method="post">
        <div class="form-group ">
            <label for="produk">Produk</label>
            <select class="form-control" id="produk" name="produk" required>
                <option>-- Pilih Produk --</option>
                <?php foreach($produk->result_array() as $key) : ?>
                <option value="<?= $key['produk'] ?>"><?= $key['produk'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cari Pertanyaan</button>
    </form>

		<?php if ( isset($quest) ) : ?>
			<?php if ( count($quest) != 0 ) : ?>
				<?php foreach ( $quest as $q ) : ?>
					<div class="card w-100 my-5 shadow-sm" >
							<div class="card-body">
                <h5 class="card-title"><?= $q['produk']; ?></h5>
                <hr>
                <p>asked by <b><?= $q['asker_name'] ?></b> at <?= substr($q['created_at'],0,10) ?></p>
								<p><?= $q['question'] ?></p>	
							</div>
              <div class="card-footer bg-light pb-0">
                <p class="card-text"><?= $q['answer']; ?></p>
                <a href="<?= $q['answer_link'] ?>" class="card-link btn btn-primary" download>Klik Disini</a>
                <p class="text-right">answered by <b><?= $q['answer_name'] ?></b> at <?= substr($q['created_at'],0,10) ?></p>
              </div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
			<div class="alert alert-warning" role="alert">
				Pertannyan yang bersangkutan belum tersedia, silakan bertanya
			</div>
			<?php endif; ?>
		<?php endif; ?>
</div>
<!-- /.container-fluid -->

<!-- Add QnA -->
<form action="<?= base_url('guest/addQnA') ?>" method="post">
<div class="modal fade" id="addQnA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New QnA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="form-group">
					<label for="produk">Produk</label>
					<select class="form-control" id="produk" name="produk" required>
						<option>-- Pilih Produk --</option>
						<?php foreach($produk->result_array() as $key) : ?>
						<option value="<?= $key['produk'] ?>"><?= $key['produk'] ?></option>
						<?php endforeach; ?>
					</select>
        </div>
				<div class="form-group">
					<label for="question">Question</label>
					<textarea class="form-control" id="question" name="question" rows="5" required></textarea>
				</div>
				<input type="hidden" name="id" value="<?= $user_info['id'] ?>">
				<input type="hidden" name="username" value="<?= $user_info['username'] ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Data</button>
      </div>
    </div>
  </div>
</div>
</form>