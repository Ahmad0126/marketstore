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
$('#profilModl').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget);
    var modal = $(this);
    var row = '';
    console.log(button.data('url'));
    if(button.data('url') != base_url+'assets/upload/profil/'){
		row = '<div class="modal-content">'+
            '<div class="modal-header">'+ 
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
            '</div>'+
            '<div class="modal-body">'+ 
                '<img class="img-fluid" alt="Profil" src="'+button.data('url')+'">'+
            '</div>'+
        '</div>';
    }else{
		row = '<div class="modal-content">'+
			'<div class="modal-header">'+ 
				'<h5 class="modal-title" id="exampleModalLabel">Tidak ada profil</h5>'+
				'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
				'</button>'+
			'</div>'+
		'</div>';
    } 
    modal.find('#fotopp').html(row);
});