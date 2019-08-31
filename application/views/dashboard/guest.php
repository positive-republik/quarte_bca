
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
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addUser"><i class="fas fa-file-import fa-sm text-white-50"></i> Request Data</a>
    </div>

    <form>
        <div class="form-group">
            <label for="produk">Produk</label>
            <select class="form-control" id="produk">
                <option selected disabled>-- Pilih Produk --</option>
                <option>2</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" id="kategori">
                <option selected disabled>-- Pilih Kategori --</option>
                <option>2</option>
            </select>
        </div>
    </form>

</div>
<!-- /.container-fluid -->
