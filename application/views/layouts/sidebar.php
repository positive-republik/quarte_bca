<!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quartee</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url() ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <?php if($this->session->userdata('role') == 1) : ?>
      <!-- Heading -->
      <div class="sidebar-heading">
        Admin Panel
      </div>

      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Management</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php elseif($this->session->userdata('role') == 2) : ?>

      <!-- Heading -->
      <div class="sidebar-heading">
        Uploader Panel
      </div>

      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-comments"></i>
          <span>Qna Management</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <?php endif; ?>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
