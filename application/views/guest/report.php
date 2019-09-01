<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Report Result</h1>
    <!-- Add button trigger -->
    <a href="#" class="d-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-file-import fa-sm text-white-50"></i> Export To Excel</a>
  </div>

   <!-- Grafik Perkembangan -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Grafik Perkembangan</h6>
    </div>
    <div class="card-body">
      <div class="chart-area">
        <canvas id="myAreaChart"></canvas>
      </div>
    </div>
  </div>
  
  <!-- DataTales Users -->
  <div class="card shadow-sm mb-5">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Priode</th>
              <th>Produk</th>
              <th>Kategori</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
          
            <?php $i=1; foreach($data as $key) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= date('M',mktime(0, 0, 0, $key['month'], 12)) ?></td>
                <td><?= $key['produk'] ?></td>
                <td><?= $key['kategori'] ?></td>
                <td><?= $key['cnt'] ?></td>
            </tr>
            <?php $i++; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->