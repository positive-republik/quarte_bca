<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Report Result</h1>
    
    <!-- Export button -->
    <form action="<?= base_url('guest/excelreport') ?>"  method="post">
        <input type="hidden" name="start" value="<?= $this->input->post('start') ?>" required>
        <input type="hidden" name="end"  value="<?= $this->input->post('end') ?>" required>
        <?php foreach($this->input->post('kategori') as $key) : ?>
        <input type="hidden" name="kategori[]"  value="<?= $key ?>" required>
        <?php endforeach; ?>
        <input type="hidden" name="produk"  value="<?= $this->input->post('produk') ?>" required>
        <button type="submit" class="d-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-file-import fa-sm text-white-50"></i> Export To Excel</a>
    </form>
  </div>

  <!-- Grafik Perkembangan -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Grafik Perkembangan </h6>
    </div>
    <div class="card-body">
      <div class="chart-area">
        <canvas id="myAreaChart"></canvas>
      </div>
    </div>
  </div>
  
  <!-- Statistik Perkembangan -->
  <div class="row my-5">

    <div class="col-md-3">
      <div class="card border-left-danger shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Complaint <?= $produk ?></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counterDataCompl['cnt'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-angry fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //.. Grafik Complaint -->
    <div class="col-md-3">
      <div class="card border-left-warning shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Request <?= $produk ?></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counterDataReq['cnt'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comment-dots fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //.. Grafik Request -->
    <div class="col-md-3">
      <div class="card border-left-primary shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Info <?= $produk ?></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counterDataInf['cnt'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-info-circle fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //.. Grafik Info -->
    <div class="col-md-3">
      <div class="card border-left-success shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saran <?= $produk ?></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counterDataSaran['cnt'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-mail-bulk fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //.. Saran -->
  </div>

  <!-- Statitik angka dan top ten -->
  <div class="row mb-4">
    <div class="col-md-8">
      <!-- Top 10 -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Rekomendasi</h6>
        </div>
        <div class="card-body">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action border-left-danger ">TOP 10 Compl <?= $produk ?></a>
            <a href="#" class="list-group-item list-group-item-action border-left-warning ">TOP 10 Req <?= $produk ?></a>
            <a href="#" class="list-group-item list-group-item-action border-left-primary ">TOP 10 Inf <?= $produk ?></a>
            <a href="#" class="list-group-item list-group-item-action border-left-success ">TOP 10 Saran <?= $produk ?></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- Growth -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Grafik Perkembangan</h6>
        </div>
        <div class="card-body">
          <p><b>Plus (+)</b> adalah peningkatan , <b>Minus (-)</b> adalah penurunan</p>
          <h1 class="text-primary font-weight-bold"><?= $GetGrowthPercent ?>%</h1>
        </div>
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