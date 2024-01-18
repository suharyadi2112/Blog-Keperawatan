@extends('adminlte::page')

@section('title', 'Dashboard - Edit Profile')

@section('content_header')
    <h1>Edit User</h1>
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
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @foreach ($user as $m)
                                <form action="{{route('updateprofile')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name">Nama User</label>
                                        <input type="text" class="form-control" value="{{$m->id}}" name="id" hidden>
                                        <input type="text" class="form-control" value="{{$m->name}}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Username</label>
                                        <input type="text" class="form-control" value="{{$m->username}}" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">New Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Save</button>
                                </form>
                            @endforeach
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