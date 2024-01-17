@extends('adminlte::page')

@section('title', 'Dokumentasi')

@section('content_header')
    <h1>Dokumentasi</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Dokumentasi</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-sm btn-block btn-primary" id="modalCreate"><i class="fa fa-solid fa-plus"></i> Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-nowrap" id="dokumentasiTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Dokumentasi</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalOpen" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="postForm" name="postForm">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" id="closeForm">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_dokumentasi">Nama Dokumentasi</label>
                            <input type="text" class="form-control" id="nama_dokumentasi" name="nama_dokumentasi"
                                placeholder="Nama Dokumentasi" required>
                        </div>
                        <div class="form-group">
                            <label for="foto_dokumentasi">File Dokumentasi</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto_dokumentasi"
                                        name="foto_dokumentasi" accept="image/*">
                                    <label class="custom-file-label" for="foto_dokumentasi">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteOpen" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="postForm" name="postForm">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Hapus Data</h5>
                        <button type="button" class="close" id="closeDlt">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="deleteBtn">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImageOpen" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Dokumentasi</h5>
                    <button type="button" class="close" id="closeImage">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });

            var table = $('#dokumentasiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dokumentasi') }}",
                columns: [{
                        data: 'nama_dokumentasi',
                        name: 'nama_dokumentasi'
                    },
                    {
                        data: 'foto_dokumentasi',
                        name: 'foto_dokumentasi'
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

            $('#modalCreate').click(function() {
                $('#saveBtn').val("create-data");
                $('#id').val('');
                $('#postForm').trigger("reset");
                $('#modal-title').html("Tambah Data");
                $('#modalOpen').modal('show');
            });

            $('body').on('click', '#modalEdit', function() {
                var id = $(this).data('id');
                $.get("{{ route('dokumentasi') }}" + '/' + id, function(data) {
                    $('#modal-title').html("Edit Data");
                    $('#saveBtn').val("edit-data");
                    $('#modalOpen').modal('show');
                    $('#id').val(data.id);
                    $('#nama_dokumentasi').val(data.nama_dokumentasi);
                })
            });

            function clearForm() {
                $('#postForm').trigger("reset");
                $('#saveBtn').val("create-data");
                $('#id').val('');
                $('#modal-title').html("Tambah Data");
                $('#saveBtn').prop("disabled", false);
                $('#modalOpen').modal('hide');
                $('#modalDeleteOpen').modal('hide');
                $('#modalImageOpen').modal('hide');
            }

            $('#closeForm').click(function() {
                clearForm();
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Mengirim');
                $('#saveBtn').prop("disabled", true);
                $('.alert').remove();
                $.ajax({
                    enctype: 'multipart/form-data',
                    data: new FormData($('#postForm')[0]),
                    url: "{{ route('dokumentasi.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        $('#saveBtn').html('Simpan');
                        clearForm();
                        table.draw();
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Berhasil Disimpan'
                        })
                    },
                    error: function(data) {
                        console.log(data);
                        var errorList = '<ul>';
                        $.each(data.responseJSON.errors, function(key, value) {
                            $.each(value, function(i, error) {
                                errorList += '<li>' + error + '</li>';
                            });
                        });
                        errorList += '</ul>';
                        $('#foto_dokumentasi').val('');
                        $('.modal-body').prepend(
                            '<div class="alert alert-danger" role="alert">' + errorList +
                            '</div>');
                        $('#saveBtn').html('Simpan');
                        $('#saveBtn').prop("disabled", false);
                        Toast.fire({
                            icon: 'error',
                            title: 'Data Gagal Disimpan'
                        })
                    }
                });
            });

            $('body').on('click', '#modalDelete', function() {
                var id = $(this).data('id');
                $.get("{{ route('dokumentasi') }}" + '/' + id, function(data) {
                    $('#id').val(data.id)
                    $('#modalDeleteOpen').modal('show');
                    $('.modal-body').prepend(
                        '<div id="txtDel"><p>Apakah Anda Yakin Ingin Menghapus Data Ini?<br><br>"' +
                        data.nama_dokumentasi + '"</p></div>');
                })
            });

            $('#closeDlt').click(function() {
                $('#txtDel p').remove();
                clearForm();
            });

            $('#deleteBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Mengirim');
                $('#deleteBtn').prop("disabled", true);
                var id = $('#id').val();
                var url = "{{ route('dokumentasi.destroy', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "DELETE",
                    dataType: 'json',
                    success: function(data) {
                        $('#deleteBtn').html('Hapus');
                        $('#deleteBtn').prop("disabled", false);
                        $('#txtDel p').remove();
                        $('#modalDeleteOpen').modal('hide');
                        table.draw();
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Berhasil Dihapus'
                        })
                    },
                    error: function(data) {
                        $('#deleteBtn').html('Hapus');
                        $('#deleteBtn').prop("disabled", false);
                        $('#txtDel p').remove();
                        $('#modalDeleteOpen').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: 'Data Gagal Dihapus'
                        })
                    }
                });
            })


            $('body').on('click', '#modalImage', function (){
                var id = $(this).data('id');
                $.get("{{ route('dokumentasi') }}" +'/' + id , function (data) {
                    $('#modalImageOpen').modal('show');
                    $('.modal-body').prepend('<img src="{{asset('storage/dokumentasi/')}}' + '/' + data.foto_dokumentasi + '" class="img-fluid rounded mx-auto d-block" style="width: 100%; height: 350px; object-fit: contain;">');
                })     
            });


            $('#closeImage').click(function () { 
                $('.modal-body img').remove();
                clearForm();
            });


        });
    </script>
@stop
