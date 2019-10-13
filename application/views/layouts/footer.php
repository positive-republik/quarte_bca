      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer shadow mt-5">
        <div class="container my-auto">
          <div class="copyright text-center my-auto text-white">
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
      <script src="<?= base_url('assets/vendor/sb-admin/') ?>vendor/chart.js/Chart.min.js"></script>

      <!-- Page level custom scripts -->
      <script src="<?= base_url('assets/vendor/sb-admin/') ?>js/demo/datatables-demo.js"></script>
      <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet" />
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

      <?php if (isset($ajax)) : ?>
        <!-- Ajax -->
        <script src="<?= base_url('assets/js/' . $ajax . '.js'); ?>"></script>
      <?php endif; ?>

      <script src="<?= base_url('assets/js/navbar.js'); ?>"></script>

      <!-- Uploader Page Script -->
      <script>
        $("select.kategori").change(function() {

          var produk = $(this).children("option:selected").val();
          $("a.show-kat").attr("href", "?produk=" + produk);
          $("kategori select").val(produk);
        });
        // Datepicker
        $('#awalBulan').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'yyyy-mm-dd',
          minViewMode: "months"
        });
        $('#akhirBulan').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'yyyy-mm-dd'
        })
        $('#awalBulan2').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'yyyy-mm-dd',
          minViewMode: "months"
        });
        $('#akhirBulan2').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'yyyy-mm-dd'
        })
        $('#awalBulan3').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'M-yyyy',
          minViewMode: "months"
        });
        $('#akhirBulan3').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'M-yyyy',
          minViewMode: "months"
        })
        $('#awalBulan4').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'M-yyyy',
          minViewMode: "months"
        });
        $('#akhirBulan4').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'M-yyyy',
          minViewMode: "months"
        })
        // Add img js
        $(function() {
          $(document).on('change', ':file', function() {
            var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
          });
          $(document).ready(function() {
            $(':file').on('fileselect', function(event, numFiles, label) {
              var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
              if (input.length) {
                input.val(log);
              } else {
                if (log) alert(log);
              }
            });
          });
        });

        // Dynamic form
        $(document).ready(function() {
          $(".add-more").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
          });
          $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
          });
        });
      </script>

      <?php if (isset($chartReq)) : ?>
        <!-- Run report chart setting -->
        <script>
          // Set new default font family and font color to mimic Bootstrap's default styling
          Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
          Chart.defaults.global.defaultFontColor = '#858796';

          function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
              prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
              sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
              dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
              s = '',
              toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
              };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
              s[1] = s[1] || '';
              s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
          }

          var ctx = document.getElementById("myAreaChart");

          // Bar Chart Example
          var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
              datasets: [{
                label: "Total",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: [<?= $chartVal[1]; ?>, <?= $chartVal[2]; ?>, <?= $chartVal[3]; ?>, <?= $chartVal[4]; ?>, <?= $chartVal[5]; ?>, <?= $chartVal[6]; ?>, <?= $chartVal[7]; ?>, <?= $chartVal[8]; ?>, <?= $chartVal[9]; ?>, <?= $chartVal[10]; ?>, <?= $chartVal[11]; ?>, <?= $chartVal[12]; ?>],
              }],
            },
            options: {
              maintainAspectRatio: false,
              layout: {
                padding: {
                  left: 10,
                  right: 25,
                  top: 25,
                  bottom: 0
                }
              },
              scales: {
                xAxes: [{
                  time: {
                    unit: 'month'
                  },
                  gridLines: {
                    display: false,
                    drawBorder: false
                  },
                  ticks: {
                    maxTicksLimit: 12
                  },
                  maxBarThickness: 30,
                }],
                yAxes: [{
                  ticks: {
                    min: 0,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                      return number_format(value);
                    }
                  },
                  gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                  }
                }],
              },
              legend: {
                display: false
              },
              // tooltips: {
              //   titleMarginBottom: 10,
              //   titleFontColor: '#6e707e',
              //   titleFontSize: 14,
              //   backgroundColor: "rgb(255,255,255)",
              //   bodyFontColor: "#858796",
              //   borderColor: '#dddfeb',
              //   borderWidth: 1,
              //   xPadding: 15,
              //   yPadding: 15,
              //   displayColors: false,
              //   caretPadding: 10,
              //   callbacks: {
              //     label: function(tooltipItem, chart) {
              //       var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              //       return datasetLabel + ' : ' + number_format(tooltipItem.yLabel);
              //     }
              //   }
              // },
            }
          });
        </script>
      <?php endif; ?>
      </body>

      </html>