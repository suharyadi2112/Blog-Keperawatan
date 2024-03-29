@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
    <section class="slider">
        <div class="hero-slider">
            <div class="single-slider" style="background-image:url('assets/img/rsup.png')">
            </div>
            <div class="single-slider" style="background-image:url('assets/img/rsup.png')">
            </div>
        </div>
    </section>
    <section class="schedule">
        <div class="container">
            <div class="schedule-inner">
                <div class="row">
                    <div class="col-12">
                        <div class="single-schedule first">
                            <div class="inner">
                                <div class="icon">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                                <div class="single-content">

                                    <p>RS pusat rujukan utama di Kepulauan Riau, diharapkan dapat memberikan pelayanan
                                        kesehatan yang berkualitas didukung dengan pelayanan yang modern dari sisi sarana
                                        prasarana, prosedur pelayanan, ketersediaan tenaga.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog section" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Informasi</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($informasi as $informasi)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Blog -->
                            <div class="single-news">
                                <div class="news-head">
                                        <img src="{{ asset('storage/thumbnail/' . $informasi->thumbnail) }}" alt="#" style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                                <div class="news-body">
                                    <div class="news-content">
                                        <div class="date">
                                            {{ \Carbon\Carbon::parse($informasi->created_at)->format('d M Y') }}</div>
                                        <h2><a href="{{ Route("informasiDetail", ['id' => $informasi->id]) }}" target="_blank">{!! $informasi->judul_informasi !!}</a></h2>
                                        <p class="text">{!! substr(strip_tags($informasi->isi_informasi), 0, 300) !!}...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </section>
    <section>
        @include('frontend.dokumen-section')
    </section>
@endsection

@push('styles')
<style>
    .slider .single-slider:before{
        background:transparent;
    }
</style>
@endpush
