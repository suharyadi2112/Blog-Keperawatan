@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3 >Edit Informasi</h3>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">
                    <form method="POST" id="updateInformasi" data-route="{{ route('upDateInformasi',['id' => $informasi->id]) }}">
                            <div id="alertInfoSuccess"> </div>
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Judul Informasi</label>
                                <input type="text" name="judul_informasi" value="{{ $informasi->judul_informasi }}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Masukan judul informasi">
                            </div>
                
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Isi Informasi</label>
                                <textarea id="summernote" name="isi_informasi">
                                    {{ $informasi->isi_informasi }}
                                </textarea>
                            </div>  

                        <button type="submit" class="btn btn-info btnUpdateInformasi">Update Data</button>
                    </form>
                </div>
                    
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
 </section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function() { 


    $(document).on('submit', '#updateInformasi', function(e) {
            e.preventDefault();
            var route = $('#updateInformasi').data('route');
            $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

            $.ajax({
		        type: 'POST',
		        url: route,
		        data: new FormData($('#updateInformasi')[0]),
                dataType: 'json',
                contentType: false,
                processData: false,
		        beforeSend: function() {
                    $('.btnUpdateInformasi').prop('disabled', true);
                },
		        success: function(data) {
                    var successMsg = '<div class="alert alert-success alert-dismissible listError"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Berhasil mengupdate informasi </div>';
                    $('#alertInfoSuccess').append(successMsg);
                    console.log(data)
			    },
		        complete: function() {
		        	$('.btnUpdateInformasi').prop('disabled', false);
		        },
		        error: function(data,xhr) {
                    if (data.status && data.status == 400) {
                        
                    }
                    console.log(data.responseJSON)
                    console.log(data)
		        },
		    });

        });


    $('#summernote').summernote({
        tabsize: 2,
        height: 300
    });  
});
</script>
@stop