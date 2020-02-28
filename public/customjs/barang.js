$(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    //=========================================================tampil data
    $('#listdata').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: 'barang/getlistdata',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'kode', name: 'kode' },
            { data: 'nama', name: 'nama' },
            { data: 'harga_beli', name: 'harga_beli' },
            { data: 'harga_jual', name: 'harga_jual' },
            {
                render: function (data, type, row) {
                    return '<button class="btn btn-success" onclick="editdata(' + row['id'] + ')"><i class="fa fa-wrench"></i></button> <button class="btn btn-danger" onclick="hapusdata(' + row['id'] + ')"><i class="fa fa-trash"></i></button>'
                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            },
        ]
    });
    //=========================================================control tombol
    $("#tombol_tambah").click(function (e) {
        $("#tabel-data").hide(700);
        $("#form-input").show(700);
    });
    $("#kembali-input").click(function (e) {
        $("#tabel-data").show(700);
        $("#form-input").hide(700);
    });
    $("#kembali-edit").click(function (e) {
        $("#tabel-data").show(700);
        $("#form-edit").hide(700);
    });
    //===============================================================
    function hapusdata(id) {
        Swal.fire({
            title: 'Hapus Data ?',
            text: "Data yang dihapus tidak dapat dipulihkan kembali !",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: 'barang/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function () {
                        Swal.fire(
                            'Info',
                            'Data berhasil dihapus',
                            'success'
                        );
                        $('#listdata').DataTable().ajax.reload();
                    }, error: function () {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                });
            }
        })

    }
    window.hapusdata = hapusdata;
    //===============================================================
    function minusstok(id) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'barang/' + id,
            success: function (data) {
                $.each(data, function (key, value) {
                    $('#ks_barang').val(value.nama);
                    $('#ks_id').val(value.id);
                    $('#ks_stok').val(value.stok);
                    $('#ks_status_stok').val(value.status_stok);
                });
                $('#modal-minstok').modal('toggle');
            }, error: function () {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });
        
    }
    window.minusstok = minusstok;
    //===============================================================
    function addstok(id) {
        $('#modal-addstok').modal('toggle')
    }
    window.addstok = addstok;
    //=============================================================
    function editdata(id) {
        caridata(id);
        $("#tabel-data").hide(700);
        $("#form-edit").show(700);
    }
    window.editdata = editdata;
    //=============================================================
    function caridata(id) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'barang/' + id,
            success: function (data) {
                $.each(data, function (key, value) {
                    $('#edit_kode').val(value.kode);
                    $('#edit_kodelama').val(value.kode);
                    $('#edit_nama').val(value.nama);
                    $('#edit_hargabeli').val(value.harga_beli);
                    $('#edit_hargajual').val(value.harga_jual);
                    $('#edit_opsistok').val(value.status_stok);
                    $('#edit_kodebarang').val(value.id);
                });
            }, error: function () {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });
    }
    //===================================================================
    $("#edit_kode").keyup(function () {

        var kode = $(this).val().trim();

        if (kode != '' && kode != $('#edit_kodelama').val()) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: 'barang/carikode/' + kode,
                success: function (data) {
                    if (data > 0) {
                        $("#error_editkode").html('Kode telah dipakai,coba yang lain');
                        $("#edit_kode").val('');
                        $("#edit_kode").addClass('is-invalid');
                    } else {
                        $("#error_editkode").html('');
                        $("#edit_kode").removeClass('is-invalid');
                    }
                }, error: function () {

                    Swal.fire({
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        }

    });
    
    //===============================================================
    $('#simpan_kurangistok').click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        if($('#ks_barang').val()=='' || $('#ks_jumlah').val()=='' ||$('#ks_keterangan').val()==''){
            if($('#ks_jumlah').val()==''){
                $('#ks_jumlah').addClass('is-invalid');
                $('#error_ks_jumlah').html('Maaf, Data tidak boleh kosong');
            }
            if($('#ks_keterangan').val()==''){
                $('#ks_keterangan').addClass('is-invalid');
                $('#error_ks_keterangan').html('Maaf, Data tidak boleh kosong');
            }
        }else{
            $('#ks_jumlah').removeClass('is-invalid');
            $('#ks_keterangan').removeClass('is-invalid');
            $('#error_ks_jumlah').html('');
            $('#error_ks_keterangan').html('');
            if(parseInt($('#ks_jumlah').val()) > parseInt($('#ks_stok').val())){
                $('#ks_jumlah').addClass('is-invalid');
                $('#error_ks_jumlah').html('Maaf, Jumlah melebihi stok barang');
            }else{
                Swal.fire({
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        }
    });
    
    //===============================================================
    $("#update-data").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if ($('#edit_kode').val() == '' || $('#edit_nama').val() == '' || $('#edit_hargabeli').val() == '' || $('#edit_hargajual').val() == '') {
            Toast.fire({
                type: 'error',
                title: ' Oops, Data tidak boleh kosong'
            });
        } else {
            var kode = $('#edit_kodebarang').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'barang/' + kode,
                type: 'PUT',
                data: $('#form-update').serialize(),
                success: function () {
                    $('#edit_kode').val('');
                    $('#edit_kodelama').val('');
                    $('#edit_nama').val('');
                    $('#edit_hargabeli').val('');
                    $('#edit_hargajual').val('');
                    $('#edit_opsistok').val('hitung');
                    $('#edit_kodebarang').val('');
                    Toast.fire({
                        type: 'success',
                        title: 'Data berhasil disimpan'
                    });
                    $("#tabel-data").show(700);
                    $("#form-edit").hide(700);
                    $('#listdata').DataTable().ajax.reload();
                }, error: function () {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });

        }
    });
    //===================================================================
    $("#input_kode").keyup(function () {
        var kode = $(this).val().trim();
        if (kode != '') {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: 'barang/carikode/' + kode,
                success: function (data) {
                    if (data > 0) {
                        $("#error_kode").html('Kode telah dipakai,coba yang lain');
                        $("#input_kode").val('');
                        $("#input_kode").addClass('is-invalid');
                    } else {
                        $("#error_kode").html('');
                        $("#input_kode").removeClass('is-invalid');
                    }
                }, error: function () {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        }
    });
    //=========================================================aksi
    $("#simpan-data").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if ($('#input_kode').val() == '' || $('#input_nama').val() == '' || $('#input_hargabeli').val() == '' || $('#input_hargajual').val() == '') {
            Toast.fire({
                type: 'error',
                title: ' Oops, Data tidak boleh kosong'
            });
        } else {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'barang',
                type: 'POST',
                data: $('#form-tambah').serialize(),
                success: function () {
                    $('#input_kode').val('');
                    $('#input_nama').val('');
                    $('#input_hargabeli').val('');
                    $('#input_hargajual').val('');
                    $('#input_opsistok').val('hitung');
                    Toast.fire({
                        type: 'success',
                        title: 'Data berhasil disimpan'
                    });
                    $("#tabel-data").show(700);
                    $("#form-input").hide(700);
                    $('#listdata').DataTable().ajax.reload();
                }, error: function () {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });

        }
    });
});
