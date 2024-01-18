@extends('adminlte::page')

@section('title', 'Dashboard - Detail Informasi')

@section('content_header')
    <h3 >Detail Isi Informasi <b>{{ $judulInfo }}</b></h3>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                {!! $detailinfo !!}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

@stop