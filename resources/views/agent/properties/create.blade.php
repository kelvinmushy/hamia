
@extends('backend.agent.app')

@section('title', 'Create Property')

@section('top')
 @livewireStyles
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
 
  .dr {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    text-align: center;
    margin-bottom: 15px;
    padding: 4px;
  
     }
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
.sidebar-item a{
    color:#000;
}
.sidebar-item a:hover {
  color:#22bb33;
}

</style>

@endsection

@section('content')
 <div class="container" style="margin-top:30px;">
         <h4 class="agent-title">DASHBOARD</h4>
          <div class="row">
          
            @include('agent.sidebar')
        
     
      <div class="col-md-8">
      <form action="/agent/properties" name="property-form" enctype="multipart/form-data" data-toggle="validator"  method="POST" id="dropzonewidget">
    {{ csrf_field() }} 

      <div class="card">
    <div class="body">
      <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="property_id" id="property_id" class="form-control">
        <div class="form-group">
        <div class="dr">
            <div class="dropzone" id="myDropzone">
           
        </div>
        </div>
    </div>
        </div>
    </div>
  
     <div class="row">
        <div class="col-md-12">
        <div class="form-group">
        <label for="tinymce">Description</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        </div>
    </div>
  
    <div class="row">
        {{-- <div class="col-md-4">
        <div class="form-group">
            <label>Category</label>
                   
           <select class="form-control select_category" name="category_id" id="category_id"  required 
            style="width:100%" >    
            <option value="">Select</option>
            @foreach($category as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
            </select>
             @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div> --}}

        <div class="col-md-6">
             <div class="form-group">
                <label>Property Category</label>
                <select class="form-control select_sub_category" name="sub_category_id" required id="sub_category_id"
                  style="width:100%">
                 <option value="" >Select</option>
                  @foreach($sub_category as $sub)
                  <option value="{{$sub->id}}">{{$sub->name}}</option>
                             @endforeach
                 </select>
             @error('sub_category_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-md-6">
               <div class="form-group">
                        
                <label> Select Property Type</label> 
                           
                 <select  class="form-control select_type" name="type_id" required id="type_id"
                             style="width:100%">
                  <option value="" >Select</option>
                   @foreach($property_type as $property_type)     
                               
                  <option value="{{$property_type->id}}">{{$property_type->name}}</option>  
                   @endforeach 
                  </select>
                          
                   @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        </div>

        

    </div>
    <div class="row">
     <div class="col-md-12">
              <div class="form-group">
                    <label> Title</label>
                         
                        <input class="form-control" name="title" required  id="title"   style="height:30px;border-radius: 5px;"/>
                            
                     
                        @error('title_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        </div>
    </div>
  
    <div class="row">
        <div class="col-md-4">
              <div class="form-group">
              <label class="form-label">Currency</label>
             <select class="form-control select_currency" name="currency_id" id="currency_id" value="{{@$property->currency_id}}"  style="width:100%">
                       <option value="" >Select</option>
                        @foreach($currency as $currency)
                         <option value="{{$currency->id}}">{{$currency->name}}</option>
                         @endforeach
                   </select>
            </div>
           @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        
        </div>
        <div class="col-md-4">
              <div class="form-group">
              <label>Payment Terms</label>
                        
             <select name="term_id" id="term_id" class="form-control select_term" required   style="width:100%">
             <option value="">Select</option>
            @foreach($terms as $term)
            <option value="{{$term->id}}">{{$term->name}}</option>
            @endforeach 
          </select>
                         
         @error('term_id') <span class="text-danger">{{ $message }}</span> @enderror
                       
        </div>
        </div>
        <div class="col-md-4">
             <div class="form-group">
                    <label class="form-label">Price</label>
                   
                            <input type="number" class="form-control" name="price" required style="height:30px;border-radius: 5px;">
                        
                             @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
        </div>
    </div>
   
        <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Region</label> 
                        <select class="form-control select_region" name="region_id" required id="region_id"   style="width:100%">
                          <option value="">Select</option>
                          @foreach($region as $region)
                             <option value="{{$region->id}}">{{$region->name}}</option>
                          @endforeach
                          </select>
                    </div>
                </div>
                  <div class="col-md-4">
                         <div class="form-group form-float">
                        
                        <label class="form-label">District</label>
                       
                        <select class="form-control select_district" name="district_id" id="district_id" required   style="width:100%">
                         <option value="">Select</option>
                        @foreach($district as $district)
                             <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                          </select>
                           
                        
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group ">
                    <label class="form-label">sub location</label> 
                     <input type="text" class="form-control" name="sub_location" required style="height:30px;border-radius: 5px;">
                    </div>
                    @error('sub_location') <span class="text-danger">{{ $message }}</span> @enderror
                    
                </div>
               </div>
      
       
          

               <div class="row">
            
                   <div class="col-md-6">
                        
                    <div class="form-group ">
                         <label>Property Features</label>
                        
                         <select class="form-control select_features" name="feature_id[]" id="property_feature" multiple="multiple"   style="width:100%" >
                         
                             @foreach($features as $feature)
                             <option value="{{$feature->id}}">{{$feature->name}}</option>
                             @endforeach
                         </select>  
                       
                    
                    </div>
                   </div>
                
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="tinymce-nearby">Nearby</label>
                       
                        <select class="form-control  select_near" name="nearby[]" id="nearby"  multiple="multiple"   style="width:100%">
                            
                            @foreach($nearBye as $nearBye)     
                                <option value="{{$nearBye->id}}">{{$nearBye->name}}</option>
                            @endforeach
                            </select>
                        
                    </div>
                   </div>
                </div>
                     <div class="row">
                     
                  <div class="col-md-6">
                      <div class="form-group propertCondition">
                        <label for="tinymce-nearby">Condition</label>
                       
                        <select class="form-control  select_condition" name="condition_id" id="condition_id"     style="width:100%">
                            
                             @foreach($condition as $condition)     
                                <option value="{{$condition->id}}">{{$condition->name}}</option>
                            @endforeach 
                            </select>
                        
                    </div>
                   </div>
                   
                  <div class="col-md-6">
                      <div class="form-group propertFurnish">
                        <label for="tinymce-nearby">Furnishing</label>
                       
                        <select class="form-control select_furnish" name="furnish_id" id="furnish_id"  style="width:100%">
                           
                            @foreach($furnish as $furnish)     
                                <option value="{{$furnish->id}}">{{$furnish->name}}</option>
                            @endforeach
                         </select>
                        
                    </div>
                   </div>
                     
                     </div>
                    <div class="row">
                     <div class="col-md-4">
                     <div class="form-group">
                    <label class="form-label">Square Feet/Area</label>
                        
                     <input type="number" class="form-control" name="area" required style="height:30px;border-radius: 5px;">
                     @error('area') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            
                   <div class="col-md-4 propertyBeadRoam">
                        <div class="form-group form-float" >
                    <label class="form-label">Bedroom</label>
                        
                     <input type="number" class="form-control" name="bedroom" style="height:30px;border-radius: 5px;">
                       
                       
                     @error('bedroom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                   </div>
                 <div class="col-md-4 propertyBathRoam">
                       <div class="form-group form-float" >
                    <label class="form-label">bathroom</label>
                    <input type="number" class="form-control" name="bathroom" style="height:30px;border-radius: 5px;">
                     @error('bathroom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>    
                 </div>
                    </div>
                
               </div>   
             
        </div>

       <div class="card card-footer">
             <div class="form-group" style="float:right">
               <button type="submit" class="btn btn-primary btnSubmit" id="submit-all"> Post Ad </button>
             </div>
        </div>

    </div>
    </form>
       
 </div>
 </div>
 </div>
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
    acceptedFiles: '.jpg,.png,.jpeg',
    addRemoveLinks: true,
    params:{_token:token},
    init: function() {
        dzClosure = this; 
       $("form[name='property-form']").submit(function(event){
           event.preventDefault();
           if (dzClosure.getQueuedFiles().length > 0) {  

                   
            event.preventDefault();
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
                                      dzClosure.on("complete", function (file) {
                                    if (dzClosure.getUploadingFiles().length === 0 && dzClosure.getQueuedFiles().length === 0)
                                        {
                                         dzClosure.removeAllFiles();
                                        var id=$('#property_id').val();
                                       // let preview= route('agent.preview.property',{id});
                                        //window.location.href =preview;
                                         window.location.href = '/agent/preview/propery/'+id;
                                       // window.location.href = "https://hamiafasta.com/agent/preview/propery/"+id;

                                     }
                                    });
                                     
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
            

             } 
             else {                       
               alert ("Please Attach At Least Three Images !!!")
               }

       

       })

        //send all the form data along with the files:
        this.on("sending", function(file, xhr, formData) {
           formData.append("_token", "{{ csrf_token() }}");
           let property_id=document.getElementById('property_id').value;
            formData.append("property_id", property_id);
        });
    }
}
$(document).ready(function(){

   
  
 $('#sub_category_id').on('change',function(){
         var id=$('#sub_category_id').val();
             $.ajax({
              type: 'GET',
              data: {
             "_token": "{{ csrf_token() }}",
              id: id,
              },
              url: '/agent/subcategory/propertyType',
              success: function(html) {
              $('select[name="type_id"]').empty();
             $('select[name="type_id"]').append('<option value="">Select Type</option>');
              $.each(html.data, function(key, value) {
            $('select[name="type_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

              },
              error: function(data) {
             
                 }

                 });
               
            })
      $('.select_region').on('change',function(){
         var id=$('#region_id').val();
             $.ajax({
              type: 'GET',
              data: {
             "_token": "{{ csrf_token() }}",
              id: id,
              },
              url: '/agent/region/district',
              success: function(html) {
              $('select[name="district_id"]').empty();
              $('select[name="district_id"]').append('<option value="">Select District</option>');
              $.each(html.data, function(key, value) {
            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

              },
              error: function(data) {
             
                 }

                 });
               
            })

 $('#sub_category_id').on('change',function(){
    var id=$('#sub_category_id').val();
    if(id==1||id==6||id==13){
      $('.propertyBeadRoam').show();
      $('.propertyBathRoam').show();
      $('.propertFurnish').show();
      $('.propertCondition').show();

    }else{
      $('.propertyBeadRoam').hide();
      $('.propertyBathRoam').hide(); 
        $('.propertFurnish').hide();
      $('.propertCondition').hide(); 
    }
      
  })

$(".select_region").select2({
     placeholder: 'Select Region',
     allowClear: true,
    
})
$(".select_near").select2({
     placeholder: 'Select NearBy',
     allowClear: true,
     
})
$(".select_type").select2({
     placeholder: 'Select Type',
     allowClear: true,
     
})
$(".select_purpose").select2({
     placeholder: 'Select Purpose',
     allowClear: true,
     
})
$(".select_features").select2({
     placeholder: 'Select Features',
     allowClear: true,
     

})

$(".select_sub_category").select2({
     placeholder: 'Select',
     allowClear: true,
     
})

$(".select_category").select2({
     placeholder: 'Select Category',
     allowClear: true,
     
})
$(".select_title").select2({
     placeholder: 'Select',
     allowClear: true,
     tags: true,
})
$(".select_term").select2({
     placeholder: 'Select',
     allowClear: true,
     
})
$(".select_district").select2({
     placeholder: 'Select',
     allowClear: true,
     
})
$(".select_condition").select2({
     placeholder: 'Select Condition',
     allowClear: true,
     
})
$(".select_furnish").select2({
     placeholder: 'Select Furnish',
     allowClear: true,
     
})
$(".select_currency").select2({
     placeholder: 'Select',
     allowClear: true,
     
})




})
</script>


@endsection
