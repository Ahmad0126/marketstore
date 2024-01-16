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
	let table = new DataTable('#barang',{
		dom: 't'
	});
	$('#carian').keyup(function(){
        table.search($(this).val()).draw() ;
	})
    <?php if($this->session->flashdata('alert') != null){ ?>
    $('#alertmodal').modal("show");
	<?php } ?>
	$(document).ready(function () { 
		$(".add_barang").click(function () { 
			var button = $(this);
			tableBody = $("#detail tbody"); 
			if(tableBody.find('#'+button.data('kode')).attr('id') != button.data('kode')){
				row = '<tr id="'+button.data('kode')+'"><td>'+button.data('nama')+'<input type="hidden" name="kode_barang[]" value="'+button.data('kode')+'" class="form-control"></td><td>'+button.data('kode')+'</td><td>Rp '+button.data('harga')+'</td><td><input type="number" name="jumlah[]" id="" class="form-control"></td><td></td></tr>';
				tableBody.append(row);
				button.html('-');
			}else{
				button.html('+');
				$('#'+button.data('kode')).remove();
			}
		}); 
	}); 
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
    $('#editbarang').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#Nama').val(button.data('nama'));
		modal.find('#Kode').val(button.data('kode'));
		modal.find('#Beli').val(button.data('harga_beli'));
		modal.find('#Jual').val(button.data('harga_jual'));
		modal.find('#kategori').val(button.data('id_kategori'));
		modal.find('#id_barang').val(button.data('id_barang'));
	});
    $('#editkate').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#kategori').val(button.data('nama'));
		modal.find('#id_kategori').val(button.data('id'));
	});
</script>
<!-- End custom js for this page-->