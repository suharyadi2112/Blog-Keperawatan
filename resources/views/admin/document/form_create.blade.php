@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dokumen</h1>
@stop

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Dokumen</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Dokumen</label>
                                <input type="text" id="" name="namaDokumen" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea id="" name="deskripsi" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                {{-- <label for="formFile">Upload</label> --}}
                                <input class=" " type="file" id="formFile">
                            </div>

                            <div class="form-group mt-4 float-right">
                                <a href="{{ route('dokumen.index') }}" class="btn  btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
