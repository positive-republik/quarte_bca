<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">Request Management</h1>
    </div>

    <!-- DataTales Users -->
    <div class="card shadow-sm mb-5">    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Permintaan</th>
                            <th>Tujuan Permintaan</th>
                            <th>Nama Peminta</th>
                            <th>Awal Bulan</th>
                            <th>Akhir Bulan</th>
                            <th>Prioritas</th>
                            <th>Respon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($reqDataManage->result_array() AS $key) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $key['req_title'] ?></td>
                            <td><?= $key['req_purpose'] ?></td>
                            <td><?= $key['requester_name'] ?></td>
                            <td><?= $key['req_start'] ?></td>
                            <td><?= $key['req_end'] ?></td>
                            <td><?= $key['req_priority'] ?></td>
                            <td><a href="#" class="badge badge-primary">Respon</a></td>
                        </tr>
                        <?php $i++; endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
