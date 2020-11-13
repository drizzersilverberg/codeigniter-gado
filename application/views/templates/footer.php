<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/sbadmin/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/sbadmin/js/sb-admin-2.min.js'); ?>"></script>

<script>
    if ($('div.modal-opener').length) {
        var modal_id = $('div.modal-opener').first().data('modal-id');
        $(modal_id).modal('show');
    } else {
        console.log('tidak ada');
    }
</script>

</body>

</html>