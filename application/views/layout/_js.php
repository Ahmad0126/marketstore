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
	var poin = 0;
	var voucher = 0;
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
				row = '<tr id="'+button.data('kode')+'">'+
					'<td>'
						+button.data('nama')+
						'<input type="hidden" name="kode_barang[]" value="'+button.data('kode')+'">'+
						'<input type="hidden" name="harga[]" value="'+button.data('harga')+'"</td>'+
					'<td>'+button.data('kode')+'</td>'+
					'<td>Rp '+button.data('harga').toLocaleString()+'</td>'+
					'<td><input type="number" name="jumlah[]" max="'+button.data('stok')+'" data-harga="'+button.data('harga')+'" data-kode="'+button.data('kode')+'" class="form-control form-control-sm jumlah"></td>'+
					'<td class="total1" id="total_'+button.data('kode')+'"></td>'+
				'</tr>';
				tableBody.append(row);
				button.html('-');
			}else{
				button.html('+');
				$('#'+button.data('kode')).remove();
			}
			jumlahkan();
		}); 
	}); 
	$('#vchbtn').on('click', function(){
		var code = $('#kode_voucher').val();
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '<?= base_url("voucher/cek_voucher") ?>',
			data: {kode_voucher: code},
			success: function(data){
				if(data.status == null){
					$('#vouchermodal').modal('hide');
					$('#kode_voucher').val("");
					$('#id_vch').val(data.id_voucher);
					$('#nomi_vch').val(data.potongan);
					$('#color').addClass('alert-success');
					$('#pesan').html('Voucher diterapkan. Diskon sebanyak Rp '+data.potongan.toLocaleString());
					$('#alertmodal').modal('show');
					voucher = parseInt(data.potongan);
					jumlahkan();
				}else{
					$('#vouchermodal').modal('hide');
					$('#kode_voucher').val("");
					$('#pesan').html(data.status);
					$('#color').addClass('alert-danger');
					$('#alertmodal').modal('show');
				}
			}
		});
	});
	$('#detail').delegate('input', 'keyup', function(){
		var harga = $(this).data('harga');
		var jumlah = $(this).val();
		var total = parseInt(harga) * parseInt(jumlah);
		$('#total_'+$(this).data('kode')).html('Rp '+total);
		jumlahkan();
	});
	$('#poin').on('keyup', function(){
		poin = parseInt($(this).val());
		jumlahkan();
	});
	function jumlahkan(){
		var h_total = document.querySelectorAll('.total1');
		var all_total = 0;
		for (var i = 0; i < h_total.length; i++){
			all_total += parseInt(($(h_total[i]).html().substr(3)));
		}
		var diskon = poin + voucher;
		$('#total').html('Rp '+all_total.toLocaleString());
		$('#diskon').html('Rp '+diskon.toLocaleString());
		$('#total_bayar').html('Rp '+(all_total - diskon).toLocaleString());
	}
	$('#pelanggan').on('click', function(){
		var id = $(this).val();
		$('#memberbtn').attr('href', '<?= base_url('penjualan/member/') ?>'+id);
	});
    $('#edituser').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#Nama').val(button.data('nama'));
		modal.find('#Username').val(button.data('username'));
		modal.find('#level').val(button.data('level'));
		modal.find('#id_user').val(button.data('id_user'));
	});
    $('#resetuser').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#id_user').val(button.data('id_user'));
		modal.find('#konf_pass').val('');
	});
    $('#editsupplier').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#Nama').val(button.data('nama'));
		modal.find('#Kode').val(button.data('kode'));
		modal.find('#Telepon').val(button.data('telp'));
		modal.find('#id_supplier').val(button.data('id_supplier'));
	});
    $('#editvch').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#Potongan').val(button.data('potongan'));
		modal.find('#Kode').val(button.data('kode'));
		modal.find('#expired').val(button.data('expired'));
		modal.find('#id_voucher').val(button.data('id'));
	});
    $('#editpelanggan').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#Nama').val(button.data('nama'));
		modal.find('#Alamat').val(button.data('alamat'));
		modal.find('#Telepon').val(button.data('telp'));
		modal.find('#id_pelanggan').val(button.data('id_pelanggan'));
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