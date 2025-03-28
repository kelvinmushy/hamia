@extends('backend.layouts.app')

@section('title', 'Create Property')

@section('top')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('content')
    <div class="block-header"></div>

     {{-- <div class="row clearfix">                            
                            <div class="col-md-8">
                            <div class="card">
                             <div class="header bg-indigo">
                        <h2>CREATE PROPERTY</h2>
                            </div>
                                  <div class="body">
                              <form action="/projects/store" class="dropzone" id="image-upload" method="POST" enctype="multipart/form-data" files = true>
                                @csrf
                                
                                    <div class="dz-message">
                                        <div class="drag-icon-cph"> <i class="material-icons">touch_app</i> </div>
                                        <h3>Drop files here or click to upload.</h3>
                                       </div>
                                 
                                </form>
                            </div>
                          </div>
                          </div>    
                        
     </div> --}}
  <form enctype="multipart/form-data" id="property_form">
    <div class="row clearfix">
      
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
               
                <div class="body">


                
                 <div class="form-group form-float">
                    <label class="form-label">Category</label>
                        <div class="form-line">
                        <select class="form-control select_category" name="category_id" id="category_id" >
                            @foreach($category as $c)
                             <option value="{{$c->id}}">{{$c->name}}</option>
                             @endforeach
                     </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                    <label class="form-label">Property Title</label>
                        <div class="form-line">
                        <select class="form-control select_title" name="title_id" id="title_id" >
                            @foreach($property_title as $title)
                             <option value="{{$title->id}}">{{$title->name}}</option>
                             @endforeach
                     </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                    <label class="form-label">Price</label>
                        <div class="form-line">
                            <input type="number" class="form-control" name="price" required>
                         
                        </div>
                    </div>
                    <div class="form-group form-float">
                <label class="form-label">Currency</label>
                    <div class="form-line">
                    <select class="form-control select_title" name="currency_id" id="currency_id" value="{{@$property->currency_id}}">
                        @foreach($currency as $currency)
                         <option value="{{$currency->id}}">{{$currency->name}}</option>
                         @endforeach
                   </select>
                     
                    </div>
                </div>

                    <div class="form-group form-float">
                    <label class="form-label">Bedroom</label>
                        <div class="form-line">
                            <input type="number" class="form-control" name="bedroom" required>
                        
                        </div>
                    </div>
                   
                    <div class="form-group form-float">
                    <label class="form-label">bathroom</label>
                        <div class="form-line">
                            <input type="number" class="form-control" name="bathroom" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                        <label class="form-label">Region</label>
                            <select class="form-control select_region" name="region">
                        @foreach($region as $region)
                             <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                          </select>
                        </div>
                    </div>
                     <div class="form-group form-float">
                        <div class="form-line">
                        <label class="form-label">District</label>
                            <select class="form-control select_district" name="district_id">
                        @foreach($district as $district)
                             <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                    <label class="form-label">sub location</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="sub_location" required>
                         
                        </div>
                    </div>
                    <div class="form-group form-float">
                    <label class="form-label">Address</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="address" required>
                           
                        </div>
                    </div>

                    <div class="form-group form-float">
                    <div class="help-info">Square Feet</div>
                  
                        <div class="form-line">
                        <label class="form-label">Area</label>
                            <input type="number" class="form-control" name="area" required>
                          
                        </div>
                      
                    </div>

                    <div class="form-group">
                    <label for="featured">Featured</label>
                        <input type="checkbox" id="featured" name="featured" class="filled-in" value="1" />
                      
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce">Description</label>
                        <textarea name="description" id="tinymce" class="form-control">{{old('description')}}</textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce-nearby">Nearby</label>
                        <select class="form-control show-tick select_near" name="nearby[]" id="nearby"  multiple="multiple">
                            <option value="">-- Please select multiple --</option>
                            @foreach($nearBye as $nearBye)     
                                <option value="{{$nearBye->id}}">{{$nearBye->name}}</option>
                            @endforeach
                            </select>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h2>GALLERY IMAGE</h2>
                </div>
                <div class="body">
                    <input id="input-id" type="file" name="gallaryimage[]" class="file" data-preview-file-type="text" multiple>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>SELECT</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('purpose') ? 'focused error' : ''}}">
                            <label>Select Purpose</label>
                            <select name="purpose_id" class="form-control show-tick" >
                            <option value="">-- Please select --</option>
                            @foreach($property_purpose as $property_purpose)   
                                <option value="{{$property_purpose->id}}">{{$property_purpose->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Select type</label> 
                            <select  class="form-control show-tick" name="type_id">
                            <option value="">-- Please select --</option>
                            @foreach($property_type as $property_type)     
                               
                                <option value="{{$property_type->id}}">{{$property_type->name}}</option>  
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <h5>Features</h5>
                    <div class="form-group demo-checkbox">
                        @foreach($features as $feature)
                          <div class="row">
                          <div class="col-md-6">
                            <input type="checkbox" id="features-{{$feature->id}}" name="features[]" class="filled-in chk-col-indigo" value="{{$feature->id}}" />
                            <label class="form-check-label" for="flexCheckChecked">{{$feature->name}}</label>
                          </div>
                          </div>
                          
                        @endforeach
                    </div>
                     <h5>Terms</h5>
                    <div class="form-group demo-checkbox">
                        @foreach($terms as $term)
                            <input type="radio" id="features-{{$term->id}}" name="term_id" class="filled-in chk-col-indigo" value="{{$term->id}}" />
                            <label class="form-check-label" for="flexCheckChecked">{{$term->name}}</label>
                        @endforeach
                    </div>


                    <div class="form-group form-float">
                        <div class="form-line">
                        <label class="form-label">Video</label>
                            <input type="text" class="form-control" name="video">
                   
                        </div>
                        <div class="help-info">Youtube Link</div>
                    </div>

                    <div class="clearfix">
                        <h5>Google Map</h5>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_latitude" class="form-control" required/>
                                <label class="form-label">Latitude</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_longitude" class="form-control" required/>
                                <label class="form-label">Longitude</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card">
                <div class="header bg-indigo">
                    <h2>FLOOR PLAN</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        <input type="file" name="floor_plan">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="header bg-indigo">
                    <h2>FEATURED IMAGE</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        <input type="file" name="image">
                    </div>

                    {{-- BUTTON --}}
                    <a href="{{route('properties.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>BACK</span>
                    </a>

                    <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect btnSubmit">
                        <i class="material-icons">save</i>
                        <span>SAVE</span>
                    </button>
                </div>
            </div>
        </div>
        
    </div>
</form>
@endsection

@section('bot')
 <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
 $(document).ready(function(){
//dropzone 
 {{-- Dropzone.outDiscover=false;
   Dropzone.options.imageUpload = {
        
           autoProcessQueue : false,
             acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
              addRemoveLinks: true,
    maxFiles:4,
    parallelUploads : 100,
    multUpload:true,
    maxFilesize:5,
             init:function(){
            var submitButton = document.querySelector(".btnSubmit");
            myDropzone = this;

      submitButton.addEventListener('click', function(){
        myDropzone.processQueue();
      });

         this.on("complete", function(){
               if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
                {
                  var _this = this;
                _this.removeAllFiles();
                }
       
            });

    }
            
  } --}}
    
    $(function() {
                    $('#property_form').on('submit', function(e) {  
                         save_method = "add";
                        $('input[name=_method]').val('POST');
                        if (!e.isDefaultPrevented()) {
                            var id = $('#id').val();
                            if (save_method == 'add') url = "{{ url('properties') }}";
                            else url = "{{ url('properties') . '/' }}" + id;
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: new FormData($("#property_form")[0]),
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    $(".btnSubmit").attr("disabled", true);
                                    $('.btnSubmit').html("Please Wait...");
                                },
                                success: function(data) {
                                    $(".btnSubmit").attr("disabled", false);
                                    $('.btnSubmit').html("submit");
                                    swal({
                                        title: 'Success!',
                                        text: data.message,
                                        type: 'success',
                                        timer: '1500'
                                    })
                                    window.location.href = "/properties";
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
 
 })
 


$(document).ready(function(){
$(".select_region").select2({

})
$(".select_near").select2({

})


})
</script>



@endsection
