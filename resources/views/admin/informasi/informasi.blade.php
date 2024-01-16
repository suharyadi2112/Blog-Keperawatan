@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Informasi</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Informasi</h3>
                <a title="tambahInformasi">
                    <button type="button" style="float: right;" class="btn btn-primary round btn-sm showAddInfo"><i class="fa fa-solid fa-plus"></i> Tambah</button>
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover text-nowrap table-bordered" id="informasiTable" width="100%">
                        <thead>
                        <tr>
                            <th>Judul Informasi</th>
                            <th>Isi Informasi</th>
                            <th>Dokumentasi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="modal fade" id="modal-informasi-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="overLayAdd"></div>
        <div class="modal-header">
          <h4 class="modal-title">Tambah Informasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form method="POST" id="addInfomasiForm" data-route="{{ route('addInformasi') }}" enctype="multipart/form-data">
        <div class="modal-body row">
            <div id="alertInfo" class="col-12"> </div>
            <div class="form-group col-6">
                <label for="exampleInputBorderWidth2">Judul Informasi</label>
                <input type="text" name="judul_informasi" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Masukan judul informasi">
            </div>

            <div class="form-group col-6">
                <label for="exampleInputBorderWidth2">Dokumentasi</label>
                <input type="file" name="file_dokumentasi[]" id="fileDok" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth3" placeholder="Masukan judul informasi" multiple>
            </div>

            <div class="form-group col-12">
                <label for="exampleInputBorderWidth2">Isi Informasi</label>
                <textarea id="summernote" name="isi_informasi">
                    Masukan isi informasi disini
                </textarea>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveInformasi">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  
  <div class="modal fade" id="modal-informasi-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="overLayAdd"></div>
        <div class="modal-header">
          <h4 class="modal-title">Edit Informasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form method="POST" id="addInfomasiForm" data-route="{{ route('addInformasi') }}">
        <div class="modal-body">
            <div id="alertInfo"> </div>
            <div class="form-group">
                <label for="exampleInputBorderWidth2">Judul Informasi</label>
                <input type="text" id="judul_informasi" name="judul_informasi" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Masukan judul informasi">
            </div>

            <div class="form-group">
                <label for="exampleInputBorderWidth2">Isi Informasi</label>
                <textarea id="summernote" name="isi_informasi" id="isi_informasi">
                    Masukan isi informasi disini
                </textarea>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveInformasi">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
    $(document).ready(function() { 
        var tableInformasi = $('#informasiTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: "{{ route('indexinformasi') }}",
            columns: [
                {data: 'judul_informasi', name: 'judul_informasi'},
                {data: 'isi_informasi', name: 'isi_informasi',

                    render: function(type, row, data){
	            		return '<a href="informasi/'+data.id+'" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm shadow"><i class="fa fa-solid fa-eye"></i> Detail Informasi</button></a>';
                    }
                },
                {data: 'dokumentasis',
                    render: function(type, row, data) {
                        let dokumentasiHtml = '';
                        if (data.dokumentasis.length > 0) {
                            for (let i = 0; i < data.dokumentasis.length; i++) {
                                let link = '{{ asset("storage/dokumentasi/") }}' + '/' + data.dokumentasis[i].foto_dokumentasi;
                                dokumentasiHtml += '<a href="' + link + '" target="_blank">' + data.dokumentasis[i].foto_dokumentasi + '</a><br>';
                            }
                        } else {
                            dokumentasiHtml = 'No Dokumentasis';
                        }

                        return dokumentasiHtml;
                    }
                },
                {data: 'action', name: 'action'},
            ],
            createdRow:function(row,data,index){
		    	$('td',row).eq(3).attr("nowrap","nowrap");
		    	$('td',row).eq(2).css("text-align","left");
			}
        });
        

        $(document).on("click", ".showAddInfo", function () {
            $("#modal-informasi-add").modal("show");
      
            //summernote
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });  
        });

        //delete informasi
        $(document).on("click", ".delInformasi", function () {
            var result = confirm("Data informasi akan dihapus ?");
            if (result) {
                var idInformasi = $(this).attr('data-id');
                $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: '{{ route("deleteInformasi", ":id") }}'.replace(":id", idInformasi),
                    type: 'DELETE',
                    success: function(data) {
                        alert('Data berhasil dihapus')
                        console.log(data)
                    },
                    error: function(data,xhr) {
                        console.log(data)
                    },
                    complete: function() {
                        tableInformasi.ajax.reload();
                    }
                });
            }
        });

        //update informasi
        $(document).on("click", ".upInformasi", function () {        
            var idInformasi = $(this).attr('data-id');
            $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: '{{ route("informasiByID", ":id") }}'.replace(":id", idInformasi),
                type: 'GET',
                success: function(data) {
                    console.log(data)
                },
                error: function(data,xhr) {
                    console.log(data)
                },
                complete: function() {
                }
            });
        });

        //store infomasi
        $(document).on('submit', '#addInfomasiForm', function(e) {
            e.preventDefault();
            var route = $('#addInfomasiForm').data('route');
            $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

            $.ajax({
		        type: 'POST',
		        url: route,
                enctype: 'multipart/form-data',
		        data: new FormData($('#addInfomasiForm')[0]),
                dataType: 'json',
                contentType: false,
                processData: false,
		        beforeSend: function() {
                    $('#overLayAdd').append('<div class="overlay progressAdd"><i class="fas fa-2x fa-sync fa-spin"></i></div>')
		        	$('.btnSaveInformasi').prop('disabled', true);
                    $('.listError').remove();
                    $('.listError').remove();
		        },
		        success: function(data) {
                    var successMsg = '<div class="alert alert-success alert-dismissible listError"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-check"></i> Alert!</h5>Berhasil menyimpan informasi </div>';
                    $('#alertInfo').append(successMsg);
                    
                    console.log(data)
			    },
		        complete: function() {
                    $('.progressAdd').remove();
		        	$('.btnSaveInformasi').prop('disabled', false);
                    tableInformasi.ajax.reload();
                    $("#modal-informasi-add").modal("hide");
		        },
		        error: function(data,xhr) {
                    if (data.status && data.status == 400) {
                        var errorMessage = '<div class="alert alert-danger alert-dismissible listError" style="padding-bottom: 0px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-ban"></i> Alert!</h5>';
                        if (data.responseJSON.message) {
                            errorMessage += '<ul>';
                            Object.keys(data.responseJSON.message).forEach(function (field) {
                                errorMessage += '<li>' + field + ': ' + data.responseJSON.message[field].join(', ') + '</li>';
                            });
                            errorMessage += '</ul>';
                        }
                        errorMessage += '</div>';
                        $('#alertInfo').append(errorMessage);
                    }
                    console.log(data.responseJSON)
                    console.log(data)
		        },
		    });

        });

    });
    </script>
@stop