@extends('layouts.app')
@section('content')


<!-- Start Blog Area -->
<section class="blog grid section" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Dokumentasi</h2>
                    <img src="assets/img/section-img.png" alt="#">
                    <p>Semua kegiatan yang dilakukan oleh tim kami akan di dokumentasikan disini.</p>
                </div>
            </div>
        </div>
        <div class="row">

            @php
                $total =12;
            @endphp

            @for ($i = 0; $i < $total; $i++)
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Blog -->
                <div class="single-news">
                    <div class="news-head lightbox">
                        <img src="https://via.placeholder.com/560x370" alt="asdasd">
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <h2><a href="blog-single.html">We have annnocuced our new product.</a></h2>
                        </div>
                    </div>
                </div>
            </div>
            @endfor

            <div class="col-12 d-flex justify-content-center">
                <div class="pagination">
                    <ul class="pagination-list">
                        <li><a href="#"><i class="icofont-rounded-left"></i></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('styles')
<link rel="stylesheet" href="vendor/lightbox/lightbox.css">
<script src="vendor/lightbox/lightbox.js"></script>
@endpush