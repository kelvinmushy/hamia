
 <div class="row clearfix">
        <div class="col-md-3">
        @include('frontend.partials.sidebar')

        </div>
        <div class="col-md-9">
             @include('frontend.partials.property_type')
          <div class="row" style="margin-top:-22PX">
           @foreach($properties as $property)
            <div class="col-md-4">
             <a href="/property/{{$property->id}}" >
                <div class="card property_list">
                    <div class="property_image">

                       @foreach($property->property_gallery as $key =>$g)
                             {{--$g--}}
                             @if($key==0)
                         <img  class="img-thumbnail" src="{{asset(@$g->name)}}" alt="" title="" style=" flex-shrink: 0; width: 100%;height: 200px; object-fit: cover;"/>
                             @endif
                         
                       @endforeach

                       {{-- 
                          <img src="{{ asset($property->image) }}" alt="" title="" />
                       <img  src="" alt="{{$property->title->name}}"
                         > --}}
                    
                    </div>
                    <div class="body">
                        <div class="property-content">
                            <div class="detail">
                                 <h5 class="text-success m-t-0 m-b-0"> {{ $property->currency->name }} {{number_format($property->price,0)  }}</h5>
                                <h4 class="m-t-0">{{ @$property->title->name }}</h4>
                                <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i>{{@$property->property_location->region->name}},{{@$property->property_location->name}},Tanzania</p>
                                {{-- <p class="text-muted m-b-0">{{ $property->description }}</p>  --}}
                            </div>

                       {{--

                           @if(@$property->type->sub_category->id==6 ||@$property->type->sub_category->id==1 )
                               <div class="d-flex justify-content-between">
                              <div class="p-2">
                                <a href="#" title="Square Feet"><i class="zmdi zmdi-view-dashboard"></i><span>{{@$property->property_area->value  }}</span></a>
                              </div>
                              <div class="p-2">
                               <a href="#" title="Bedroom"><i class="zmdi zmdi-hotel"></i><span>{{@$property->bead_room->value }}</span></a>
                              </div>
                              <div class="p-2"> <a href="#" title="Parking space"><i class="zmdi zmdi-car-taxi"></i><span>{{@$property->bead_room->value  }}</span></a></div>
                              <div class="p-2"><a href="#" title="Garages"><i class="zmdi zmdi-home"></i><span>{{ @$property->bead_room->value  }}</span></a></div>
                            </div>
                             @else

                            @endif
                       --}}
                         
                        </div>
                       
                    </div>
                </div>
                </a>
               </div> 
          @endforeach

 </div>
       {{-- @if ($properties->hasMorePages())
                    
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
         @endif --}}
 </div>
