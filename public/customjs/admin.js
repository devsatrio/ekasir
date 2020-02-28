$(function() {
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
        ajax: 'admin/getlistdata',
        columns: [
            { data: 'id', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name' },
            { data: 'level', name: 'level' },
            { data: 'notelp', name: 'notelp' },
            { render: function (data, type, row) {
                return '<button class="btn btn-success" onclick="editdata('+ row['id'] +')"><i class="fa fa-wrench"></i></button> <button class="btn btn-danger" onclick="hapusdata('+ row['id'] +')"><i class="fa fa-trash"></i></button>'
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

    //=========================================================aksi
    $("#simpan-data").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if($('#input_nama').val()=='' ||$('#input_username').val()=='' ||$('#input_notelp').val()=='' ||$('#input_password').val()=='' ||$('#input_kpassword').val()==''){
            Toast.fire({
                type: 'error',
                title: ' Oops, Data tidak boleh kosong'
              });
        }else{
            if($('#input_password').val()!=$('#input_kpassword').val()){
                Toast.fire({
                    type: 'error',
                    title: ' Oops, Konfirmasi password salah'
                  });
            }else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'admin',
                    type: 'POST',
                    data: $('#form-tambah').serialize(),
                    success: function () {
                        $('#input_nama').val('');
                        $('#input_username').val('');
                        $('#input_notelp').val('');
                        $('#input_password').val('');
                        $('#input_kpassword').val('');
                        $('#input_level').val('Admin');
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
        }
    });
    //===============================================================
    $("#update-data").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if($('#edit_kode').val()=='' ||$('#edit_nama').val()=='' ||$('#edit_username').val()=='' ||$('#edit_notelp').val()==''){
            Toast.fire({
                type: 'error',
                title: ' Oops, Data tidak boleh kosong'
              });
        }else{
            var kode = $('#edit_kode').val();
            if($('#edit_password').val()!=''){
                if($('#edit_password').val()!=$('#edit_kpassword').val()){
                    Toast.fire({
                        type: 'error',
                        title: ' Oops, Konfirmasi password salah'
                      });
                }else{
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: 'admin/'+kode,
                        type: 'PUT',
                        data: $('#form-update').serialize(),
                        success: function () {
                            $('#edit_kode').val('');
                            $('#edit_nama').val('');
                            $('#edit_username').val('');
                            $('#edit_notelp').val('');
                            $('#edit_password').val('');
                            $('#edit_kpassword').val('');
                            $('#edit_level').val('Admin');
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
            }else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'admin/'+kode,
                    type: 'PUT',
                    data: $('#form-update').serialize(),
                    success: function () {
                        $('#edit_kode').val('');
                        $('#edit_nama').val('');
                        $('#edit_username').val('');
                        $('#edit_notelp').val('');
                        $('#edit_password').val('');
                        $('#edit_kpassword').val('');
                        $('#edit_level').val('Admin');
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
        }
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
                    url: 'admin/' + id,
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
    //=============================================================
    function editdata(id) {
        caridata(id)
        $("#tabel-data").hide(700);
        $("#form-edit").show(700);
    }
    window.editdata = editdata;
    //=============================================================
    function caridata(id) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'admin/' + id,
            success: function (data) {
                $.each(data, function (key, value) {
                    $('#edit_username').val(value.username);
                    $('#edit_nama').val(value.name);
                    $('#edit_notelp').val(value.notelp);
                    $('#edit_level').val(value.level);
                    $('#edit_kode').val(value.id);
                });
            }, error: function () {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Something went wrong!'
                  });
            }
        });
    }
});