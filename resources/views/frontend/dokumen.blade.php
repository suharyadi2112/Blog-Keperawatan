@extends('layouts.app')
@section('title', 'Dokumen')
@section('content')
    <section class="blog grid section" id="blog" style="padding-top: 0px;">
        <div class="breadcrumbs overlay"
            style="background-image: url('https://fastly.picsum.photos/id/190/1600/330.jpg?hmac=-GhevoFoOoiC969cghjv_JCXSbTo3FO96l7jfuPjmwI');">
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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="30px"class="text-center">No</th>
                                <th> Dokumen</th>

                                <th class="text-center">Detail</th>
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
                                        <a href="{{ 'storage/' . $dokumen->file }}"
                                            class="btn btn-sm round btn-outline-primary text-light shadow mr-2">
                                            <i class="fa fas fa-search"></i>

                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
@endsection
