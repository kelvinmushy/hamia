@extends('frontend.layouts.app')

@section('title',"$propertName")


@section('meta_description',"@$property->description")


@section('meta_keyword',"Buy,Rent,Sales Apartment,Single Room, Master Room,Land,Plots,Rent Godowns ")

@section('top')
 <style type="text/css">
    .notify-badge{
    position: absolute;
    right:-1px;
    top:0px;
    background:red;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    color:white;
    padding:5px 10px;
    font-size:10px;
}
 </style>
@endsection
@section('content')
   <section class="content home">
    <div class="block-header">
        <div class="row" style="margin-top:20px">
            <div class="col-lg-12 col-md-6 col-sm-12">
              <ul class="breadcrumb float-md-left">
                    <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i>All Property</a></li>
                    <li class="breadcrumb-item"><a href="/{{@$property->sub_category->slug}}">{{@$property->sub_category->name }}</a></li>
                    <li class="breadcrumb-item active">{{@$property->title }}</li>
                </ul> 
                {{-- <small  style="font-size:15px"><strong>{{@$property->title }}</strong></small> --}}
            </div>
            
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix" style="margin-top:-10px;">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body">
                        
                    <div id="demo2" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                           @foreach($property->property_gallery as $key =>$gg)
                               @if($key==0)
                                <li data-target="#{{$gg->path}}" data-slide-to="{{$key}}" class="active"></li>
                               @else
                                <li data-target="#{{$gg->path}}" data-slide-to="{{$key}}" class=""></li>
                               @endif
                            @endforeach

                        </ul>
                      
                        <div class="carousel-inner">
                             @foreach($property->property_gallery as $key =>$g)
                             {{--$g--}}
                             @if($key==0)
                                <div class="carousel-item active">
                                 @if($property->featured==1)
                                     <span class="notify-badge">VIP</span>
                                    @endif
                                <img   src="{{asset(@$g->path)}}" class="img-fluid" alt="">
                               
                                 </div>
                              @else
                               <div class="carousel-item">
                              
                                    @if($property->featured==1)
                                     <span class="notify-badge">VIP</span>
                                    @endif
                                <img  src="{{asset(@$g->path)}}" class="img-fluid" alt="">
                                
                            </div>
                             @endif

                         
                       @endforeach
                         
                         
                         
                           
                        </div>

                        <!-- Left and right controls -->
                       
                        <a class="carousel-control-prev" href="#demo2" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                        <a class="carousel-control-next" href="#demo2" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                    </div>

                    </div>
                </div>
                <div class="card property_list">
                    <div class="body">
                        <div class="property-content">
                            <div class="detail">

                                
                                <h4 class="m-t-0"><a href="#" class="col-blue-grey">{{ucwords(@$property->title) }}</a>
                                  {{-- <span>
                                    @if($property->status==0)
                                      <small class="text text-info" style="font-size:10px;">Available</small>
                                      @else
                                         <small class="text text-danger" style="font-size:10px;">Not Available</small>
                                      @endif
                                </span> --}}
                                </h4>
                                <h5 class="text-success m-t-0 m-b-0">{{ $property->currency->name }} {{number_format($property->price,0)  }}</h5>
                                  <p>Payment Term:<span class="text text-success"> {{@$property->property_term->term->name}}</span></p>
                                <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i>{{@$property->property_location->region->name}},{{@$property->property_location->name}},Tanzania</p>
                                <p class="text-muted m-b-0">{{$property->description }}</p>
                                <p><span style="color:black"> <small>{{
                                $property->created_at->diffForHumans([
                                'parts' => 1,
                               'join' => ', ',
                                'short' => true]);
                                }}</small> </span></p>


                            </div>
                              
                           @if(@$property->type->sub_category->id==6 ||@$property->type->sub_category->id==1 )
                                <div class="property-action m-t-15">
                                <a href="#" title="Square Feet"><i class="zmdi zmdi-view-dashboard"></i><span>{{@$property->property_area->value  }}</span></a>
                                <a href="#" title="Bedroom"><i class="zmdi zmdi-hotel"></i><span>{{@$property->bead_room->value }}</span></a>
                                <a href="#" title="Barth Room"><i class="fa fa-bath"></i><span>{{@$property->property_barth->value  }}</span></a>
                              
                            </div>
                             @else

                            @endif
                        </div>
                    </div>
                </div>
                 @if(@$property->propertyFurnish->furnish->name!="")
                 <div class="card">
                    
                    <div class="body">
                        <div class="row clearfix">
                        <div class="col-sm-3">
                          <b>Furnishing</b>
                        </div>
                             <div class="col-sm-3">
                                <i class="zmdi zmdi-check-circle text-success m-r-5"></i> 
                               
                                 {{ @$property->propertyFurnish->furnish->name }}
                                
                                 </div> 
                       <div class="col-sm-3">
                            <b>Condition</b>
                        </div>
                                   <div class="col-sm-3">
                                <i class="zmdi zmdi-check-circle text-success m-r-5"></i> 
                                 {{ @$property->propertyCondition->condition->name }}
                                 </div> 
                        </div>
                        </div>
                        </div>
                    @endif
                 <div class="card">
                    <div class="header">
                        <h2><strong>General</strong> Amenities</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                             
                          
                               
                             @foreach ($property->property_features->chunk(4) as $f )
                              
                            
                                    @foreach($f as $fp)
                                       <div class="col-sm-3">
                                <i class="zmdi zmdi-check-circle text-success m-r-5"></i>{{@$fp->features->name}}
                                 </div> 
                              @endforeach
                            
                                 
                             
                           
                           @endforeach
                        </div>
                    </div>
                </div>
                  <div class="card">
                    <div class="header">
                        <h2><strong>General</strong> Near By</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                       
                             @foreach ($property->property_near_by->chunk(4) as $near )
                              
                              
                                    @foreach($near  as $np)
                                     <div class="col-sm-3">
                               <i class="zmdi zmdi-check-circle text-success m-r-5"></i>{{@$np->near_by->name}}
                                   </div> 
                                 @endforeach
                                 
                           @endforeach
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card member-card">
                    <div class="header l-parpl">
                      
                           <a href="/agents/{{$property->user->id}}">  <h4 class="m-t-10">{{ $property->user->username}}</h4></a>
                    </div>
                    <div class="member-img">
                        <a href="/agents/{{$property->user->id}}"><img src="{{ url(isset($property->user->image) ? $property->user->image : 'images/noimage.jpg') }}" class="rounded-circle" alt="profile-image"></a>
                    </div>
                    <div class="body">
                        <div class="col-12">
                            <ul class="social-links list-unstyled">
                               @foreach(@$property->user->user_social_media as $social)
                                    
                                    <li><a title="{{$social->social_media->name}}" href="{{@$social->url}}"><i class="{{$social->social_media->icon}}"></i></a></li>
                                
                               
                                @endforeach    
                            </ul>
                           
                              @if(@$property->user->email) 
                            <p class="text-muted" style="text-align: center;">
                             <i class="zmdi zmdi-email"> {{@$property->user->email}}</i>
                            </p>
                             @endif
                                 @if(@$property->user->phone_number) 
                            <p class="text-muted" style="text-align: center;">
                             <i class="zmdi zmdi-phone"> {{@$property->user->phone_number}}</i>
                            </p>
                                @endif
                              <p class="text-muted" style="text-align: center;">
                                 <i class="zmdi zmdi-pin-drop"> {{@$property->user->user_location->sub_location}},{{@$property->user->user_location->district->name}},{{@$property->user->user_location->district->region->name}}</i></p>                        
                           
                        </div>
                        <hr>
                    
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Request</strong> Inquiry</h2>
                      
                    </div>
                    <div class="body">
                        <div class="form-group">
                           <form id="form-message" data-toggle="validator" enctype="multipart/form-data">
                              {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                             <input type="hidden" name="agent_id" class="form-control" value="{{$property->user->id}}" required>
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
</section>

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
@endsection