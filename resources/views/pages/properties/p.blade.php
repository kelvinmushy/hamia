@extends('frontend.layouts.app')

@section('title', $propertName)
@section('meta_description', $property->description)
@section('meta_keyword', "Buy,Rent,Sales Apartment,Single Room, Master Room,Land,Plots,Rent Godowns")

@section('top')
<style type="text/css">
    .property-gallery-container {
        position: relative;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .carousel-inner {
        border-radius: 8px 8px 0 0;
        overflow: hidden;
    }
    
    .carousel-item img {
        height: 500px;
        object-fit: cover;
        width: 100%;
    }
    
    .notify-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #ff8a00, #e52e71);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    
    .thumbnail-container {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 0 0 8px 8px;
    }
    
    .thumbnails {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 5px;
        scrollbar-width: thin;
    }
    
    .thumbnails::-webkit-scrollbar {
        height: 4px;
    }
    
    .thumbnails::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 2px;
    }
    
    .thumbnail {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .thumbnail:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .thumbnail.active {
        border-color: #007bff;
        transform: scale(1.05);
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
        background: rgba(0,0,0,0.3);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .property-gallery-container:hover .carousel-control-prev,
    .property-gallery-container:hover .carousel-control-next {
        opacity: 1;
    }
    
    @media (max-width: 768px) {
        .carousel-item img {
            height: 350px;
        }
        
        .thumbnail {
            width: 60px;
            height: 45px;
        }
    }
    
    /* Additional existing styles */
    .property-feature {
        display: flex;
        align-items: center;
        margin-right: 15px;
    }
    .property-feature i {
        margin-right: 5px;
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
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix" style="margin-top:-10px;">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <!-- Modern Carousel with Thumbnails -->
                <div class="property-gallery-container">
                    <div id="propertyCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($property->property_gallery as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                @if($property->featured == 1)
                                <span class="notify-badge">VIP</span>
                                @endif
                                <img src="{{ asset($image->path) }}" 
                                     class="d-block w-100" 
                                     alt="Property image {{ $key+1 }}"
                                     loading="lazy">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#propertyCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <!-- Thumbnail Navigation -->
                    <div class="thumbnail-container">
                        <div class="thumbnails">
                            @foreach($property->property_gallery as $key => $image)
                            <img src="{{ asset($image->path) }}" 
                                 class="thumbnail {{ $key == 0 ? 'active' : '' }}" 
                                 data-target="#propertyCarousel" 
                                 data-slide-to="{{ $key }}"
                                 alt="Thumbnail {{ $key+1 }}"
                                 loading="lazy">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="card property_list">
                    <div class="body">
                        <div class="property-content">
                            <div class="detail">
                                <h4 class="m-t-0"><a href="#" class="col-blue-grey">{{ucwords(@$property->title) }}</a></h4>
                                <h5 class="text-success m-t-0 m-b-0">{{ $property->currency->name }} {{number_format($property->price,0) }}</h5>
                                <p>Payment Term: <span class="text text-success">{{@$property->property_term->term->name}}</span></p>
                                <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i>{{@$property->property_location->region->name}}, {{@$property->property_location->name}}, Tanzania</p>
                                <p class="text-muted m-b-0">{{$property->description }}</p>
                                <p><span style="color:black"> <small>{{
                                    $property->created_at->diffForHumans([
                                    'parts' => 1,
                                    'join' => ', ',
                                    'short' => true])
                                    }}</small> </span></p>
                            </div>
                              
                            @if(@$property->type->sub_category->id==6 || @$property->type->sub_category->id==1)
                            <div class="d-flex flex-wrap property-action m-t-15">
                                <div class="property-feature">
                                    <i class="zmdi zmdi-view-dashboard"></i>
                                    <span>{{@$property->property_area->value }} sq.ft</span>
                                </div>
                                <div class="property-feature">
                                    <i class="zmdi zmdi-hotel"></i>
                                    <span>{{@$property->bead_room->value }} Bedrooms</span>
                                </div>
                                <div class="property-feature">
                                    <i class="fa fa-bath"></i>
                                    <span>{{@$property->property_barth->value }} Baths</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Property Condition & Furnishing -->
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

                <!-- Amenities Section -->
                <div class="card">
                    <div class="header">
                        <h2><strong>General</strong> Amenities</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            @foreach ($property->property_features->chunk(4) as $f)
                                @foreach($f as $fp)
                                <div class="col-sm-3">
                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>{{@$fp->features->name}}
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Nearby Locations -->
                <div class="card">
                    <div class="header">
                        <h2><strong>General</strong> Near By</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            @foreach ($property->property_near_by->chunk(4) as $near)
                                @foreach($near as $np)
                                <div class="col-sm-3">
                                    <i class="zmdi zmdi-check-circle text-success m-r-5"></i>{{@$np->near_by->name}}
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4 col-md-12">
                <!-- Agent Card -->
                <div class="card member-card">
                    <div class="header l-parpl">
                        <a href="/agents/{{$property->user->id}}"><h4 class="m-t-10">{{ $property->user->username}}</h4></a>
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
                                <i class="zmdi zmdi-pin-drop"> {{@$property->user->user_location->sub_location}},{{@$property->user->user_location->district->name}},{{@$property->user->user_location->district->region->name}}</i>
                            </p>
                        </div>
                        <hr>
                    </div>
                </div>

                <!-- Inquiry Form -->
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
    </div>
</section>
@endsection

@section('bot')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Sync thumbnails with carousel
    $('#propertyCarousel').on('slid.bs.carousel', function () {
        const activeIndex = $(this).find('.carousel-item.active').index();
        $('.thumbnail').removeClass('active').eq(activeIndex).addClass('active');
        
        // Scroll thumbnails to keep active in view
        const thumbnails = $('.thumbnails')[0];
        const activeThumb = $('.thumbnail.active')[0];
        if (activeThumb) {
            thumbnails.scrollTo({
                left: activeThumb.offsetLeft - thumbnails.offsetLeft - 100,
                behavior: 'smooth'
            });
        }
    });

    // Click on thumbnail
    $('.thumbnail').click(function() {
        const index = $(this).data('slide-to');
        $('#propertyCarousel').carousel(index);
    });

    // Existing form submission code
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
</script>
@endsection