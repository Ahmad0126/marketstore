let table = new DataTable('#barang',{
    dom: 'tp'
});
var poin = 0;
var voucher = 0;
$('#carian').keyup(function(){
    table.search($(this).val()).draw();
});
$('.add_barang').on('click', function(){
    $('#cari').val($(this).data('nama'));
});
function updateTable(data) {
    tableBody = $("#detail tbody");
    if(tableBody.find('#'+data.id_barang).attr('id') != data.id_barang){
        row = '<tr id="'+data.id_barang+'">'+
            '<td>'
                +data.nama+
                '<input type="hidden" name="kode_barang[]" value="'+data.kode_barang+'">'+
                '<input type="hidden" name="harga[]" value="'+data.harga_jual+'"</td>'+
                '<input type="hidden" name="jumlah[]" value="'+data.jumlah+'"</td>'+
            '<td>'+data.kode_barang+'</td>'+
            '<td>Rp '+data.harga_jual.toLocaleString()+'</td>'+
            '<td>'+data.jumlah.toLocaleString()+'</td>'+
            '<td class="total1">Rp '+(parseInt(data.harga_jual) * parseInt(data.jumlah))+'</td>'+
            '<td>'+
                '<button type="button" class="close del-barang" data-del="'+data.id_barang+'">'+
                    '<span>×</span>'+
                '</button>'+
            '</td>'+
        '</tr>';
        tableBody.append(row);
    }else{
        row = '<td>'
                +data.nama+
                '<input type="hidden" name="kode_barang[]" value="'+data.kode_barang+'">'+
                '<input type="hidden" name="harga[]" value="'+data.harga_jual+'"</td>'+
                '<input type="hidden" name="jumlah[]" value="'+data.jumlah+'"</td>'+
            '<td>'+data.kode_barang+'</td>'+
            '<td>Rp '+data.harga_jual.toLocaleString()+'</td>'+
            '<td>'+data.jumlah.toLocaleString()+'</td>'+
            '<td class="total1">Rp '+(parseInt(data.harga_jual) * parseInt(data.jumlah))+'</td>'+
            '<td>'+
                '<button type="button" class="close del-barang" data-del="'+data.id_barang+'">'+
                    '<span>×</span>'+
                '</button>'+
            '</td>';
        $('#'+data.id_barang).html(row);
    }
    jumlahkan();
};
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
$('#detail').delegate('.del-barang', 'click', function(){
    $('#'+$(this).data('del')).remove();
    jumlahkan();
});
$('#poin').on('keyup', function(){
    poin = parseInt($(this).val());
    jumlahkan();
});
function jumlahkan(){
    var h_total = $('.total1');
    var all_total = 0;
    for (var i = 0; i < h_total.length; i++){
        all_total += parseInt(($(h_total[i]).html().substr(3)));
    }
    var diskon = poin + voucher;
    $('#total').html('Rp '+all_total.toLocaleString());
    $('#diskon').html('Rp '+diskon.toLocaleString());
    $('#total_bayar').html('Rp '+(all_total - diskon).toLocaleString());
}
(function($) {
    'use strict';
    function substringMatcher(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;
    
            // an array that will be populated with substring matches
            matches = [];
    
            // regex used to determine if a string contains the substring `q`
            var substrRegex = new RegExp(q, 'i');
    
            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            for (var i = 0; i < strs.length; i++) {
                if (substrRegex.test(strs[i])) {
                    matches.push(strs[i]);
                }
            }
    
            cb(matches);
        };
    };
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: base_url+'barang/get_barang',
    }).done(function(data){
        var barang = data;
        $('#cari').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'barang',
            source: substringMatcher(barang)
        });
    });
})(jQuery);
$('#add_barang').on('click', function(){
    var name = $('#cari');
    var jumlah = $('#Jumlah');
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: base_url+'barang/lihat_barang',
        data: {nama: name.val(), jumlah: jumlah.val()},
        success: function(data){
            if(data.status == null){
                updateTable(data);
                name.val('');
                jumlah.val('');
            }else{
                $('#vouchermodal').modal('hide');
                $('#kode_voucher').val("");
                $('#pesan').html(data.status);
                $('#color').addClass('alert-danger');
                $('#alertmodal').modal('show');
            }
        },
        error: function(){
            $('#vouchermodal').modal('hide');
            $('#kode_voucher').val("");
            $('#pesan').html('Maaf, server sedang bermasalah');
            $('#color').addClass('alert-danger');
            $('#alertmodal').modal('show');
        }
    });
});