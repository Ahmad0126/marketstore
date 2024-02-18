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
<script src="<?= base_url('assets/regal/') ?>vendors/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/regal/') ?>vendors/datatables/dataTables.bootstrap4.min.js"></script>
<script>
	var base_url = "<?= base_url() ?>"
    <?php if($this->session->flashdata('alert') != null){ ?>
    $('#alertmodal').modal("show");
	<?php } ?>
	let genTable = new DataTable('#tabel',{
		dom: 'ltip'
	});
	$('#genSearch').keyup(function(){
		genTable.search($(this).val()).draw();
	});
	$('#memberbtn').attr('href', base_url + 'penjualan/member/' + $('#pelanggan').val());
	$('#pelanggan').on('click', function(){
		var id = $(this).val();
		$('#memberbtn').attr('href', base_url+'penjualan/member/'+id);
	});
</script>
<script src="<?= base_url('assets/regal/') ?>js/modal_edit.js"></script>
<!-- End custom js for this page-->