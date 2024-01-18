@extends('layouts.app')

@section('content')

<section class="blog grid section" id="blog" style="padding-top: 0px;">
    <div class="breadcrumbs overlay"  style="background-image: url('https://fastly.picsum.photos/id/190/1600/330.jpg?hmac=-GhevoFoOoiC969cghjv_JCXSbTo3FO96l7jfuPjmwI');">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Blog Single</h2>
                        <ul class="bread-list">
                        <li><a href="index.html">Home</a></li>
                        <li><i class="icofont-simple-right"></i></li>
                        <li class="active">Informasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    <div class="container">
            
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Dokumentasi</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-news">
                    <div class="news-head lightbox">
                        <img src="#" alt="#" style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <h2>tes</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="pagination">
                    {{-- {!! $dokumentasis->links() !!} --}}
                </div>
            </div>
            {{-- @else
            <div class="col-12 d-flex justify-content-center">
                <p>Saat ini belum ada dokumentasi</p>
            </div>
            @endif --}}
        </div>
    </div>
</section>

<style scoped>
     .breadcrumbs.overlay {
        background-size: cover; /* Adjust as needed */
        background-position: center center; /* Adjust as needed */
        background-repeat: no-repeat; /* Adjust as needed */
    }
</style>

@endsection
