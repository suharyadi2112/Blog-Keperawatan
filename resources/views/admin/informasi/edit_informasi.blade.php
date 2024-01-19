@extends('adminlte::page')

@section('title', 'Dashboard - Edit Informasi')

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
                <form method="POST" id="updateInformasi" data-route="{{ route('upDateInformasi',['id' => $informasi->id]) }}">
                    <div id="alertInfoSuccess"> </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Judul Informasi</label>
                                <input type="text" name="judul_informasi" value="{{ $informasi->judul_informasi }}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Masukan judul informasi">
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="form-group">
                                <label for="exampleInputBorderWidththumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control form-control-border border-width-2" id="exampleInputBorderWidththumbnail">
                                <font color="blue">{{ $informasi->thumbnail }}</font><br>
                                <code>jpeg,jpg,png</code>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth3">Isi Informasi</label>
                                <textarea id="summernote" name="isi_informasi">
                                    {{ $informasi->isi_informasi }}
                                </textarea>
                            </div> 
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btnUpdateInformasi">Update Data</button>
                </form>
                    
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
 </section>    

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
                $('.listError').remove();
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
                
                var errorMessage = '<div class="alert alert-danger alert-dismissible listError" style="padding-bottom: 0px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-ban"></i> Alert!</h5>';
                if (data.responseJSON.message) {
                    errorMessage += '<ul>';
                    Object.keys(data.responseJSON.message).forEach(function (field) {
                        errorMessage += '<li>' + field + ': ' + data.responseJSON.message[field].join(', ') + '</li>';
                    });
                    errorMessage += '</ul>';
                }
                errorMessage += '</div>';
                $('#alertInfoSuccess').append(errorMessage);
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