@extends('layouts.app')
@section('content')
<section class="blog grid section" id="blog">
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
                            <img src="{{ asset('storage/dokumentasi/' . $dokumentasi->foto_dokumentasi) }}" alt="{{ $dokumentasi->nama_dokumentasi }}" style="width: 100%; height: 200px; object-fit: cover;">
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
<link rel="stylesheet" href="vendor/lightbox/lightbox.css">
<script defer="" src="vendor/lightbox/lightbox.js"></script>
@endpush