<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">Request</h1>
        <!-- Add button trigger -->
        <a href="<?= base_url('guest/export_excel_request/').$user_info['id'] ?>" class="d-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-import fa-sm text-white-50"></i> Export To Excel</a>
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
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($req_data->result_array() as $key) : ?>
                        <tr>
                            <td><?= $key['id'] ?></td>
                            <td><?= $key['produk'] ?></td>
                            <td><?= $key['kategori'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
  </div>

</div>
<!-- /.container-fluid -->
