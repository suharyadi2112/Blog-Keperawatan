@extends('layouts.app')

@section('content')

<section class="news-single section" id="blog" style="padding-top: 0px;">
    <div class="breadcrumbs overlay"  style="background-image: url('https://fastly.picsum.photos/id/190/1600/330.jpg?hmac=-GhevoFoOoiC969cghjv_JCXSbTo3FO96l7jfuPjmwI');">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Detail Informasi</h2>
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

    <div class="row" style="padding-left: 40px; padding-top: 40px;">
        <div class="col-lg-8 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="single-main">
                        <div class="news-head">
                            <img src="https://dummyimage.com/640x4:3/" alt="#">
                        </div>
                        <h1 class="news-title" id="juduL"></h1>

                        <div class="meta">
                            <div class="meta-left">
                            <span class="author"><img src="https://dummyimage.com/640x4:3/" alt="#"><font id="namaUser"></font></span>
                            <span class="date"><i class="fa fa-clock-o"></i><font id="created"></font></span>
                            </div>
                            <div class="meta-right">
                            {{-- <span class="comments"><a href="#"><i class="fa fa-comments"></i>05 Comments</a></span>
                            <span class="views"><i class="fa fa-eye"></i>33K Views</span> --}}
                        </div>
                    </div>

                    <div class="news-text">
                        <div id="result"> </div>
                        <p id="isiInformasi"></p>
                    </div>

                    
                   
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12" style="padding-right: 40px;">
            <div class="main-sidebar">
                <div class="single-widget recent-post">
                <h3 class="title">Recent post</h3>
                @foreach($latestInformasi as $infolast)
                    <div class="single-post">
                        
                        <div class="image">
                        <img src="https://dummyimage.com/640x4:3/" alt="#">
                        </div>
                        <div class="content">
                        <h5>
                            <a href="#">{{ $infolast->judul_informasi }}</a>
                        </h5>
                        <ul class="comment">
                            <li>
                            <i class="fa fa-calendar" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($infolast->created_at)->format('d M Y') }}
                            </li>
                        </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            <div class="single-widget category">
                <h3 class="title">File Available</h3>
                <ul class="categor-list">
                    @php $i=1; @endphp
                    @foreach($informasi as $info)
                        @foreach($info->dokumen as $dokumen)
                            <li>
                                <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank"><strong> File Dokumen {{ $i }}</strong></a>
                            </li>
                            @php $i++ @endphp
                        @endforeach
                    @endforeach
                </ul>
            </div>
            </div>
        </div>
    </div>
        
</section>


<section class="portfolio section">
    <div class="container">
    <div class="row">
    <div class="col-lg-12">
    <div class="section-title">
    <h2>Dokumentasi</h2>
    <p>Dokumentasi terkait informasi</p>
    </div>
    </div>
    </div>
    </div>
    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-12 col-12">
    <div class="owl-carousel portfolio-slider">
        @foreach($informasi as $info)
            @foreach($info->dokumentasis as $dokumentasi)
                <div class="single-pf">
                    <img src="{{ asset('storage/dokumentasi/' . $dokumentasi->foto_dokumentasi) }}" alt="#" style="width: 100%; height: 200px; object-fit: cover;">
                    <a href="{{ Route("frontend.dokumentasi") }}" class="btn">View Details</a>
                </div>
            @endforeach
        @endforeach
    </div>
    </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
        fetchData();
    });

    function fetchData() {
        $.ajax({
            url: "{{ Route('informasiDetail', ['id' => $idInfo]) }}",
            method: 'GET',
            dataType: 'json', 
            success: function(data) {
                displayData(data);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function displayData(data) {
        var judul = $('#juduL');
        var namaUser = $('#namaUser');
        var created = $('#created');
        var isiInformasi = $('#isiInformasi');
        
        judul.empty(); 
        namaUser.empty(); 
        created.empty(); 
        isiInformasi.empty(); 
        
        for (var i = 0; i < data.length; i++) {
            judul.append(data[i].judul_informasi);
            namaUser.append(data[i].user.name);
            created.append(ChangeDate(data[i].created_at));   
            isiInformasi.append(data[i].isi_informasi); 

        
        }
    }

    function ChangeDate (tanggalAwal){
        var tanggalObjek = new Date(tanggalAwal);
        var tanggalAkhir = tanggalObjek.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
        return tanggalAkhir;
    }
    
</script>

@endsection
