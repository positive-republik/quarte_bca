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
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Complaint <?= $produk ?></div>
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
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Request <?= $produk ?></div>
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
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Info <?= $produk ?></div>
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
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Saran <?= $produk ?></div>
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
    <!-- Top 10 -->
    <div class="col-md-8">
      <!-- Compl -->
      <div class="card shadow">
        <a href="#topCompl" class="d-block card-header py-3 border-left-danger" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="topCompl">
          <h6 class="m-0 font-weight-bold text-danger">TOP 10 Complaint <?= $produk ?></h6>
        </a>
        <div class="collapse show" id="topCompl">
          <div class="card-body">
            <ul class="list-group">
              <?php if(isset($topReq)) : ?>
                <?php foreach($topReq as $key) : ?>
                  <?php if(stristr($key['kategori'], 'COMPL/')) : ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $key['kategori']; ?>
                    <span class="badge badge-primary badge-pill"><?= $key['cnt'] ?></span>
                  </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- Req -->
      <div class="card shadow">
        <a href="#topReq" class="d-block card-header py-3 border-left-warning" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="topReq">
          <h6 class="m-0 font-weight-bold text-warning">TOP 10 Request <?= $produk ?></h6>
        </a>
        <div class="collapse show" id="topReq">
          <div class="card-body">
            <ul class="list-group">
              <?php if(isset($topReq)) : ?>
                <?php foreach($topReq as $key) : ?>
                  <?php if(stristr($key['kategori'], 'REQ/')) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <?= $key['kategori']; ?>
                      <span class="badge badge-primary badge-pill"><?= $key['cnt'] ?></span>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- Info -->
      <div class="card shadow">
        <a href="#topInfo" class="d-block card-header py-3 border-left-primary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="topInfo">
          <h6 class="m-0 font-weight-bold text-primary">TOP 10 Info <?= $produk ?></h6>
        </a>
        <div class="collapse show" id="topInfo">
          <div class="card-body">
            <ul class="list-group">
              <?php if(isset($topReq)) : ?>
                <?php foreach($topReq as $key) : ?>
                  <?php if(stristr($key['kategori'], 'INF/')) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <?= $key['kategori']; ?>
                      <span class="badge badge-primary badge-pill"><?= $key['cnt'] ?></span>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- Saran -->
      <div class="card shadow">
        <a href="#topSaran" class="d-block card-header py-3 border-left-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="topSaran">
          <h6 class="m-0 font-weight-bold text-success">TOP 10 Saran <?= $produk ?></h6>
        </a>
        <div class="collapse show" id="topSaran">
          <div class="card-body">
            <ul class="list-group">
              <?php if(isset($topReq)) : ?>
                <?php foreach($topReq as $key) : ?>
                  <?php if(stristr($key['kategori'], 'SARAN/')) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <?= $key['kategori']; ?>
                      <span class="badge badge-primary badge-pill"><?= $key['cnt'] ?></span>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- Growth -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">GROWTH</h6>
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