@extends('backend.layouts.app')

@section('title', 'Properties')
@section('top')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
@endsection


@section('content')

    <div class="block-header">
        <a href="{{route('properties.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREATE </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>PROPERTY LIST</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Type</th>
                                    <th>Purpose</th>
                                    <th>Beds</th>
                                    <th>Baths</th>
                                    <th><i class="material-icons small">comment</i></th>
                                    <th><i class="material-icons small">stars</i></th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $properties as $key => $property )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if($property->image)
                                        <img src="{{ url(isset($property->image) ? $property->image : 'images/noimage.jpg') }}" alt="{{$property->title->name}}" width="60" class="img-responsive img-rounded">
                                        @endif
                                    </td>
                                    <td>
                                        <span title="{{$property->title->name}}">
                                            {{ str_limit($property->title->name,10) }}
                                        </span>
                                    </td>
                                    <td>{{$property->user->name}}</td>
                                    <td>{{$property->type->name}}</td>
                                    <td>{{$property->purpose->name}}</td>
                                    <td>{{@$property->bead_room->value}}</td>
                                    <td>{{@$property->property_barth->value}}</td>

                                    <td>
                                        <span class="badge bg-indigo">{{ $property->comments_count }}</span>
                                    </td>

                                    <td>
                                        @if($property->featured == true)
                                            <span class="badge bg-indigo"><i class="material-icons small">star</i></span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{route('properties.show',$property->id)}}" class="btn btn-success btn-sm waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('properties.edit',$property->id)}}" class="btn btn-info btn-sm waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deletePost({{$property->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                     {{--   <form action="{{route('properties.destroy',@$property->id)}}" method="POST" id="del-post-{{@$property->id}}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>--}}
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

    <script>
        function deletePost(id){
            
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-post-'+id).submit();
                    swal(
                    'Deleted!',
                    'Post has been deleted.',
                    'success'
                    )
                }
            })
        }
    </script>


@endsection

  

