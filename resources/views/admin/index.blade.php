@extends('layouts.base')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Admin</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary" id="tabel-data">
                        <div class="card-header">
                            <h3 class="card-title">List Data</h3>
                            <div class="card-tools">
                                <button type="button" id="tombol_tambah" class="btn btn-sm btn-default"><i
                                        class="fas fa-plus"></i> Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="listdata" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Level</th>
                                            <th>No. Telp</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="form-input" class="card card-success" style="display:none;">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                        </div>
                        <form role="form" id="form-tambah">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="input_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" name="username" id="input_username"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Telp</label>
                                    <input type="text" class="form-control" name="notelp" id="input_notelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Level</label>
                                    <select name="level" id="input_level" class="form-control">
                                        <option value="Admin">Admin</option>
                                        <option value="Super Admin">Super Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" class="form-control" name="password" id="input_password"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="kpassword" id="input_kpassword"
                                        required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="simpan-data" class="btn btn-primary">Simpan</button>
                                <button type="reset" id="kembali-input"
                                    class="btn btn-danger float-right">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div id="form-edit" class="card card-info" style="display:none;">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        <form role="form" id="form-update">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="edit_nama" required>
                                    <input type="hidden" id="edit_kode">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" name="username" id="edit_username"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Telp</label>
                                    <input type="text" class="form-control" name="notelp" id="edit_notelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Level</label>
                                    <select name="level" id="edit_level" class="form-control">
                                        <option value="Admin">Admin</option>
                                        <option value="Super Admin">Super Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password Baru*</label>
                                    <input type="password" class="form-control" name="password" id="edit_password"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Konfirmasi Password Baru*</label>
                                    <input type="password" class="form-control" name="kpassword" id="edit_kpassword"
                                        required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="update-data" class="btn btn-primary">Update</button>
                                <button type="reset" id="kembali-edit"
                                    class="btn btn-danger float-right">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
@endsection

@section('customajax')
<script src="{{asset('customjs/admin.js')}}"></script>
@endsection