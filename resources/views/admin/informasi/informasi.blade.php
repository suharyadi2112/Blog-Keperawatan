@extends('adminlte::page')

@section('title', 'Dashboard- Informasi')

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
                <div id="alertInfoSuccess"> </div>
                <div class="table table-responsive">
                    <table class="table table-hover text-nowrap table-bordered" id="informasiTable" width="100%">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Judul Informasi</th>
                            <th>Isi Informasi</th>
                            <th>Dokumentasi</th>
                            <th>Dokumen</th>
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
            <div class="form-group col-12">
                <label for="exampleInputBorderWidth2">Judul Informasi</label>
                <input type="text" name="judul_informasi" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Masukan judul informasi">
            </div>

            <div class="form-group col-6">
                <label for="exampleInputBorderWidth2">Dokumentasi</label>
                <input type="file" name="file_dokumentasi[]" id="fileDok" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth3" multiple>
                
                <code>jpeg,jpg,png,gif,svg</code>
            </div>

            <div class="form-group col-6">
                <label for="exampleInputBorderWidth2">Dokumen</label>
                <input type="file" name="file_dokumen[]" id="fileDok" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth4" multiple>
                
                <code>doc, docx, xls, xlsx, ppt, pptx, txt, pdf, csv</code>
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


  <div class="modal fade" id="modal-informasi-up-file">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="overLayAdd"></div>
        <div class="modal-header">
          <h4 class="modal-title">Ganti file</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form method="POST" id="upFileForm" data-route="{{ route('upFileDok') }}" enctype="multipart/form-data">
        <div class="modal-body row">
            <div id="alertInfo" class="col-12"> </div>
        
            <div class="form-group col-12">
                <label for="exampleInputBorderWidth2">File</label>
                <input type="hidden" name="idFiless" id="idFiless" >
                <input type="hidden" name="tipeFile" id="tipeFile" >
                <input type="file" name="file_dok" id="fileDok" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth3">
            </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnUpFile">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
{{-- add spesific file --}}
  <div class="modal fade" id="modal-add-file-spesific">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="overLayAdd"></div>
        <div class="modal-header">
          <h4 class="modal-title">Tambahkan file</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form method="POST" id="addFileForm" data-route="{{ route('addFileDok') }}" enctype="multipart/form-data">
        <div class="modal-body row">
            <div id="alertInfo" class="col-12"> </div>
            
            <div class="form-group col-6">
                <label for="">Tipe File</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio1" value="dokumen" name="tipeFIless">
                    <label for="customRadio1" class="custom-control-label">Dokumen</label>
                </div>
                
                <code>jpeg,jpg,png,gif,svg</code>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio2" value="dokumentasi" name="tipeFIless">
                    <label for="customRadio2" class="custom-control-label">Dokumentasi</label>
                </div>
                
                <code>doc, docx, xls, xlsx, ppt, pptx, txt, pdf, csv</code>
            </div>
            <div class="form-group col-6">
                <input type="hidden" name="idInformasi" id="idInformasi">
                <label for="">File</label>
                <input type="file" name="fileInformasi[]" id="fileInformasi" class="form-control form-control-border border-width-2" multiple>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnAddFile">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


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
                {data: 'action', name: 'action'},
                {data: 'judul_informasi', name: 'judul_informasi'},
                {data: 'isi_informasi', name: 'isi_informasi',

                    render: function(type, row, data){
	            		return '<a href="informasi/'+data.id+'" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm shadow-sm"><i class="fa fa-solid fa-eye"></i> Detail Informasi</button></a>';
                    }
                },
                {data: 'dokumentasis',
                    render: function(type, row, data) {
                        let dokumentasiHtml = '';
                        if (data.dokumentasis.length > 0) {
                            for (let i = 0; i < data.dokumentasis.length; i++) {
                                let link = '{{ asset("storage/dokumentasi/") }}' + '/' + data.dokumentasis[i].foto_dokumentasi;

                                dokumentasiHtml += '<div class="btn-group"><button type="button" class="btn btn-outline-danger shadow-sm delFile btn-sm pb-1 mb-1" data-tipe="dokumentasi"  data-id="'+data.dokumentasis[i].id+'"><i class="fa fa-solid fa-trash"></i></button>'+

                                '<button type="button" class="btn btn-outline-info shadow-sm upFile btn-sm pb-1 mb-1" data-tipe="dokumentasi"  data-id="'+data.dokumentasis[i].id+'"><i class="fa fa-solid fa-pencil-alt"></i></button></div> <a href="' + link + '" target="_blank"><button type="button" class="btn btn-sm btn-outline-primary shadow-sm pb-1 mb-1" ><i class="fa fa-solid fa-file"></i> '+ data.dokumentasis[i].foto_dokumentasi+'</button></a><br>';
                            }
                        } else {
                            dokumentasiHtml = 'No Dokumentasis';
                        }
                        return dokumentasiHtml;
                    }
                },
                {data: 'dokumen',
                    render: function(type, row, data) {
                        let dokumen = '';
                        if (data.dokumen.length > 0) {
                            for (let i = 0; i < data.dokumen.length; i++) {
                                var parts = data.dokumen[i].file.split('/');//split /dokumen
                                var namaDokumenFix = parts[1];
                                let link = '{{ asset("storage/") }}' + '/' + data.dokumen[i].file;

                                dokumen += '<div class="btn-group"><button type="button" class="btn btn-outline-danger shadow-sm delFile btn-sm pb-1 mb-1" data-tipe="dokumen"  data-id="'+data.dokumen[i].id+'"><i class="fa fa-solid fa-trash"></i></button>'+

                                '<button type="button" class="btn btn-outline-info shadow-sm upFile btn-sm pb-1 mb-1" data-tipe="dokumen"  data-id="'+data.dokumen[i].id+'"><i class="fa fa-solid fa-pencil-alt"></i></button></div> <a href="' + link + '" target="_blank"><button type="button" class="btn btn-sm round btn-outline-primary shadow-sm pb-1 mb-1" ><i class="fa fa-solid fa-file"></i> '+namaDokumenFix+'</button></a><br>';
                            }
                        } else {
                            dokumen = 'No Dokumen';
                        }
                        return dokumen;
                    }
                },
            ],
            createdRow:function(row,data,index){
		    	$('td',row).eq(3).attr("nowrap","nowrap");
		    	$('td',row).eq(0).css("vertical-align","middle");
		    	$('td',row).eq(1).css("vertical-align","middle");
		    	$('td',row).eq(2).css("vertical-align","middle");
		    	$('td',row).eq(2).css("text-align","left");
			}
        });

        //del file spesific
        $(document).on("click", ".delFile", function () {
            var result = confirm("Hapus file ini ?");
                if (result) {
                $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
                var idToSend = {
                    idFile: $(this).data('id'),
                    tipe: $(this).data('tipe')
                };
                $.ajax({
                    type: 'POST',
                    url: "{{ route('delFileDokumentasi') }}",
                    data: idToSend,
                    beforeSend: function() {
                        $('.alertSuccess').remove();
                        $('.delFile').prop('disabled', true);
                    },
                    success: function(data) {
                        alert("Berhasil dihapus");
                        tableInformasi.ajax.reload();
                    },
                    complete: function() {
                        $('.delFile').prop('disabled', false);
                    },
                    error: function(data,xhr) {
                        if (data.status && data.status == 400) {
                            
                        }
                        console.log(data.responseJSON)
                        console.log(data)
                    },
                });
            }
        });
        
        //add informasi
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

        //add file spesific
        $(document).on("click", ".addFile", function () {
            $("#modal-add-file-spesific").modal("show");
            var idInformasi = $(this).attr('data-id');
            $('#idInformasi').val(idInformasi);
        });
        $(document).on('submit', '#addFileForm', function(e) {
            var result = confirm("File yang pilih sudah benar ?");
            if (result) {
                e.preventDefault();
                var route = $('#addFileForm').data('route');
                $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

                $.ajax({
                    type: 'POST',
                    url: route,
                    enctype: 'multipart/form-data',
                    data: new FormData($('#addFileForm')[0]),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.btnAddFile').prop('disabled', true);
                        $('.listError').remove();
                    },
                    success: function(data) {
                        var successMsg = '<div class="alert alert-success alert-dismissible listError"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Berhasil menambah file </div>';
                        $('#alertInfoSuccess').append(successMsg);
                        $("#modal-add-file-spesific").modal("hide");
                    },
                    complete: function() {
                        tableInformasi.ajax.reload();
                        $('.btnAddFile').prop('disabled', false);
                    },
                    error: function(data,xhr) {
                        if (data.status && data.status == 400) {
                            alert("format file tidak sesuai")
                        }
                        console.log(data.responseJSON)
                        console.log(data)
                    },
                });
            }
        });



        //update file spesific
        $(document).on("click", ".upFile", function () {
            $("#modal-informasi-up-file").modal("show");
            var idFilee = $(this).attr('data-id');
            var tipeFile = $(this).attr('data-tipe');
            $('#idFiless').val(idFilee);
            $('#tipeFile').val(tipeFile);
        });
        $(document).on('submit', '#upFileForm', function(e) {
            e.preventDefault();
            var route = $('#upFileForm').data('route');
            $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

            $.ajax({
		        type: 'POST',
		        url: route,
                enctype: 'multipart/form-data',
		        data: new FormData($('#upFileForm')[0]),
                dataType: 'json',
                contentType: false,
                processData: false,
		        beforeSend: function() {
                    $('.btnUpFile').prop('disabled', true);
                    $('.listError').remove();
		        },
		        success: function(data) {
                    var successMsg = '<div class="alert alert-success alert-dismissible listError"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Berhasil mengubah file dokumentasi </div>';
                    $('#alertInfoSuccess').append(successMsg);
			    },
		        complete: function() {
                    tableInformasi.ajax.reload();
                    $('.btnUpFile').prop('disabled', false);
		        },
		        error: function(data,xhr) {
                    if (data.status && data.status == 400) {
                        alert("format file tidak sesuai")
                    }
                    console.log(data.responseJSON)
                    console.log(data)
		        },
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
                    var successMsg = '<div class="alert alert-success alert-dismissible listError"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-check"></i> Berhasil!</h5>Berhasil menyimpan informasi </div>';
                    $('#alertInfoSuccess').append(successMsg);
                    $("#modal-informasi-add").modal("hide");
                    console.log(data)
			    },
		        complete: function() {
                    $('.progressAdd').remove();
		        	$('.btnSaveInformasi').prop('disabled', false);
                    tableInformasi.ajax.reload();
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