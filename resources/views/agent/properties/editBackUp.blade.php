@extends('backend.agent.app')

@section('title', 'Edit Property')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

@endpush


@section('content')

<div class="block-header"></div>

<form enctype="multipart/form-data" id="property_form">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="row clearfix">
    <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-indigo">
                <h2>CREATE PROPERTY</h2>
            </div>
            <div class="body">
            <div class="form-group form-float">
                    <label class="form-label">Category</label>
                        <div class="form-line">
                        <select class="form-control select_category" name="category_id" id="category_id" >
                            @foreach($category as $c)
                              <option  value="{{$c->id}}" {{ $c->id == $property->category_id ? 'selected' : '' }}>{{ $c->name }}</option>
                             @endforeach
                             
                     </select>
                        </div>
                    </div>
                <div class="form-group form-float">
                <label class="form-label">Property Title</label>
                    <div class="form-line">
                        <input type="hidden" id="id" name="id" value="{{$property->id}}">
                    <select class="form-control select_title" name="title_id" id="title_id">
                        @foreach($property_title as $title)
                       
                         <option  value="{{$title->id}}" {{ $title->id == $property->title_id ? 'selected' : '' }}>{{ $title->name }}</option>
                         
                         @endforeach
                 </select>
                    </div>
                </div>

                <div class="form-group form-float">
                <label class="form-label">Price</label>
                    <div class="form-line">
                        <input type="number" class="form-control" name="price" required value="{{$property->price}}">
                     
                    </div>
                </div>
                <div class="form-group form-float">
                <label class="form-label">Currency</label>
                    <div class="form-line">
                    <select class="form-control select_title" name="currency_id" id="currency_id" value="{{@$property->currency_id}}">
                        @foreach($currency as $currency)
                         {{-- <option value="{{$currency->id}}">{{$currency->name}}</option> --}}
                       <option  value="{{$currency->id}}" {{ $currency->id == $property->currency_id ? 'selected' : '' }}>{{$currency->name}}<option>
                         @endforeach
                   </select>
                     
                    </div>
                </div>

                <div class="form-group form-float">
                <label class="form-label">Bedroom</label>
                    <div class="form-line">
                        <input type="number" class="form-control" name="bedroom" required value="{{@$property->bead_room->value}}">
                    
                    </div>
                </div>

               
                <div class="form-group form-float">
                <label class="form-label">bathroom</label>
                      
                    <div class="form-line">
                        <input type="number" class="form-control" name="bathroom" required value="{{@$property->property_barth->value}}">
                    
                    </div>
                </div>

                <div class="form-group form-float">
                    <div class="form-line">
                    <label class="form-label">Region</label>
                        <select class="form-control" name="region" >
                    @foreach($region as $region)
                          <option  value="{{$region->id}}" {{ $region->id ==@$property->property_location->region_id ? 'selected' : '' }}>{{$region->name}}<option>
                    @endforeach
                      </select>
                    </div>
                </div>
                 <div class="form-group form-float">
                        <div class="form-line">
                        <label class="form-label">District</label>
                            <select class="form-control select_district" name="district_id">
                        @foreach($district as $district)
                   
                              <option  value="{{$district->id}}" {{ $district->id ==@$property->property_location->district_id ? 'selected' : '' }}>{{$district->name}}<option>
                        @endforeach
                          </select>
                        </div>
                    </div>
                <div class="form-group form-float">
                <label class="form-label">sub location</label>
                    <div class="form-line">
                        <input type="text" class="form-control" name="sub_location" required  value="{{@$property->property_location->name}}">
                    </div>
                </div>
                {{-- <div class="form-group form-float">
         
                <label class="form-label">Address</label>
                    <div class="form-line">
                        <input type="text" class="form-control" name="address" required  value="{{@$property->property_location->address}}">
                    </div>
                </div>
               --}}
                <div class="form-group form-float">
                <div class="help-info">Square Feet</div>
                    <div class="form-line">
                    <label class="form-label">Area</label>
                        <input type="number" class="form-control" name="area" required  value="{{@$property->property_area->value}}" required>
                    </div>
                  
                </div>

                <div class="form-group">
                <label for="featured">Featured</label>
                   @if($property->featured==1)
                    <input type="checkbox" id="featured" name="featured" class="filled-in" value="1" checked />
                    @else
                    <input type="checkbox" id="featured" name="featured" class="filled-in" value="1" />
                    @endif
                  
                </div>

                <hr>
                <div class="form-group">
                   
                    <label for="tinymce">Description</label>
                    <input type="hidden" id="descr" value="{{$property->description}}">
                    <textarea name="description" id="property_description" class="form-control"  required></textarea>
                </div>

                <hr>
                <div class="form-group">
                    <label for="tinymce-nearby">Nearby</label>
                 
                    <select class="form-control show-tick select_near" name="nearby[]" id="nearby"  multiple="multiple" >
                        <option value="">-- Please select multiple --</option>
                        @foreach($nearBye as $nearBye)  
                        @foreach($property->property_near_by as $key => $by)
                         <option  value="{{$nearBye->id}}" {{ $nearBye->id ==@$by->near_by_id ? 'selected' : '' }}>{{$nearBye->name}}<option>
                        @endforeach   
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
                        <select name="purpose_id" class="form-control " value="{{$property->purpose_id}}">{{old('description')}}">
                        <option value="">-- Please select --</option>
                        @foreach($property_purpose as $property_purpose)       
                     <option  value="{{$property_purpose->id}}" {{ $property_purpose->id ==@$property->purpose_id ? 'selected' : '' }}>{{$property_purpose->name}}<option>
                          
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group form-float">
                    <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                        <label>Select type</label> 
                        <select name="type_id" class="form-control show-tick" value="{{$property->type_id}}">
                        <option value="">-- Please select --</option>
                        @foreach($property_type as $property_type)   
                            <option value="{{$property_type->id}}">{{$property_type->name}}</option>  
                              <option  value="{{$property_type->id}}" {{ $property_type->id ==@$property->type_id ? 'selected' : '' }}>{{$property_type->name}}<option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <h5>Features</h5>
                <div class="form-group demo-checkbox">
                    @foreach($features as $feature)
                 
                    <input type="checkbox" id="features_id" name="features[]" class="filled-in chk-col-indigo" value="{{$feature->id}}"/>
                        <label class="form-check-label" for="flexCheckChecked">{{$feature->name}}</label>
                    @endforeach
                </div>
                 <h5>Terms</h5>
                    <div class="form-group demo-checkbox">
                        @foreach($terms as $term)
                            <input type="radio" id="features-{{$term->id}}" name="term_id" class="filled-in chk-col-indigo" value="{{$term->id}}" {{  $property->property_term->term_id== $term->id  ? 'checked' : '' }} />
                            <label class="form-check-label" for="flexCheckChecked">{{$term->name}}</label>
                        @endforeach
                    </div>

                {{-- <div class="form-group form-float">
                    <div class="form-line">
                    <label class="form-label">Video</label>
                        <input type="text" class="form-control" name="video"  value="{{@$property->video}}">
                        
                    </div>
                    <div class="help-info">Youtube Link</div>
                </div> --}}

                {{-- <div class="clearfix">
                    <h5>Google Map</h5>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="location_latitude" class="form-control"  value="{{@$property->property_location->latitude}}"/>
                            <label class="form-label">Latitude</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="location_longitude" class="form-control"   value="{{@$property->property_location->longitude}}"/>
                            <label class="form-label">Longitude</label>
                        </div>
                    </div>
                </div> --}}
                
            </div>
        </div>
        {{-- <div class="card">
            <div class="header bg-indigo">
                <h2>FLOOR PLAN</h2>
            </div>
            <div class="body">
                <div class="form-group">
                    <input type="file" name="floor_plan">
                </div>
            </div>
        </div> --}}
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
    </form>
