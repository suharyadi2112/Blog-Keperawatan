@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Informasi</h3>
                <a title="tambahInformasi">
                    <button type="button" style="float: right;" class="btn btn-primary round btn-sm showAddInfo"><i class="fa fa-solid fa-plus"></i> Tambah</button>
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover text-nowrap" id="informasiTable" width="100%">
                        <thead>
                        <tr>
                            <th>Judul Informasi</th>
                            <th>Isi Informasi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="modal fade" id="modal-informasi-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Informasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputBorderWidth2">Judul Informasi</label>
                <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Masukan judul informasi">
            </div>

            <div class="form-group">
                <label for="exampleInputBorderWidth2">Isi Informasi</label>
                <textarea id="summernote">
                    Place <em>some</em> <u>text</u> <strong>here</strong>
                </textarea>
                <div class="card-footer">
                Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
    $(document).ready(function() { 
        $('#informasiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('indexinformasi') }}",
            columns: [
                {data: 'judul_informasi', name: 'judul_informasi'},
                {data: 'isi_informasi', name: 'isi_informasi'},
                {data: 'action', name: 'action'},
            ]
        });


        
        $(document).on("click", ".showAddInfo", function () {
            $("#modal-informasi-add").modal("show");

            //summernote
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });  
        });

    });
    </script>
@stop