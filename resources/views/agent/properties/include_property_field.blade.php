
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
     

<div class="property_include_content"></div>
 
@endsection
@section('bot')
 <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>


<script type="text/javascript">
 var token = $('meta[name="csrf-token"]').attr('content');
  Dropzone.options.myDropzone= {
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    url: '/agent/multiple/image/properties',
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
                             e.stopPropagation();
                              $.ajax({
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                url: "/agent/properties",
                                data: new FormData($("#dropzonewidget")[0]),
                                contentType: false,
                                processData: false,
                                type:'POST',
                                beforeSend: function() {
                                    $(".btnSubmit").attr("disabled", true);
                                    $('.btnSubmit').html("Please Wait...");
                                },
                                success: function(data) {
                                   
                                   $('#property_id').val(data.property_id);
                                    dzClosure.processQueue();
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
                            })
          

        });

        //send all the form data along with the files:
        this.on("sending", function(file, xhr, formData) {
           formData.append("_token", "{{ csrf_token() }}");
           let property_id=document.getElementById('property_id').value;
            formData.append("property_id", property_id);
        });
    }
}
$(document).ready(function(){

       var id=$('#sub_category_id').val();
             $.ajax({
              type: 'POST',
              data: {
             "_token": "{{ csrf_token() }}",
              id: id,
              },
              url: '/agent/ajaxFormContent',
              success: function(data) {
               $('.property_include_content').html(data.form);                            },
              error: function(data) {
              swal({
                 title: 'Oops...',
                 text: 'something is wrong',
                 type: 'error',
                 timer: '1500'
                  })
                 }

                 });
      
     $('#sub_category_id').on('change',function(){
         var id=$('#sub_category_id').val();
             $.ajax({
              type: 'POST',
              data: {
             "_token": "{{ csrf_token() }}",
              id: id,
              },
              url: '/agent/ajaxFormContent',
              success: function(data) {
               $('.property_include_content').html(data.form);                            },
              error: function(data) {
              swal({
                 title: 'Oops...',
                 text: 'something is wrong',
                 type: 'error',
                 timer: '1500'
                  })
                 }

                 });
                
            })

 $('#sub_category_id').on('change',function(){
    var id=$('#sub_category_id').val();
    if(id==1||id==6){
      $('.propertyBeadRoam').show();
      $('.propertyBathRoam').show();   
    }else{
      $('.propertyBeadRoam').hide();
      $('.propertyBathRoam').hide();  
    }
      
  })

$(".select_region").select2({

})
$(".select_near").select2({
     placeholder: 'Select NearBy',
     allowClear: true,
     tags: true,
})
$(".select_type").select2({
     placeholder: 'Select Type',
     allowClear: true,
     tags: true,
})
$(".select_purpose").select2({
     placeholder: 'Select Purpose',
     allowClear: true,
     tags: true,
})
$(".select_features").select2({
     placeholder: 'Select Features',
     allowClear: true,
     tags: true,

})

$(".select_sub_category").select2({
     placeholder: 'Select',
     allowClear: true,
     tags: true,

})

$(".select_category").select2({
     placeholder: 'Select Category',
     allowClear: true,
     tags: true,
})
$(".select_title").select2({
     placeholder: 'Select',
     allowClear: true,
     tags: true,
})
$(".select_term").select2({
     placeholder: 'Select',
     allowClear: true,
     tags: true,
})
$(".select_district").select2({
     placeholder: 'Select',
     allowClear: true,
     tags: true,
})

$(".select_currency").select2({
     placeholder: 'Select',
     allowClear: true,
     tags: true,
})

})
</script>


@endsection
