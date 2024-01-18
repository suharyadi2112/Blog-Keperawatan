@extends('adminlte::page')

@section('title', 'Dashboard - Edit Dokumen')

@section('content_header')
    <h1>Dokumen</h1>
@stop

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('dokumen.update', $dokumen->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Ubah Dokumen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Dokumen</label>
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama Dokumen" value="{{ old('nama') ? old('nama') : $dokumen->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    @error('deskripsi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"> {{ old('deskripsi') ? old('deskripsi') : $dokumen->deskripsi }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File</label>
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br /> <small class="text-primary"><i
                                            class="fas fa-file mr-1"></i>{{ str_replace('dokumen/', '', $dokumen->file) }}</small>
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

                                <button type="submit" class="btn btn-primary float-right">Ubah</button>
                                <a href="{{ route('dokumen.index') }}" class="btn btn-secondary float-right mr-2">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
