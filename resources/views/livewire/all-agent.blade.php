<div>

<div class="row" style="margin-top:">
<div class="col-md-3">
    @include('frontend.partials.agentSidebar')
</div>
<div class="col-md-9">
<section>  
 <div class="row clearfix">
  @foreach($agents as $agent)
           {{-- <div class="col-md-4">
                <div class="card agent">
                    <div class="agent-avatar"> <a href="profile.html">
                         <img src="{{ url(isset($agent->image) ? $agent->image : 'images/gallery/userimage.jpg')  }}" alt="{{ $agent->username }}"  height="10px;">
                         </a> </div>
                    <div class="agent-content">
                        <div class="agent-name">
                            <h4><a href="{{ route('agents.show',$agent->id) }}" class="truncate">{{ $agent->name }}</a></h4>
                            
                            <span>{{@$agent->user_location->sub_location}},{{@$agent->user_location->district->name}},{{@$agent->user_location->district->region->name}},{{@$agent->user_location->district->region->country->name}}</span>
                           
                        </div>
                        <ul class="agent-contact-details">
                            <li><i class="zmdi zmdi-phone"></i><span>{{@$agent->phone_number}}</span></li>
                            <li><i class="zmdi zmdi-email"></i>{{ @$agent->email }}</li>
                        </ul>
                        <ul class="social-icons">
                              @foreach(@$agent->user_social_media as $social)
                                    
                                    <li><a title="{{$social->social_media->name}}" href="{{@$social->url}}"><i class="{{$social->social_media->icon}}"></i></a></li>
                                
                               
                            @endforeach    
                        </ul>
                    </div>
                </div>
            </div>--}}

            <div class="col-md-6">
           <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
              <div class="flex-shrink-0">
              
                @if(!empty($agent->image))
                  <a href="{{ route('agents.show',['username'=>str_slug($agent->username),'id'=>$agent->id]) }}" class="truncate">
                <img src="{{ url(isset($agent->image) ? $agent->image : 'images/noimage.png')  }}"
                  alt="{{ $agent->username }}" class="img-fluid"
                  style="width:90px; height:90px;border-radius: 50%;">
                 </a> 
                @else
                     <a href="{{ route('agents.show',['username'=>$agent->username,'id'=>$agent->id]) }}" class="truncate">
                <img src="images/noimage.png"
                  alt="{{ $agent->username }}" class="img-fluid"
                  style="width: 180px; height:180px;border-radius: 100%;">
                 </a>
                @endif
              
              </div>
              <div class="flex-grow-1 ms-3" style="margin:5px">
                <h5 class="mb-1"><a href="{{ route('agents.show',['username'=>$agent->username,'id'=>$agent->id]) }}" class="truncate">{{ $agent->name }}</a></h5>
                @if(@$agent->user_location->sub_location)
                 <i class="fa fa-map-marker">
                     {{@$agent->user_location->sub_location}},{{@$agent->user_location->district->name}},{{@$agent->user_location->district->region->name}},{{@$agent->user_location->district->region->country->name}}
                 </i>
                @else
                <i class="fa fa-map-marker">
                  Not Available
                </i>
                @endif
               
                   @if(@$agent->phone_number)
                    <div class="d-flex pt-1">
                     <i class="fa fa-phone"> {{@$agent->phone_number}}</i>
                   </div>
                   @else
                    <div class="d-flex pt-1">
                     <i class="fa fa-phone">Not Available</i>
                   </div>
                   @endif
                     {{-- <div class="d-flex  justify-content-start">
                     @foreach(@$agent->user_social_media as $social)
                    <div class="p-2">
                        <a title="{{$social->social_media->name}}" href="{{@$social->url}}"><i class="{{$social->social_media->icon}}"></i></a>
                    </div>
                     @endforeach 
                    </div> --}}
                 
              </div>
            </div>
          </div>
        </div>
            </div>
    @endforeach
    </div>
</section>
@if ($agents->hasMorePages())
                    
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
                 <button class="btn btn-danger btn-lg shadow-sm justify-content-center" style="margin:2px;">No
                 More Agents</button>
               </div>
             </div>
         @endif
</div>
</div>


{{--

<section class="vh-100" style="background-color: #9de2ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-md-9 col-lg-7 col-xl-5">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
              <div class="flex-shrink-0">
                 <a href="profile.html">
                <img src="{{ url(isset($agent->image) ? $agent->image : 'images/noimage.jpg')  }}"
                  alt="{{ $agent->username }}" class="img-fluid"
                  style="width: 180px; border-radius: 10px;">
                 </a> 
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">Danny McLoan</h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;">Senior Journalist</p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
                  <div>
                    <p class="small text-muted mb-1">Articles</p>
                    <p class="mb-0">{{$agent->totalAdd($agent->id)}}</p>
                  </div>
                  <div class="px-3">
                    <p class="small text-muted mb-1">Followers</p>
                    <p class="mb-0">976</p>
                  </div>
                  <div>
                    <p class="small text-muted mb-1">Rating</p>
                    <p class="mb-0">8.5</p>
                  </div>
                </div>
                <div class="d-flex pt-1">
                  <button type="button" class="btn btn-outline-primary me-1 flex-grow-1">Chat</button>
                  <button type="button" class="btn btn-primary flex-grow-1">Follow</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 --}}


</div>