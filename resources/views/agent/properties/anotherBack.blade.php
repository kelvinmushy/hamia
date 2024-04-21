
@extends('backend.agent.app')

@section('title', 'Create Property')

@section('top')
 @livewireStyles
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<style>
 
  .dr {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    text-align: center;
    margin-bottom: 15px;
    padding: 4px;
  
     }


</style>

@endsection

@section('content')


 <form action="/cd" enctype="multipart/form-data"  method="POST" id="dropzonewidget">
    {{ csrf_field() }} 
    <input type="text" id ="firstname" name ="firstname" />
    <input type="text" id ="lastname" name ="lastname" />
    <div class="form-group">
        <div class="dr">
            <div class="dropzone" id="myDropzone">
           
        </div>
        </div>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-primary" id="submit-all"> upload </button>
</div>
</form>
       
 
@endsection

@section('bot')
 <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>


<script type="text/javascript">
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  Dropzone.options.myDropzone= {
     headers: {
            'x-csrf-token': CSRF_TOKEN,
        },
    url: '/cd',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 5,
    maxFilesize: 1,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    params:{_token:token},
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
                       document.getElementById("submit-all").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
                            e.preventDefault();
                           dzClosure.processQueue();

                           

        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("firstname", jQuery("#firstname").val());
            formData.append("lastname", jQuery("#lastname").val());
        });
    }
}
</script>


@endsection
