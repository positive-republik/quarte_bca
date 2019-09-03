<!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url('assets/img/favicon.png') ?>" width="30">
        </div>
        <div class="sidebar-brand-text mx-3">Quartee</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <?php if($this->session->userdata('role') != 2) : ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Data Upload</span></a>
      </li>
      <?php endif; ?>
      <!-- Divider -->
      
      <?php if($this->session->userdata('role') == 2) : ?>

      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('uploader/qna_manage') ?>">
          <i class="fas fa-fw fa-comments"></i>
          <span>Qna Management</span></a>
      </li>

      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('uploader/req_manage') ?>">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Request Management</span></a>
      </li>

      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('uploader/filing_cabinet') ?>">
          <i class="fas fa-fw fa-server"></i>
          <span>Filing Cabinet</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <?php elseif($this->session->userdata('role') == 3) : ?>
      <!-- Heading -->
      <div class="sidebar-heading">
        Guest Panel
      </div>

      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('guest/qna'); ?>">
          <i class="fas fa-fw fa-comments"></i>
          <span>Qna</span></a>
      </li>

      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('guest/request'); ?>">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Request</span></a>
      </li>


      <!-- Nav Item - Data Management -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('guest/filing_cabinet'); ?>">
          <i class="fas fa-fw fa-server"></i>
          <span>Filing Cabinet</span></a>
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
