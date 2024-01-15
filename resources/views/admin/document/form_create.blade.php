@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dokumen</h1>
@stop

@section('content')
    <div class="form-group">
        <label for="">Nama Dokumen</label>
        <input type="text" id="" name=" " class="form-control">
    </div>
    <div class="custom-file">


        {{-- Custom file input --}}
        <input type="file" id="" name=" ">

        {{-- Custom file label --}}
        <label class="custom-file-label text-truncate" for="" {{-- @isset($legend) data-browse="{{ $legend }}" @endisset>
        {{ $placeholder }} --}}>File Dokumen</label>

    </div>
@endsection
