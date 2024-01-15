@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
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
                    <table class="table table-hover text-nowrap" id="informasiTable" width="100%">
                        <thead>
                        <tr>
                            <th>Judul Informasi</th>
                            <th>Isi Informasi</th>
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
        
        <form method="POST" id="addInfomasiForm" data-route="{{ route('addInformasi') }}">
        <div class="modal-body">
            <div id="alertInfo"> </div>
            <div class="form-group">
                <label for="exampleInputBorderWidth2">Judul Informasi</label>
                <input type="text" name="judul_informasi" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Masukan judul informasi">
            </div>

            <div class="form-group">
                <label for="exampleInputBorderWidth2">Isi Informasi</label>
                <textarea id="summernote" name="isi_informasi">
                    Masukan isi informasi disini
                </textarea>
                <div class="card-footer">
                Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.
                </div>
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
        $('#informasiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('indexinformasi') }}",
            columns: [
                {data: 'judul_informasi', name: 'judul_informasi'},
                {data: 'isi_informasi', name: 'isi_informasi'},
                {data: 'action', name: 'action'},
            ]
        });

        $(document).on("click", ".showAddInfo", function () {
            $("#modal-informasi-add").modal("show");
      
            //summernote
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });  
        });

        $(document).on('submit', '#addInfomasiForm', function(e) {
            e.preventDefault();
            var route = $('#addInfomasiForm').data('route');
            var form_data = $(this);
            $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

            $.ajax({
		        type: 'POST',
		        url: route,
		        data: form_data.serialize(),
		        beforeSend: function() {
                    $('#overLayAdd').append('<div class="overlay progressAdd"><i class="fas fa-2x fa-sync fa-spin"></i></div>')
		        	$('.btnSaveInformasi').prop('disabled', true);
                    $('.listError').remove();
		        },
		        success: function(data) {
                    var successMsg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-check"></i> Alert!</h5>Berhasil menyimpan informasi </div>';
                    $('#alertInfo').append(successMsg);
                    
                    console.log(data)
			    },
		        complete: function() {
                    $('.progressAdd').remove();
		        	$('.btnSaveInformasi').prop('disabled', false);
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