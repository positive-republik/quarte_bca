
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
                <img src="<?= base_url('assets/img/slider/1.jpeg')?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/slider/2.jpeg') ?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/slider/3.jpeg') ?>" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/slider/4.jpeg') ?>" class="d-block w-100">
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
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#reqData"><i class="fas fa-file-import fa-sm text-white-50"></i> Request Data</a>
    </div>

    <form>
        <div class="form-group">
            <label for="produk">Produk</label>
            <select class="form-control" id="produk">
                <option selected disabled>-- Pilih Produk --</option>
                <?php foreach($produk->result_array() as $key) : ?>
                <option value="<?= $key['id'] ?>"><?= $key['produk'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" id="kategori">
                <option selected disabled>-- Pilih Kategori --</option>
                <?php foreach($kategori->result_array() as $key) : ?>
                <option value="<?= $key['id'] ?>"><?= $key['kategori'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="startDate">Bulan Awal</label>
            <input type="date" id="startDate" class="form-control">
        </div>
        <div class="form-group">
            <label for="endDate">Bulan Akhir</label>
            <input type="date" id="endDate" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-2 mb-5">Run Report</button>
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
                <div class="form-group">
                    <label for="reqTitle">Judul Permintaan</label>
                    <input type="text" class="form-control" id="reqTitle" name="reqTitle">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="email" class="form-control" id="nama" value="<?= $user_info['full_name'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" class="form-control" id="posisi" value="<?= $roleName['name_role'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="req_purpose">Tujuan Permintaan</label>
                    <input type="text" class="form-control" id="req_purpose" name="req_purpose">
                </div>
                <div class="form-group">
                    <label for="startDate">Bulan Awal</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
                <div class="form-group">
                    <label for="endDate">Bulan Akhir</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
                <div class="form-group">
                    <label for="priority">Prioritas</label>
                    <select class="form-control" id="priority" name="priority">
                        <option value="1">Priority</option>
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
