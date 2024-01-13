<!-- base:js -->
<script src="<?= base_url('assets/regal/') ?>vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?= base_url('assets/regal/') ?>js/off-canvas.js"></script>
<script src="<?= base_url('assets/regal/') ?>js/hoverable-collapse.js"></script>
<script src="<?= base_url('assets/regal/') ?>js/template.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="<?= base_url('assets/regal/') ?>vendors/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/regal/') ?>vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="<?= base_url('assets/regal/') ?>js/dashboard.js"></script>
<script>
    <?php if($this->session->flashdata('alert') != null){ ?>
    $('#alertmodal').modal("show");
	<?php } ?>
    $('#edituser').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#Nama').val(button.data('nama'));
		modal.find('#Username').val(button.data('username'));
		modal.find('#level').val(button.data('level'));
		modal.find('#id_user').val(button.data('id_user'));
	});
    $('#editsupplier').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#Nama').val(button.data('nama'));
		modal.find('#Kode').val(button.data('kode'));
		modal.find('#Telepon').val(button.data('telp'));
		modal.find('#id_supplier').val(button.data('id_supplier'));
	});
    $('#editkate').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#kategori').val(button.data('nama'));
		modal.find('#id_kategori').val(button.data('id'));
	});
</script>
<!-- End custom js for this page-->