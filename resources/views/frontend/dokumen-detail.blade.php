@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $dokumen->nama }}</h2>
        <p>{{ $dokumen->deskripsi }}</p>
        <a href="{{ url('storage/' . $dokumen->file) }}" class="btn btn-primary btn-sm text-light"  target="_blank">
            <i class="fa fas fa-download mr-1"></i>
            Download</a>
    </div>
@endsection
