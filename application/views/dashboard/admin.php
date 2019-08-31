
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <!-- Add button trigger -->
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addUser"><i class="fas fa-user-plus fa-sm text-white-50"></i> Add New User</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- All User Card -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-primary shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All user in database</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_all_users ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-friends fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- All Uploader Card -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-success shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Uploader in database</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_uploader ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users-cog fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- All Guest Card -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-info shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Guest in database</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_guest ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-tie fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- All Data -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-warning shadow-sm h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data in database</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-database fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End Content Row -->
   
  <!-- DataTales Users -->
  <div class="card shadow-sm mb-5">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">User Management</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Hak Akses</th>
              <th>Unit Keja</th>
              <th>NIP</th>
              <th>Email</th>
              <th>Domain</th>
              <th>Job Title</th>
              <th>Username</th>
              <th>Password</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          
            <?php $i=0; foreach($users as $key) : ?>
            <tr>
              <td><?= $key['full_name'] ?></td>
              <td><?= $role_info[$i]['name_role'] ?></td>
              <td><?= $key['unit_kerja'] ?></td>
              <td><?= $key['nip'] ?></td>
              <td><?= $key['email'] ?></td>
              <td><?= $key['domain'] ?></td>
              <td><?= $role_info[$i]['job_desc'] ?></td>
              <td><?= $key['username'] ?></td>
              <td><?= $key['password'] ?></td>
              <td><?= substr($key['created_at'],0,10) ?></td>
              <td>
                <!-- <a href="#" class="badge badge-warning p-2"><i class="fas fa-edit"></i></a> -->
                <button type="button" class="badge badge-warning p-2 btnEdit" data-id="<?= $key['id']; ?>" data-toggle="modal" data-target="#editUser"><i class="fas fa-edit"></i></button>
                <button type="button" class="badge badge-danger p-2 mDelete" data-id="<?= $key['id']; ?>" <?php echo ( $this->session->userdata('id_user') == $key['id'] ? 'disabled' : '' ); ?>><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<!-- Add Invalid Alert -->
<?php if($this->session->flashdata('errAdd')) : ?>
    <?= "<script>
        swal('Add New User Invalid', 'If there are problems new user submission process please contact Ward (Ext. 57242)', 'error')
    </script>"; ?>
    
    <!-- Add Success Alert -->
    <?php elseif($this->session->flashdata('succAdd')) : ?>
    <?= "<script>
        swal('Add New User Success', ' ', 'success')
    </script>"; ?>
<?php endif; ?>


<!-- Add Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('admin/addUser') ?>">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control bg-light" placeholder="Nama Lengkap" name="full_name" value="<?= set_value('full_name') ?>" required>
          </div>
          <div class="form-group">
            <select class="form-control bg-light" name="role_id" required>
              <option selected disabled>Hak Akses</option>
              <option value="1">Admin</option>
              <option value="2">Uploader</option>
              <option value="3">Guest</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control bg-light" placeholder="Unit Kerja" name="unit_kerja" value="<?= set_value('unit_kerja') ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control bg-light" placeholder="Nip" name="nip" value="<?= set_value('nip') ?>" required>
            <small  class="form-text text-danger"><?= form_error('nip') ?></small>
          </div>
          <div class="form-group">
            <input type="email" class="form-control bg-light" placeholder="Email" name="email" value="<?= set_value('email') ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control bg-light" placeholder="Extention" name="extention" value="<?= set_value('extention') ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control bg-light" placeholder="Domain" name="domain" value="<?= set_value('domain') ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control bg-light" placeholder="Username" name="username" value="<?= random_string('alnum', 6) ?>" required>
            <small  class="form-text text-danger"><?= form_error('username') ?></small>
          </div>
          <div class="form-group">
            <input type="text" class="form-control bg-light" placeholder="Password"  name="password" value="<?= random_string('alnum', 6) ?>" required>
            <small  class="form-text text-danger"><?= form_error('password') ?></small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<form action="<?= base_url('Admin/update/'); ?>" method="post" id="updateData">

<!-- Edit Modal -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editData">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary ">Save changes</button>
      </div>
    </div>
  </div>
</div>

</form>

<!-- Delete Modal -->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="deleteData">
        <h1>Are you sure ?</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btnDelete">Save changes</button>
      </div>
    </div>
  </div>
</div>