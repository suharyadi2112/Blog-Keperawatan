@extends('layouts.app')

@section('content')
    <section class="blog section" id="blog">
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
@endsection
