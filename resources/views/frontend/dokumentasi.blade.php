@extends('layouts.app')
@section('title', 'Dokumentasi')
@section('content')
    <section class="blog grid section" id="blog" style="padding-top: 0px;">
        <div class="breadcrumbs overlay"
            style="background-image: url('https://fastly.picsum.photos/id/190/1600/330.jpg?hmac=-GhevoFoOoiC969cghjv_JCXSbTo3FO96l7jfuPjmwI');">
            <div class="container">
                <div class="bread-inner">
                    <div class="row">
                        <div class="col-12">
                            <h2>Dokumentasi</h2>
                            <ul class="bread-list">
                                <li><a href="{{ route('welcome') }}">Home</a></li>
                                <li><i class="icofont-simple-right"></i></li>
                                <li class="active">Dokumentasi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Dokumentasi</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (count($dokumentasis) > 0)
                    @foreach ($dokumentasis as $dokumentasi)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-news">
                                <div class="news-head lightbox">
                                    <img src="{{ asset('storage/dokumentasi/' . $dokumentasi->foto_dokumentasi) }}"
                                        alt="{{ $dokumentasi->nama_dokumentasi }}"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                                <div class="news-body">
                                    <div class="news-content">
                                        <h2>{{ $dokumentasi->nama_dokumentasi }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 d-flex justify-content-center">
                        <div class="pagination">
                            {!! $dokumentasis->links() !!}
                        </div>
                    </div>
                @else
                    <div class="col-12 d-flex justify-content-center">
                        <p>Saat ini belum ada dokumentasi</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/lightbox/lightbox.css') }}">
    <script defer="" src="{{ asset('vendor/lightbox/lightbox.js') }}"></script>
@endpush
