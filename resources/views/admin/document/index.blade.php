@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
    <h1>Dokumen</h1>
@stop

@section('content')

    @if (session()->has('success'))
        <div class="alert m-2 alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Dokumen</h3>
                            <div class="card-tools">
                                {{-- <a type="button" class="btn btn-sm round btn-outline-primary shadow" title="Tambah"
                                    label="Open Modal" data-toggle="modal" data-target="#modalAdd">Tambah</a> --}}
                                <a href="{{ route('dokumen.create') }}" class="btn btn-block btn-primary">Tambah Data</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered" id="tableDokumen">
                                <thead>
                                    <tr>
                                        {{-- <th style="width: 10px">#</th> --}}
                                        <th>Nama Dokumen</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th style="width: 150px"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->

            </div>
        </div>
        <div class="modal fade" id="modalDelete">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan menghapus dokumen <strong id="namaDokumen"></strong></p>
                    </div>
                    <div class="modal-footer">
                        <form action="" id="formHapus" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection


@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('js')

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {



            var table = $('#tableDokumen').DataTable({
                processing: true,
                serverSide: true,
                columns: [

                    {
                        data: 'nama',
                        name: 'Nama'
                    },
                    {
                        data: 'deskripsi',
                        name: 'Deskripsi'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });



        });

        const handleHapus = (id, nama) => {
            console.log(nama)

            var url = window.location.origin + '/dokumen/' + id;
            $('#modalDelete').modal('show');
            $('#namaDokumen').html(nama)
            $('#formHapus').prop("action", url);
        }
    </script>
@stop
