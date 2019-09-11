
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Carousel Guest -->
    <div id="guestSlider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#guestSlider" data-slide-to="0" class="active"></li>
            <li data-target="#guestSlider" data-slide-to="1"></li>
            <li data-target="#guestSlider" data-slide-to="2"></li>
            <li data-target="#guestSlider" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/img/slider/1.png')?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/slider/2.png') ?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/slider/3.png') ?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/slider/4.png') ?>" class="d-block w-100">
            </div>
        </div>
        <a class="carousel-control-prev" href="#guestSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#guestSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-5">
        <!-- Request button trigger -->
        <a href="#" class="d-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#reqData"><i class="fas fa-file-import fa-sm text-white-50"></i> Request Data</a>
    </div>

    <form action="<?= base_url('guest/report') ?>" method="post">
        <?php if(!isset($_GET['produk'])) : ?>
        <div class="form-group">
            <label for="produk ">Produk</label>
            <select class="form-control kategori" id="produk" name="produk">
                <option selected disabled>-- Pilih Produk --</option>
                <?php foreach($produk->result_array() as $key) : ?>
                <option value="<?= $key['produk'] ?>"><?= $key['produk'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <a href="" class="my-2 btn btn-sm btn-primary shadow-sm show-kat">Show Kategori</a>
        <?php endif; ?>

        <?php if(isset($_GET['produk'])) : ?>
        <input type="hidden" value="<?= $_GET['produk'] ?>" name="produk" required>
        <div class="form-group after-add-more">
            <label for="kategori">Kategori</label>
            <select class="form-control" id="kategori" name="kategori[]" required>
                <option selected disabled>-- Pilih Kategori --</option>
                <?php foreach($kategori->result_array() as $key) : ?>
                    <?php if($key['produk_name'] == $_GET['produk']) : ?>
                    <option value="<?= $key['kategori'] ?>"><?= $key['kategori'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="button" class="my-2 btn btn-sm btn-primary shadow-sm add-more"><i class="fas fa-plus-square fa-sm text-white-50"></i> Add New Kategori</button>
        <div class="copy d-none form-group">
            <select class="form-control" id="kategori" name="kategori[]" >
                <option selected disabled>-- Pilih Kategori --</option>
                <?php foreach($kategori->result_array() as $key) : ?>
                    <?php if($key['produk_name'] == $_GET['produk']) : ?>
                    <option value="<?= $key['kategori'] ?>"><?= $key['kategori'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="startDate">Bulan Awal</label>
            <input id="awalBulan" class="form-control" name="start" required>
        </div>
        <div class="form-group">
            <label for="endDate">Bulan Akhir</label>
            <input id="akhirBulan" class="form-control" name="end" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-2 mb-5">Run Report</button>
        <?php endif; ?>
    </form>
</div>
<!-- /.container-fluid -->

<!-- Modal Request -->
<div class="modal fade" id="reqData" tabindex="-1" role="dialog" aria-labelledby="reqDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reqDataLabel">Request Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('guest/addReqData') ?>"  method="post"> 
            <div class="modal-body">
                <input type="hidden" class="form-control" value="<?= $user_info['id'] ?>" name="req_id" readonly>
                <input type="hidden" class="form-control" value="<?= $user_info['extention'] ?>" name="req_extention" readonly>
                <input type="hidden" class="form-control" value="<?= $user_info['email'] ?>" name="req_email" readonly>
                <div class="form-group">
                    <label for="reqTitle">Judul Permintaan</label>
                    <input type="text" class="form-control" id="reqTitle" name="reqTitle" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" value="<?= $user_info['full_name'] ?>" name="requester_name" readonly>
                </div>
                <div class="form-group">
                    <label for="posisi">Hak Akses</label>
                    <input type="text" class="form-control" id="posisi" value="<?= $roleName['name_role'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="req_purpose">Tujuan Permintaan</label>
                    <input type="text" class="form-control" id="req_purpose" name="req_purpose" required>
                </div>
                <div class="form-group">
                    <label for="awalBulan2">Bulan Awal</label>
                    <input class="form-control" id="awalBulan2" name="startDate" required>
                </div>
                <div class="form-group">
                    <label for="akhirBulan2">Bulan Akhir</label>
                    <input class="form-control" id="akhirBulan2" name="endDate" required>
                </div>
                <div class="form-group">
                    <label for="priority">Prioritas</label>
                    <select class="form-control" id="priority" name="priority" required>
                        <option value="1">Urgent</option>
                        <option value="2">Hight</option>
                        <option value="3">Medium</option>
                        <option value="4">Low</option>
                    </select>
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
