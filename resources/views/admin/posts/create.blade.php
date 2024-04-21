@extends('backend.layouts.app')

@section('title', 'Create Post')

@push('styles')


@endpush


@section('content')
<div class="block-header">
        <a href="{{route('categories.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row">
  
    <div class="col-md-8">
    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="card">
    <div class="header">
       <h2>SELECT CATEGORY</h2>
       </div>
       <div class="body">

<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="title" class="form-control" value="{{old('title')}}">
        <label class="form-label">Post Title</label>
    </div>
</div>

<div class="form-group">
    <input type="checkbox" id="published" name="status" class="filled-in" value="1" />
    <label for="published">Published</label>
</div>
<hr>
<div class="form-group">
    <label for="">Body</label>
    <textarea name="body" id="tinymce" class="form-control">{{old('body')}}</textarea>
</div>

</div>
     </div>
</div>
     <div class="col-md-4">
     <div class="card">
                <div class="header">
                    <h2>SELECT CATEGORY</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('categories') ? 'focused error' : ''}}">
                            <label>Select Category</label>
                           
                             <select name="categories[]" class="form-control show-tick" multiple data-live-search="true">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('tags') ? 'focused error' : ''}}">
                            <label>Select Tag</label>
                           <select name="tags[]" class="form-control show-tick" multiple data-live-search="true">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach


                            </select>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="form-label">Featured Image</label>
                        <input type="file" name="image">
                    </div>


                    <a href="{{route('posts.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>BACK</span>
                    </a>

                    <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                        <i class="material-icons">save</i>
                        <span>SAVE</span>
                    </button>

                </div>
                </form>
            </div>
          

    </div>

  

</div>
 

@endsection


@push('scripts')

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });
    </script>

@endpush


