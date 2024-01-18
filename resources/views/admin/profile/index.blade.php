@extends('adminlte::page')

@section('title', 'Dashboard - Profile')

@section('content_header')
    <h1>Data User</h1>
@stop

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr align="center">

                                        <th>Nama User</th>
                                        <th>Username</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $m)
                                        @if (Auth::user()->name == $m->name)
                                            <tr align="center">
                                                <td>{{ $m->name }}</td>
                                                <td>{{ $m->username }}</td>
                                                <td><a href="{{ route('editprofile', $m->id) }}" class="btn btn-primary"><i
                                                            class="fas fa-edit"></i></a></td>
                                            </tr>
                                        @else
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
