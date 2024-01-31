let table = new DataTable('#barang',{
    dom: 't'
});
var poin = 0;
var voucher = 0;
$('#carian').keyup(function(){
    table.search($(this).val()).draw();
});
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
        url: base_url+'voucher/cek_voucher',
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
        },
        error: function(data){
            $('#vouchermodal').modal('hide');
            $('#kode_voucher').val("");
            $('#pesan').html('Maaf, server sedang bermasalah');
            $('#color').addClass('alert-danger');
            $('#alertmodal').modal('show');
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