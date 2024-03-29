@extends('layouts.app')
@section('title', 'Dokumen')
@section('content')
    <section class="blog grid section" id="blog" style="padding-top: 0px;">
        <div class="breadcrumbs overlay"
            style="background-image: url('{{ asset('assets/img/rsup.png') }}');">
            <div class="container">
                <div class="bread-inner">
                    <div class="row">
                        <div class="col-12">
                            <h2>Dokumen</h2>
                            <ul class="bread-list">
                                <li><a href="{{route('welcome')}}">Home</a></li>
                                <li><i class="icofont-simple-right"></i></li>
                                <li class="active">Dokumen</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover" id="table">
                        <thead>
                            <tr>
                                <th width="30px"class="text-center">No</th>
                                <th> Dokumen</th>

                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dokumens as $i=>$dokumen)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td>
                                        <p> <strong> {{ $dokumen->nama }}</strong></p>
                                        {{ $dokumen->deskripsi }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ 'storage/' . $dokumen->file }}" class="btn btn-sm round btn-outline-primary text-light shadow mr-2"  target="_blank">
                                            <i class="fa fas fa-search"></i>

                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <div class="float-right">
                        <div class="pagination">
                            {!! $dokumens->links() !!}
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style scoped>
    .breadcrumbs.overlay {
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
    </style>
@endpush
