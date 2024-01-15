@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

<section class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Informasi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-hover text-nowrap" id="informasiTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
      
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

    <script>

    $(function () {  
    //datatable
        var table = $('#informasiTable').DataTable({
            processing: true,
            serverSide: true,
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