<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  let success = $('.success').data('flash');
  let error = $('.error').data('flash');
  if (success) {
    Swal.fire({
      title: 'Success!',
      text: success,
      icon: 'success',
      showConfirmButton: false,
      timer: 2500
    })
  } else if (error) {
    Swal.fire({
      title: 'Error!',
      text: error,
      icon: 'error',
      showConfirmButton: false,
      timer: 2500
    })
  }
</script>

</body>

</html>