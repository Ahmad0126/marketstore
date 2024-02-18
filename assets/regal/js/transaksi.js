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
    $('#addmodal').modal('show');
});
$('#toJumlah').on('keyup', function(){
    $('#Jumlah').val($(this).val());
});
function updateTable(data, beli) {
    if(beli){
        var harga = data.harga_beli;
    }else{
        var harga = data.harga_jual;
    }
    tableBody = $("#detail tbody");
    if(tableBody.find('#'+data.id_barang).attr('id') != data.id_barang){
        row = '<tr id="'+data.id_barang+'">'+
            '<td>'
                +data.nama+
                '<input type="hidden" name="kode_barang[]" value="'+data.kode_barang+'">'+
                '<input type="hidden" name="harga[]" value="'+harga+'"</td>'+
                '<input type="hidden" name="jumlah[]" value="'+data.jumlah+'"</td>'+
            '<td>'+data.kode_barang+'</td>'+
            '<td>Rp '+harga.toLocaleString()+'</td>'+
            '<td>'+data.jumlah.toLocaleString()+'</td>'+
            '<td class="total1">Rp '+(parseInt(harga) * parseInt(data.jumlah))+'</td>'+
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
                '<input type="hidden" name="harga[]" value="'+harga+'"</td>'+
                '<input type="hidden" name="jumlah[]" value="'+data.jumlah+'"</td>'+
            '<td>'+data.kode_barang+'</td>'+
            '<td>Rp '+harga.toLocaleString()+'</td>'+
            '<td>'+data.jumlah.toLocaleString()+'</td>'+
            '<td class="total1">Rp '+(parseInt(harga) * parseInt(data.jumlah))+'</td>'+
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
        url: base_url+'auth/cek_voucher',
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
$('#poin').on('click', function(){
    $('#poinmodal').modal('hide');
    var name = $(this).data('pelanggan');
    var jumlah = $('#jumlah_poin');
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: base_url+'auth/cek_poin',
        data: {nama: name, jumlah: jumlah.val()},
        success: function(data){
            if(data.status == null){
                poin = parseInt(data.jumlah);
                jumlah.val('');
                jumlahkan();
            }else{
                $('#pesan').html(data.status);
                $('#color').addClass('alert-danger');
                $('#alertmodal').modal('show');
            }
        },
        error: function(){
            $('#pesan').html('Maaf, server sedang bermasalah');
            $('#color').addClass('alert-danger');
            $('#alertmodal').modal('show');
        }
    });
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
            matches = [];
            var substrRegex = new RegExp(q, 'i');
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
        url: base_url+'auth/get_barang',
    }).done(function(data){
        $('#cari').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'barang',
            source: substringMatcher(data)
        });
    });
})(jQuery);
$('.addBarang').on('click', function(){
    $('#addmodal').modal('hide');
    var name = $('#cari');
    var jumlah = $('#Jumlah');
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: base_url+'auth/lihat_barang',
        data: {nama: name.val(), jumlah: jumlah.val()},
        success: function(data){
            if(data.status == null){
                updateTable(data, false);
                name.val('');
                jumlah.val('');
                $('#toJumlah').val("");
            }else{
                $('#pesan').html(data.status);
                $('#color').addClass('alert-danger');
                $('#alertmodal').modal('show');
            }
        },
        error: function(){
            $('#pesan').html('Maaf, server sedang bermasalah');
            $('#color').addClass('alert-danger');
            $('#alertmodal').modal('show');
        }
    });
});
$('.beliBarang').on('click', function(){
    $('#addmodal').modal('hide');
    var name = $('#cari');
    var jumlah = $('#Jumlah');
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: base_url+'auth/ambil_barang',
        data: {nama: name.val(), jumlah: jumlah.val()},
        success: function(data){
            if(data.status == null){
                updateTable(data, true);
                name.val('');
                jumlah.val('');
                $('#toJumlah').val('');
            }else{
                $('#pesan').html(data.status);
                $('#color').addClass('alert-danger');
                $('#alertmodal').modal('show');
            }
        },
        error: function(){
            $('#pesan').html('Maaf, server sedang bermasalah');
            $('#color').addClass('alert-danger');
            $('#alertmodal').modal('show');
        }
    });
});