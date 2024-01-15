@extends('adminlte::page')

@section('title', 'Dokumentasi')

@section('content_header')
    <h1>Dokumentasi</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Dokumentasi</h3>
                  <div class="card-tools">
                      <a type="button" class="btn btn-block btn-primary" label="Open Modal" data-toggle="modal" data-target="#modalCreate">Tambah Data</a>
                  </div>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover text-nowrap" id="dokumentasiTable" style="width:100%">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Dokumentasi</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

        <div class="modal fade" id="modalCreate">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_dokumentasi">Nama Dokumentasi</label>
                        <input type="email" class="form-control" id="nama_dokumentasi" name="nama_dokumentasi" placeholder="Nama Dokumentasi">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File Dokumentasi</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@stop

@section('js')

    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

    <script>

    $(function () {
        var table = $('#dokumentasiTable').DataTable({
            processing: true,
            serverSide: true,
            columns: [
                {data: 'nama_dokumentasi', name: 'nama_dokumentasi'},
                {data: 'foto_dokumentasi', name: 'foto_dokumentasi'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ]
        });
    });
    </script>
@stop