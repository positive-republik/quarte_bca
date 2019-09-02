    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            
            <!-- Just show for uploader and guest -->
            <?php if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3) : ?>
            
              <!-- Display for uploader -->
              <?php if($this->session->userdata('role') == 2 ) : ?>
              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Request -->
                  <?php if($req->num_rows()>0) : ?>
                  <span class="badge badge-danger badge-counter"><?= $req->num_rows() ?></span>
                  <?php endif; ?>
                </a>
                <!-- Dropdown - Request -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Request Center
                  </h6>
                  <?php foreach($req->result_array() as $key) : ?>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500"><?= substr($key['created_at'],0,10) ?></div>
                      <div class="font-weight-bold text-truncate"><?= $key['req_title'] ?></div>
                    </div>
                  </a>
                  <?php endforeach; ?>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Qna -->
                  <?php if($qna->num_rows()>0) : ?>
                  <span class="badge badge-danger badge-counter"><?= $qna->num_rows() ?></span>
                  <?php endif; ?>
                </a>
                <!-- Dropdown - Qna -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                    Qna Center
                  </h6>
                    <?php foreach($qna->result_array() as $key) : ?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                        <div class="status-indicator bg-success"></div>
                      </div>
                      <div class="font-weight-bold">
                        <div class="text-truncate"><?= $key['question'] ?></div>
                        <div class="small text-gray-500"><?= $key['asker_name'] ?> · <?= substr($key['created_at'],0,10) ?></div>
                      </div>
                    </a>
                    <?php endforeach; ?>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
              </li>
              <?php endif; ?>

              <!-- Display for Guest -->
              <?php if($this->session->userdata('role') == 3 ) : ?>
              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Request -->
                  <?php if($req->num_rows()>0 && $req->num_rows()<5) : ?>
                  <span class="badge badge-danger badge-counter"><?= $req->num_rows() ?></span>
                    <?php elseif($req->num_rows()>=5) : ?>
                    <span class="badge badge-danger badge-counter">5+</span>
                  <?php endif; ?>
                </a>
                <!-- Dropdown - Request -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Request Center
                  </h6>
                  <?php foreach($req->result_array() as $key) : ?>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="font-weight-bold text-truncate"><?= $key['req_title'] ?></div>
                      <div class="small text-gray-500 text-truncate"><?= $key['created_at'] ?></div>
                    </div>
                  </a>
                  <?php endforeach; ?>

                  <?php if($req->num_rows()>0) : ?>
                  <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('guest/request') ?>" >Show All Alerts</a>
                    <?php elseif($req->num_rows()==0) : ?>
                    <div class="alert alert-warning" role="alert">
                      Anda belum merequest data. <a href="<?= base_url('guest/request'); ?>" class="alert-link">Klik Disini</a> untuk request data
                    </div>
                  <?php endif; ?>
                </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Qna -->
                  <?php if($qna->num_rows()>0 && $qna->num_rows()<=5) : ?>
                  <span class="badge badge-danger badge-counter"><?= $qna->num_rows() ?></span>
                    <?php elseif($qna->num_rows()>=5) : ?>
                    <span class="badge badge-danger badge-counter">5+</span>
                  <?php endif; ?>
                </a>
                <!-- Dropdown - Qna -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                    Qna Center
                  </h6>
                  <?php if ( count($qna->result_array()) != 0 ) : ?>
                    <?php foreach($qna->result_array() as $key) : ?>
                      <?php if ( $key['status'] == 1 ) : ?>
                      <div class="alert alert-warning" role="alert">
                        Pertanyaan anda belum direspon
                      </div>
                      <?php elseif ( $key['status'] == 2 ) : ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('guest/read/' . $key['id']) ?>">
                          <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                            <!-- <a href="#" class="badge badge-primary">Primary</a> -->
                            <div class="status-indicator bg-success"></div>
                          </div>
                          <div class="font-weight-bold">
                            <div class="text-truncate"><?= $key['question'] ?></div>
                            <div class="small text-gray-500"><?= $key['asker_name'] ?> · <?= substr($key['created_at'],0,10) ?> </div>
                          </div>
                        </a>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php else: ?>
                  <div class="alert alert-warning" role="alert">
                    Anda belum mengajukan pertanyaan, klik <a href="<?= base_url('guest/qna'); ?>" class="alert-link">disini</a> untuk bertanya.
                    <!-- <?php var_dump(count($qna->result_array())); ?> -->
                  </div>
                  <?php endif; ?>
                    <!-- Check if null -->
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
              </li>
              <?php endif; ?>
            
            <div class="topbar-divider d-none d-sm-block"></div>
            <?php endif; ?>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user_info['full_name'] ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
