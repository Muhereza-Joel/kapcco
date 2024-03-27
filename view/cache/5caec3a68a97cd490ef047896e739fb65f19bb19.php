<!-- Vendor JS Files -->
<script src="/<?php echo e($appName); ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/chart.js/chart.umd.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/echarts/echarts.min.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/quill/quill.min.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/<?php echo e($appName); ?>/assets/js/jquery.min.js"></script>
<script src="/<?php echo e($appName); ?>/assets/js/moments.js"></script>
<script src="/<?php echo e($appName); ?>/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="/<?php echo e($appName); ?>/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/js/shepherd.min.js"></script>

<script>
  function showLoadingOverlay() {
    $('#loading-overlay').fadeIn();
  }

  // Hide loading overlay
  function hideLoadingOverlay() {
    $('#loading-overlay').fadeOut();
  }

  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

  // Function to get the value of a cookie by name
  function getCookie(name) {
    var nameEQ = name + "=";
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i];
      while (cookie.charAt(0) == ' ') {
        cookie = cookie.substring(1, cookie.length);
      }
      if (cookie.indexOf(nameEQ) == 0) {
        return cookie.substring(nameEQ.length, cookie.length);
      }
    }
    return null;
  }
</script>

</body>

</html>