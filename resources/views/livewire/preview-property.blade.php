<div>






    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Property Preview
                           </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <a href="/agent/properties/create" class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </a>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Compass</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Property</a></li>
                    <li class="breadcrumb-item active">Property Preview</li>
                </ul>                
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12">
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
                                <img  src="{{asset($g->path)}}" class="img-fluid" alt="">
                                <div class="carousel-caption">
                                  <h3>{{@$property->property_company->region->name}},{{@$property->property_company->name}},Tanzania</h3>
                                </div>
                                 </div>
                              @else
                               <div class="carousel-item">
                                <img src="{{asset(@$g->path)}}" class="img-fluid" alt="">
                                <div class="carousel-caption">
                                    <h3>{{@$property->property_company->region->name}},{{@$property->property_company->name}},Tanzania</h3>
                                  
                                </div>
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
                                <h5 class="text-success m-t-0 m-b-0">{{ $property->currency->name }} {{number_format($property->price,0)  }}</h5>
                                <h4 class="m-t-0"><a href="#" class="col-blue-grey">{{@$property->title }}</a> <span>
                                    @if($property->status==0)
                                      <small class="text text-info">Available</small>
                                      @else
                                         <small class="text text-danger">Not Available</small>
                                      @endif
                                </span></h4>
                                <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i>{{@$property->property_company->region->name}},{{@$property->property_company->name}},Tanzania</p>
                                <p class="text-muted m-b-0">{{$property->description }}</p>
                            </div>
                           
                             
                           @if(@$property->type->sub_category->id==6 ||@$property->type->sub_category->id==1 )
                                <div class="property-action m-t-15">
                                <a href="#" title="Square Feet"><i class="zmdi zmdi-view-dashboard"></i><span>{{@$property->bead_room->value  }}</span></a>
                                <a href="#" title="Bedroom"><i class="zmdi zmdi-hotel"></i><span>{{@$property->bead_room->value }}</span></a>
                                <a href="#" title="Parking space"><i class="zmdi zmdi-car-taxi"></i><span>{{@$property->bead_room->value  }}</span></a>
                                <a href="#" title="Garages"><i class="zmdi zmdi-home"></i><span>{{ @$property->bead_room->value  }}</span></a>
                            </div>
                             @else

                            @endif
                         
                        </div>
                    </div>
                </div>
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
                        <h4 class="m-t-10">{{ $property->company->companyname}}</h4>
                    </div>
                    <div class="member-img">
                        <a href="/agents/{{$property->company->id}}"><img src="{{ url(isset($property->company->logo) ? $property->company->logo : 'images/noimage.jpg') }}" class="rounded-circle" alt="profile-image"></a>
                    </div>
                    <div class="body">
                        <div class="col-12">
                            <ul class="social-links list-unstyled">
                                <li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a title="twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a title="instagram" href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                            </ul>
                            @if(@$property->company->email) 
                            <p class="text-muted" style="text-align: center;">
                             <i class="zmdi zmdi-email"> {{@$property->company->email}}</i>
                            </p>
                             @endif
                                 @if(@$property->company->phone_number) 
                            <p class="text-muted" style="text-align: center;">
                             <i class="zmdi zmdi-phone"> {{@$property->company->phone_number}}</i>
                            </p>
                                @endif
                              <p class="text-muted" style="text-align: center;">
                                 <i class="zmdi zmdi-pin-drop"> {{@$property->company->location->sub_location}},{{@$property->company->location->district->name}},{{@$property->company->location->district->region->name}}</i></p>
                        </div>
                        
                       
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="body">
                      
                       <button type="submit" class="btn btn-primary btn-round">Edit</button>
                        <button class="btn btn-default btn-round">Published</button>
                        
                   </div>
            
                  </div>--}}
        </div>
    </div>







</div>