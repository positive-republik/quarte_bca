      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white shadow">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Quartee 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/vendor/sb-admin/') ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/vendor/sb-admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/vendor/sb-admin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/vendor/sb-admin/') ?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/vendor/sb-admin/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/vendor/sb-admin/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/vendor/sb-admin/') ?>js/demo/datatables-demo.js"></script>

  <?php if ( isset($ajax) ) : ?>
  <!-- Ajax -->
  <script src="<?= base_url('assets/js/' . $ajax . '.js'); ?>"></script>
  <?php endif; ?>
  
  <!-- Uploader Page Script -->
  <script>
      // Add img js
      $(function() {
        $(document).on('change', ':file', function() {
        var input = $(this),
          numFiles = input.get(0).files ? input.get(0).files.length : 1,
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
        });
        $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;
            if( input.length ) {
              input.val(log);
            } else {
              if( log ) alert(log);
            }
          });
        });
      });
      
      // Dynamic form
      $(document).ready(function() {
        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });
        $("body").on("click",".remove",function(){ 
            $(this).parents(".control-group").remove();
        });
      });
  </script>
</body>

</html>