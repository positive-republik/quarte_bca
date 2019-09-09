    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-dark text-gray-100 bg-gray-800 topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Just show for uploader and guest -->
            <?php if ($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3) : ?>

              <!-- Display for uploader -->
              <?php if ($this->session->userdata('role') == 2) : ?>
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Request -->
                    <?php if ($req->num_rows() > 0) : ?>
                      <span class="badge badge-danger badge-counter"><?= $req->num_rows() ?></span>
                    <?php endif; ?>
                  </a>
                  <!-- Dropdown - Request -->
                  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="max-height:500px; overflow-y:auto;">
                    <h6 class="dropdown-header bg-gray-800 border-0">
                      Request Center
                    </h6>
                    <?php foreach ($req->result_array() as $key) : ?>
                      <a class="dropdown-item d-flex align-items-center upload_req" href="#" data-toggle="modal" data-target="#uploadreqModal" data-id="<?= $key['id'] ?>">
                        <div class="mr-3">
                          <div class="icon-circle bg-gray-800">
                            <i class="fas fa-file-alt text-white"></i>
                          </div>
                        </div>
                        <div>
                          <div class="small text-gray-500"><?= substr($key['created_at'], 0, 10) ?></div>
                          <div class="font-weight-bold text-truncate"><?= $key['req_title'] ?></div>
                        </div>
                      </a>
                    <?php endforeach; ?>
                    <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('uploader/req_manage') ?>">Read More Request</a>
                  </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <!-- Counter - Qna -->
                    <?php if ($qna->num_rows() > 0) : ?>
                      <span class="badge badge-danger badge-counter"><?= $qna->num_rows() ?></span>
                    <?php endif; ?>
                  </a>
                  <!-- Dropdown - Qna -->
                  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" style="max-height:500px; overflow-y:auto;">
                    <h6 class="dropdown-header bg-gray-800 border-0">
                      Qna Center
                    </h6>
                    <?php foreach ($qna->result_array() as $key) : ?>
                      <a class="dropdown-item d-flex align-items-center qna_uploader" href="#" data-toggle="modal" data-target="#uploadqnaModal" data-id="<?= $key['id'] ?>">
                        <div class="dropdown-list-image mr-3">
                          <img class="rounded-circle" src="<?= base_url('assets/img/pp.png') ?>" alt="">
                          <div class="status-indicator bg-danger"></div>
                        </div>
                        <div class="font-weight-bold">
                          <div class="text-truncate"><?= $key['question'] ?></div>
                          <div class="small text-gray-500"><?= $key['asker_name'] ?> · <?= substr($key['created_at'], 0, 10) ?></div>
                        </div>
                      </a>
                    <?php endforeach; ?>
                    <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('uploader/qna_manage') ?>">Read More Messages</a>
                  </div>
                </li>
              <?php endif; ?>

              <!-- Display for Guest -->
              <?php if ($this->session->userdata('role') == 3) : ?>
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Request -->
                    <?php if ($req->num_rows() > 0) : ?>
                      <?php $countQna = 0;
                            foreach ($req->result_array() as $key) : ?>
                        <?php if ($key['req_status'] == 2) {
                                  $countQna = $countQna + 1;
                                } ?>
                      <?php endforeach; ?>
                      <?php if ($countQna > 0) : ?>
                        <span class="badge badge-danger badge-counter"><?= $countQna; ?></span>
                      <?php endif; ?>
                    <?php endif; ?>
                  </a>
                  <!-- Dropdown - Request -->
                  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="max-height:500px; overflow-y:auto;">
                    <h6 class="dropdown-header bg-gray-800 border-0">
                      Request Center
                    </h6>
                    <?php if (count($req->result_array()) != 0) : ?>
                      <?php foreach ($req->result_array() as $key) : ?>
                        <?php if ($key['req_status'] == 3) : ?>
                          <a class="dropdown-item d-flex align-items-center reqDetail" href="#" data-toggle="modal" data-target="#reqModal" data-id="<?= $key['id'] ?>" style="background-color:#eee;">
                          <?php else : ?>
                            <a class="dropdown-item d-flex align-items-center reqDetail" href="#" data-toggle="modal" data-target="#reqModal" data-id="<?= $key['id'] ?>">
                            <?php endif; ?>
                            <div class="mr-3">
                              <div class="dropdown-list-image mr-3">
                                <div class="icon-circle bg-gray-800 ">
                                  <i class="fas fa-file-alt text-white"></i>
                                </div>
                                <!-- <a href="#" class="badge badge-primary">Primary</a> -->
                                <?php if ($key['req_status'] == 3) : ?>
                                  <div class="status-indicator bg-danger"></div>
                                <?php else : ?>
                                  <div class="status-indicator bg-success"></div>
                                <?php endif; ?>
                              </div>
                              <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                              <div class="font-weight-bold text-truncate"><?= $key['req_title'] ?></div>
                              <div class="small text-gray-500 text-truncate"><?= $key['answer_name'] ?> · <?= substr($key['created_at'], 0, 10) ?></div>
                            </div>
                            </a>
                          <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($req->num_rows() > 0) : ?>
                          <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('guest/request') ?>">Show All Alerts</a>
                        <?php elseif ($req->num_rows() == 0) : ?>
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
                    <?php if ($req->num_rows() > 0) : ?>
                      <?php $countQna = 0;
                            foreach ($qna->result_array() as $key) : ?>
                        <?php if ($key['status'] == 2) {
                                  $countQna = $countQna + 1;
                                } ?>
                      <?php endforeach; ?>
                      <?php if ($countQna > 0) : ?>
                        <span class="badge badge-danger badge-counter"><?= $countQna; ?></span>
                      <?php endif; ?>
                    <?php endif; ?>
                  </a>
                  <!-- Dropdown - Qna -->
                  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" style="max-height:500px; overflow-y:auto;">
                    <h6 class="dropdown-header bg-gray-800 border-0">
                      Qna Center
                    </h6>
                    <?php if (count($qna->result_array()) != 0) : ?>
                      <?php foreach ($qna->result_array() as $key) : ?>
                        <?php if ($key['status'] == 3) : ?>
                          <a class="dropdown-item d-flex align-items-center qna-detail" data-toggle="modal" data-target="#qnaModal" data-id="<?= $key['id'] ?>" style="background-color:#eee;">
                          <?php else : ?>
                            <a class="dropdown-item d-flex align-items-center qna-detail" data-toggle="modal" data-target="#qnaModal" data-id="<?= $key['id'] ?>">
                            <?php endif; ?>
                            <div class="dropdown-list-image mr-3 ">
                              <img class="rounded-circle" src="<?= base_url('assets/img/pp.png') ?>" alt="">
                              <!-- <a href="#" class="badge badge-primary">Primary</a> -->
                              <?php if ($key['status'] == 3) : ?>
                                <div class="status-indicator bg-danger"></div>
                              <?php else : ?>
                                <div class="status-indicator bg-success"></div>
                              <?php endif; ?>
                            </div>
                            <?php if ($key['status'] == 3) : ?>
                              <div class="font-weight-bold">
                                <div class="text-truncate"><?= $key['produk'] ?></div>
                                <div class="small text-gray-500"><?= $key['answer_name'] ?> · <?= substr($key['created_at'], 0, 16) ?> </div>
                              </div>
                            <?php else : ?>
                              <div class="font-weight-bold text-black">
                                <div class="text-truncate"><?= $key['produk'] ?></div>
                                <div class="small text-gray-500"><?= $key['answer_name'] ?> · <?= substr($key['created_at'], 0, 16) ?> </div>
                              </div>
                            <?php endif; ?>
                            </a>
                          <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($req->num_rows() > 0) : ?>
                          <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('guest/qna') ?>">Show All Alerts</a>
                        <?php elseif ($req->num_rows() == 0) : ?>
                          <div class="alert alert-warning" role="alert">
                            Anda belum bertanya <a href="<?= base_url('guest/qna'); ?>" class="alert-link">Klik Disini</a> untuk bertanya
                          </div>
                        <?php endif; ?>
                  </div>
                </li>
              <?php endif; ?>

              <div class="topbar-divider d-none d-sm-block"></div>
            <?php endif; ?>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user_info['full_name'] ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/pp.png') ?>">
              </a>
              <!-- Dropdown - User Information -->
              <style>
                .dropdown-item:hover {
                  color: white;
                  background-color: #4e73de;
                }
              </style>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in bg-gray-800" aria-labelledby="userDropdown">
                <a class="dropdown-item text-gray-100 drop-logout" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-100"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


        <!-- Chat Uploader Modal -->
        <div class="modal fade" id="uploadqnaModal" tabindex="-1" role="dialog" aria-labelledby="uploadqnaModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="uploadqnaModalLabel">Qna Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="produk">Produk</label>
                  <input type="text" class="form-control" id="produk" readonly>
                </div>
                <div class="form-group">
                  <label for="asker_name">Nama Penanya</label>
                  <input type="text" class="form-control" id="asker_name" readonly>
                </div>
                <div class="form-group">
                  <label for="produk">Tanggal Pertanyaan</label>
                  <input type="text" class="form-control" id="date" readonly>
                </div>
                <div class="form-group">
                  <label for="quest">Pertanyaan</label>
                  <textarea id="quest" class="form-control" readonly></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Request Uploader Modal -->
        <div class="modal fade" id="uploadreqModal" tabindex="-1" role="dialog" aria-labelledby="uploadreqModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="uploadreqModalLabel">Request Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="upload_req_title">Judul Request</label>
                  <input type="text" class="form-control" id="upload_req_title" readonly>
                </div>
                <div class="form-group">
                  <label for="upload_answer_name">Nama Requester</label>
                  <input type="text" class="form-control" id="upload_answer_name" readonly>
                </div>
                <div class="form-group">
                  <label for="create_at">Tanggal Request</label>
                  <input type="text" class="form-control" id="create_at" readonly>
                </div>
                <div class="form-group">
                  <label for="upload_startdate">Awal Bulan</label>
                  <input id="upload_startdate" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="upload_endate">Akhir Bulan</label>
                  <input type="text" class="form-control" id="upload_endate" readonly>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Chat Guest Modal -->
        <div class="modal fade" id="qnaModal" tabindex="-1" role="dialog" aria-labelledby="qnaModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="qnaModalLabel">Qna Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="produk">Produk</label>
                  <input type="text" class="form-control" id="produk" readonly>
                </div>
                <div class="form-group">
                  <label for="produk">Tanggal Pertanyaan</label>
                  <input type="text" class="form-control" id="date" readonly>
                </div>
                <div class="form-group">
                  <label for="quest">Pertanyaan</label>
                  <textarea id="quest" class="form-control" readonly></textarea>
                </div>
                <div class="form-group">
                  <label for="dateanswer">Tanggal Dijawab</label>
                  <input type="text" class="form-control" id="dateanswer" readonly>
                </div>
                <div class="form-group">
                  <label for="answer_name">Dijawab Oleh</label>
                  <input type="text" class="form-control" id="answer_name" readonly>
                </div>
                <div class="form-group">
                  <label for="answer">Jawaban</label>
                  <textarea id="answer" class="form-control" readonly></textarea>
                </div>
                <div class="form-group">
                  <label for="link">Link Unduh</label>
                  <input type="text" class="form-control" id="link" readonly>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="" id="link_btn" class="btn btn-primary" download>Download File</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Request Guest Modal -->
        <div class="modal fade" id="reqModal" tabindex="-1" role="dialog" aria-labelledby="reqModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reqModalLabel">Request Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="req_title">Judul Request</label>
                  <input type="text" class="form-control" id="req_title" readonly>
                </div>
                <div class="form-group">
                  <label for="date">Tanggal Request</label>
                  <input type="text" class="form-control" id="date" readonly>
                </div>
                <div class="form-group">
                  <label for="startdate">Awal Bulan</label>
                  <input id="startdate" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="endate">Akhir Bulan</label>
                  <input type="text" class="form-control" id="endate" readonly>
                </div>
                <div class="form-group">
                  <label for="answer_name">Nama Responder</label>
                  <input type="text" class="form-control" id="answer_name" readonly>
                </div>
                <div class="form-group">
                  <label for="date">Tanggal Respon</label>
                  <input type="text" class="form-control" id="date" readonly>
                </div>
                <div class="form-group">
                  <label for="note">Catatan Request</label>
                  <textarea id="note" class="form-control" readonly></textarea>
                </div>
                <div class="form-group">
                  <label for="req_link">Link Unduh</label>
                  <input type="text" class="form-control" id="req_link" readonly>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="" id="req_link_btn" class="btn btn-primary" download>Download File</a>
              </div>
            </div>
          </div>
        </div>