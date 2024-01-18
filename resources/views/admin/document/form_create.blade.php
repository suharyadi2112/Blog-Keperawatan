@extends('adminlte::page')

@section('title', 'RSUD Raja Ahmad Tabib - Buat Dokumen')

@section('content_header')
    <h1>Dokumen</h1>
@stop

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('dokumen.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tambah Dokumen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="namaDokumen">Nama Dokumen</label>
                                    @error('namaDokumen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" class="form-control" id="namaDokumen" name="namaDokumen"
                                        placeholder="Nama Dokumen" value="{{ old('namaDokumen') }}">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    @error('deskripsi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"> {{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File</label>
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                name="file">
                                            <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">

                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                <a href="{{ route('dokumen.index') }}" class="btn btn-secondary float-right mr-2">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
