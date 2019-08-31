<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- Add button trigger -->
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addUser"><i class="fas fa-user-plus fa-sm text-white-50"></i> Add New User</a>
    </div>

    <div class="card w-100 my-2" >
        <div class="card-body">
            <h5 class="card-title">Bca klik pay</h5>
            <p class="card-text">Untuk masalah pembayaran 2x bisa melihat refensi pada link berikut di bawah ini</p>
            <a href="#" class="card-link">Klik Disini</a>
        </div>
    </div>

    <div class="card w-100 my-2" >
        <div class="card-body">
            <h5 class="card-title">Bca klik pay</h5>
            <p class="card-text">Untuk masalah pembayaran 2x bisa melihat refensi pada link berikut di bawah ini</p>
            <a href="#" class="card-link">Klik Disini</a>
        </div>
    </div>
    
    <!-- Search qna -->
    <form>
        <div class="form-group mt-5">
            <label for="produk">Produk</label>
            <select class="form-control" id="produk">
                <option>-- Pilih Produk --</option>
                <?php foreach($produk->result_array() as $key) : ?>
                <option value="<?= $key['produk'] ?>"><?= $key['produk'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cari Pertanyaan</button>
    </form>
</div>
<!-- /.container-fluid -->
