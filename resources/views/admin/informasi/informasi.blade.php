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
                <a href="" title="tambahInformasi"><button type="button" style="float: right;" class="btn btn-primary round btn-sm"><i class="fa fa-solid fa-plus"></i> Tambah</button></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover text-nowrap" id="informasiTable" width="100%">
                        <thead>
                        <tr>
                            <th>NO</th>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
    $(document).ready(function() { 
    //datatable
        $('#informasiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('indexinformasi') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action'},
            ]
        });
    });
    </script>
@stop