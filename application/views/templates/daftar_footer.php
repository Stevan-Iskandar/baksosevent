  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="<?= base_url('assets/'); ?>js/new-age.min.js"></script>
  <script src="<?= base_url('assets/'); ?>js/bootstrap-select.min.js"></script>
  <script src="<?= base_url('assets/'); ?>js/bootstrap-datepicker.js"></script>
  <script src="<?= base_url('assets/'); ?>js/custom.js"></script>

  <!-- Image input script -->
  <script>
    $(".custom-file-input").on("change", function() {
      let fileName = $(this).val().split("\\").pop();
      $(this).next(".custom-file-label").addClass("selected").html(fileName);
    });

    $('.selectpicker').selectpicker();
  </script>

  <script>
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy'
    });

    $('.carousel').carousel({
      interval: 5000
    });
  </script>

  </body>

  </html>