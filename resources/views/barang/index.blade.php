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
                    <h1 class="m-0 text-dark"> Barang</h1>
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
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
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
                                    <label for="exampleInputEmail1">Kode Barang</label>
                                    <input type="text" name="kode" class="form-control" id="input_kode">
                                    <span id="error_kode" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama" id="input_nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Beli</label>
                                    <input type="text" class="form-control" name="hargabeli" id="input_hargabeli">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Jual</label>
                                    <input type="text" class="form-control" name="hargajual" id="input_hargajual">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Hitung Stok</label>
                                    <select name="opsistok" id="input_opsistok" class="form-control">
                                        <option value="hitung">Ya, hitung</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div> -->
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
                                    <label for="exampleInputEmail1">Kode Barang</label>
                                    <input type="text" name="kode" class="form-control" id="edit_kode">
                                    <span id="error_editkode" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama" id="edit_nama">
                                    <input type="hidden" id="edit_kodebarang">
                                    <input type="hidden" id="edit_kodelama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Beli</label>
                                    <input type="text" class="form-control" name="hargabeli" id="edit_hargabeli">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Jual</label>
                                    <input type="text" class="form-control" name="hargajual" id="edit_hargajual">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Hitung Stok</label>
                                    <select name="opsistok" id="edit_opsistok" class="form-control">
                                        <option value="hitung">Ya, hitung</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div> -->
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
<div class="modal fade" id="modal-minstok" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kurangi Stok</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" id="form-kurangistok">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Barang</label>
                        <input type="text" class="form-control" name="barang" id="ks_barang" readonly>
                        <input type="hidden" name="id" id="ks_id">
                        <input type="hidden" name="status_stok" id="ks_status_stok">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="text" class="form-control" name="stok" id="ks_stok" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" id="ks_jumlah">
                        <span class="text-danger" id="error_ks_jumlah"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea name="keterangan" id="ks_keterangan" class="form-control"></textarea>
                        <span class="text-danger" id="error_ks_keterangan"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_kurangistok" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-addstok" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Stok</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" id="form-tambahstok">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Barang</label>
                        <input type="text" class="form-control" name="barang" id="ts_barang" readonly>
                        <input type="hidden" name="id" id="ts_id">
                        <input type="hidden" name="status_stok" id="ts_status_stok">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="text" class="form-control" name="stok" id="ts_stok" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" id="ts_jumlah">
                        <span class="text-danger" id="error_ts_jumlah"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea name="keterangan" id="ks_keterangan" class="form-control"></textarea>
                        <span class="text-danger" id="error_ts_keterangan"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_tambahstok" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
<script src="{{asset('customjs/barang.js')}}"></script>
@endsection