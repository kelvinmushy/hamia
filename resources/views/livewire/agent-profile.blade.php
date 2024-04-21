{{-- @extends('frontend.layouts.app')
@section('title',@$agent->username);
@section('content')
 
   
@endsection

@section('bot')
 <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
     
       $(function(){
            $('#form-message').on('submit', function (e) {
                   save_method = "add";
                  $('input[name=_method]').val('POST');
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('/property/message')}}";
                    else url = "{{ url('/universal/tool') . '/' }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
//                      data : $('#form-account').serialize(),
                        data: new FormData($("#form-message")[0]),
                        contentType: false,
                        processData: false,
                        beforeSend:function(){
                        $(".btnSubmit").attr("disabled",true);
                        $('.btnSubmit').html("Please Wait...");
                        },
                        success : function(data) {
                          
                            $(".btnSubmit").attr("disabled",false);
                            $('.btnSubmit').html("submit");
                             $('#form-message')[0].reset();
                           swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            $(".btnSubmit").attr("disabled",false);
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
@endsection --}}

<div>


 <div class="block-header">
        <div class="row" style="margin-top:-20px">
            <div class="col-lg-7 col-md-6 col-sm-12">
                 <small  style="font-size:15px"><strong>Agent {{ $agent->username}} All Property  </strong></small>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 ">                
              
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i>Property</a></li>
                    <li class="breadcrumb-item"><a href="/all-real-estate-agents-in-tanzania">Agent</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>                
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix" style="margin-top:-30px">
            <div class="col-lg-8 ">
               
               <div class="row">
         @foreach($agent->agent_property as $property)
            {{-- <div class="col-md-4"  style="padding:2px;">
             <a href="/property/{{str_slug($property->property_location->name)}}/{{$property->sub_category->slug}}/{{str_slug($property->title)}}/{{$property->id}}" >
                <div class="card property_list">
                    <div class="property_image">

                       @foreach($property->property_gallery as $key =>$g)
                             {{--$g--
                             @if($key==0)
                         <img  class="img-thumbnail" src="{{asset(@$g->path)}}" alt="" title="" style=" flex-shrink: 0; width: 100%;height: 200px; object-fit: cover;"/>
                             @endif
                         
                       @endforeach

                    </div>
                    <div class="body">
                        <div class="property-content">
                            <div class="detail">
                                <h5 class="text-success m-t-0 m-b-0"> TZ {{ number_format(@$property->price) }}</h5>
                                <h4 class="m-t-0">{{Str::limit(@$property->title,15)}}</h4>
                                <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i>{{@$property->property_location->region->name}},{{@$property->property_location->name}},Tanzania</p>
                             
                            </div>

                    
                        </div>
                       
                    </div>
                </div>
                </a>
               </div>  --}}
               <div class="b-listing-cards__item">
    <div class="fw-card qa-fw-card b-trending-card h-height-100p">
     <?php $x=$property->image;?>
    <a href="/property/{{str_slug($property->property_location->name)}}/{{$property->sub_category->slug}}/{{str_slug($property->title)}}/{{$property->id}}" >
       <div class="fw-card-media qa-fw-card-media" style="background-color: rgb(255, 255, 255); background-image:
        url(https://www.hamiafasta.com/{{$x=$property->image}});">
      {{-- <div class="b-trending-card__boosted-label h-flex-center" style="color: rgb(255, 255, 255); background-color: rgb(0, 181, 63);">
        Enterprise
      </div>  --}}
      <div class="b-trending-card__counter">
        {{@$property->property_gallery->count() }}
      </div>
      </div> 
      <div class="fw-card-content qa-fw-card-content"><div class="b-trending-card__title">
              <small> {{Str::limit(ucwords(@$property->title),15)}}</small>      
      </div> <div class="b-trending-card__price">
         <small>{{ Str::title($property->currency->name) }} {{number_format($property->price,0)  }} 
         per {{@$property->property_term->term->name}}</small>
      </div> 
      {{-- <div class="fw-card-content-icon">
      <button type="button" class="fw-button qa-fw-button fw-button--type-success fw-button--size-little fw-button--circle fw-button--has-icon" aria-label="Favorite">
      <span class="fw-button__content"><svg width="21px" height="21px" border-color="" border-width="0" color="#00B53F" xmlns="http://www.w3.org/2000/svg" class="icon sprite-icons">
      <use href="/_nuxt/220049c1fdab0efe1a4fedb67e47db45.svg#i-tab-saved-outlined" xlink:href="/_nuxt/220049c1fdab0efe1a4fedb67e47db45.svg#i-tab-saved-outlined"></use></svg> 
      <!---->
      </span>
      </button>
      </div> --}}
      </div>
      </a>
      </div>

    </div>
          @endforeach
               </div>
                   
            </div>
            <div class="col-lg-4 col-md-12">
              

                 <div class="card member-card">
                    <div class="header l-parpl">
                        <h4 class="m-t-10">{{ $agent->username}}</h4>
                    </div>
                    <div class="member-img">
                        <a href="/agents/{{$agent->id}}"><img src="{{ url(isset($agent->image) ? $agent->image : 'images/noimage.jpg') }}" class="rounded-circle" alt="profile-image"></a>
                    </div>
                    <div class="body">
                        <div class="col-12">
                            <ul class="social-links list-unstyled">

                                @foreach(@$agent->user_social_media as $social)
                                    
                                    <li><a title="{{$social->social_media->name}}" href="{{@$social->url}}"><i class="{{$social->social_media->icon}}"></i></a></li>
                                
                               
                                @endforeach                               
                            </ul>
                            <p class="text-muted">{{@$agent->user_location->sub_location}},{{@$agent->user_location->district->name}},{{@$agent->user_location->district->region->name}},{{@$agent->user_location->district->region->country->name}}</p>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Request</strong> Inquiry</h2>
                     
                    </div>
                    <div class="body">
                        <form id="form-message" data-toggle="validator" enctype="multipart/form-data">
                              {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                             <input type="hidden" name="agent_id" class="form-control" value="{{$agent->id}}" required>
                            <input type="text" class="form-control" placeholder="Name" name="name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile No." name="phone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..." name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-round btnSubmit">Submit</button>
                        
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>


</div>