</div>

@endsection

@section('bot')
<script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <script>
           $(document).ready(function(){
             var descr=$('#descr').val();
            $('#property_description').val(descr);
           var propert_id=$('#id').val();
              $.ajax({
                url: "{{ url('/feature/checkbox/edit') }}" + '/' + propert_id ,
                type: "GET",
                dataType: "JSON",
                success: function(html) {
                    $.each(html.data, function(i, item) {
                        $('input#features_id[type=checkbox]').each(function() {
                            if ($(this).val() == html.data[i].feature_id) {
                                $(this).prop('checked', true);
                            }

                        });

                    });
                },
                error: function() {
                    alert("Nothing Data");
                }
            });
          
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // DELETE PROPERTY GALLERY IMAGE
        $('.gallery-image-edit button').on('click',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var image = $('#gallery-'+id+' img').attr('alt');
            $.post("{{route('gallery-delete')}}",{id:id,image:image},function(data){
                if(data.msg == true){
                    $('#gallery-'+id).remove();
                }
            });
        });

        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {

                            $('<div class="gallery-image-edit" id="gallery-perview-'+i+'"><img src="'+event.target.result+'" height="106" width="173"/></div>').appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallaryimageupload').on('change', function() {
                imagesPreview(this, 'div#gallerybox');
            });
        });

        $(document).on('click','#galleryuploadbutton',function(e){
            e.preventDefault();
            $('#gallaryimageupload').click();
        })

   
     
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

        $(function() {
                    $('#property_form').on('submit', function(e) {  
                        save_method = 'edit';
                         $('input[name=_method]').val('PATCH');
                        if (!e.isDefaultPrevented()) {
                            var id = $('#id').val();
                            if (save_method == 'add') url = "{{ url('properties') }}";
                            else url = "{{ url('properties') . '/' }}" + id;
                            $.ajax({
                                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
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
                                window.location.href = "/agent/properties";
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
     
    </script>
@endsection
