@extends('backend.layouts.app')

@section('title', 'Categories')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

    <div class="block-header">
    <button class="btn btn-default btnSub">
                                <i class="fa fa-plus">&nbsp;</i>
                            </button>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>SUB-CATEGORY LIST</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>SL.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach( $sub as $key => $category )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                    @if($category->image)
                                        <img src="{{ url(isset($category->image) ? $category->image : 'images/noimage.jpg') }}" alt="{{$category->name}}" width="60" class="img-responsive img-rounded">
                                        @endif
                                    </td>
                                    <td>{{$category->name}}</td>
                                
                                    <td>{{$category->slug}}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-info btn-sm waves-effect btnEdit" id="{{$category->id}}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection
  @section('bot')
  <div>@include('admin.sub-category.form')</div>


  
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
  
 $(document).ready(function() {

   $(document).on('click', '.btnSub', function() {
    save_method = "add";

    $('input[name=_method]').val('POST');
    $('#modal-sub').modal('show');
    $('#form-sub')[0].reset();
    $('.modal-title').text('Add SubCategory');

   });
   $(function() {
                    $('#form-sub').on('submit', function(e) {
                        if (!e.isDefaultPrevented()) {
                            var id = $('#sub_id').val();
                            if (save_method == 'add') url = "{{ url('/sub/categories') }}";
                            else url = "{{ url('/sub/categories') . '/' }}" + id;
                            $.ajax({
                                url: url,
                                type: "POST",
                                //                      data : $('#form-account').serialize(),
                                data: new FormData($("#form-sub")[0]),
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    $(".btnSubmit").attr("disabled", true);
                                    $('.btnSubmit').html("Please Wait...");
                                },
                                success: function(data) {
                                    $('#modal-sub').modal('hide');
                                    location.reload();
                                    $(".btnSubmit").attr("disabled", false);
                                    $('.btnSubmit').html("submit");
                                    swal({
                                        title: 'Success!',
                                        text: data.message,
                                        type: 'success',
                                        timer: '1500'
                                    })
                                },
                                error: function(data) {
                                    $(".btnSubmit").attr("disabled", false);
                                    $('.btnSubmit').html("submit");
                                    swal({
                                        title: 'Oops...',
                                        text: data.message,
                                        type: 'error',
                                        timer: '1500'
                                    })
                                }
                            });
                            return false;
                        }
                    });

                });
//Editing Will Be Here
$('.btnEdit').on('click',function(){
    var id=$(this).attr('id');
    save_method = 'edit';
                $('input[name=_method]').val('PATCH');
                $('#form-sub')[0].reset();
                $.ajax({
                    url: "{{ url('/sub/categories') }}" + '/' + id + "/edit",
                    type: "GET",
                    dataType: "JSON",
                    success: function(html) {
                        $('#modal-sub').modal('show');
                        $('.modal-title').text('Edit Sub-Category');
                        $('#sub_id').val(html.data.id);
                        $('#name').val(html.data.name);
                        $('#slug').val(html.data.slug);
                    },
                    error: function() {
                        alert("Nothing Data");
                    }
                });
})


    })
    </script>
  @endsection


