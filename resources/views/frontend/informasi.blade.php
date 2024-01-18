@extends('layouts.app')
@section('title', 'Informasi')
@section('content')

<section class="blog grid section" id="blog" style="padding-top: 0px;">
    <div class="breadcrumbs overlay"  style="background-image: url('https://fastly.picsum.photos/id/190/1600/330.jpg?hmac=-GhevoFoOoiC969cghjv_JCXSbTo3FO96l7jfuPjmwI');">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Informasi</h2>
                        <ul class="bread-list">
                        <li><a href="{{route('welcome')}}">Home</a></li>
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
            @if (count($informasi) > 0)
            @foreach ($informasi as $informasi)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-news">
                    <div class="news-head lightbox">
                        <img src="https://via.placeholder.com/560x370" alt="#" style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <div class="date">
                                {{ \Carbon\Carbon::parse($informasi->created_at)->format('d M Y') }}</div>
                            {{-- <h2><a href="{{ Route("informasiDetail", ['id' => $informasi->id] ) }}" target="_blank">{!! $informasi->judul_informasi !!}</a></h2> --}}
                            <h2><a href="#" onclick="openInformasiDetail({{ $informasi->id }}); return false;">{!! $informasi->judul_informasi !!}</a></h2>
                            <p class="text">{!! substr(strip_tags($informasi->isi_informasi), 0, 200) !!}...</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center">
                <div class="pagination">
                    {!! $informasis->links() !!}
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

<style scoped>
     .breadcrumbs.overlay {
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>

<script type="text/javascript">
     function openInformasiDetail(id) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ Route('informasiDetail') }}'; 
        form.target = '_blank';

        var idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = id;
        form.appendChild(idInput);

        // CSRF
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token';
        csrfTokenInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfTokenInput);

        // Submit the form
        document.body.appendChild(form);
        form.submit();
    }
</script>

@endsection
