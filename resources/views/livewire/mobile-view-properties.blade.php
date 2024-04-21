 <div class="row clearfix ">
       @include('frontend.partials.mobile_property_types')

        <div class="col-md-12">

      
         <div class="row" style="margin-top:-22px;">
           @foreach($properties as $property)

            <div class="col-lg-3 col-6" style="padding:2px;">
             <a href="/property/{{$property->id}}" >
                     @if($property->featured==1)
                        <div class="card property_list " style="border: 2px solid ;border-color:#EF8308;">
                     @else
                     <div class="card property_list ">

                      @endif
               
                    <div class="property_image">
                    
                       @foreach($property->property_gallery as $key =>$g)
                             {{--$g--}}
                             @if($key==0)

                         <img  class="img-thumbnail" src="{{asset(@$g->name)}}" alt="" title="" style=" flex-shrink: 0; width: 100%;height: 200px; object-fit: cover;"/>
                             @endif
                         
                       @endforeach
                       @if($property->featured==1)
                        <span class="badge badge-success">VIP</span>
                      @endif

                    </div>
                    <div class="body">
                        <span class="badge badge-danger">For {{ Str::limit(@$property->purpose->name,15)}}</span>
                        <div class="property-content">
                            <div class="detail">
                              
                                <h4 class="m-t-0">{{Str::limit(@$property->title->name,15)}}</h4>
                                <h5 class="text-success m-t-0 m-b-0"> {{ $property->currency->name }} {{number_format($property->price,0)  }} </h5>
                                <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i>{{Str::limit(@$property->property_location->region->name,10)}},{{Str::limit(@$property->property_location->name,10)}} </p>
                                 <p><span style="color:black"> <small>{{
                                $property->created_at->diffForHumans([
                                'parts' => 1,
                               'join' => ', ',
                                'short' => true]);
                                }}</small> </span></p>
                            </div>
                        
                        </div>
                    </div>
                </div>
                </a>
               </div> 
          @endforeach

 </div>
       @if ($properties->hasMorePages())
                    
                        <div class="row">
                       
                            <div class="col-md-12 text-center justify-content-center">
                                <button wire:click="loadMore()" class="btn btn-primary btn-lg shadow-sm">
                                    More...</button> 
                            </div>
                            &nbsp;
                        </div>
                   
                @else
                    <div class="row">
                        <div class="col-md-12 text-center justify-content-center" style="margin-bottom:12px">
                            <button class="btn btn-danger btn-lg shadow-sm justify-content-right" style="margin:2px;">No
                                More Posts</button>
                        </div>
                    </div>
         @endif
 </div>
