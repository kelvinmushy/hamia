 <div class="row">
     <div class="col-md-12">
         @include('frontend.partials.agentAdvanceSearch')
     </div>
 </div>
 <div class="row clearfix">
    @foreach($client_request as $request)
    <div class="col-md-4">
      <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
               <div class="flex-grow-1 ms-3" style="margin-left:5px">
                <h5 class="mb-1">{{@$request->fullname}}</h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;">I Need <span class="text text-info">{{$request->property_title}}</span></p>
                 <p class="mb-2 pb-1" style="color: #2b2a2a;">Price <span class="text text-info">{{number_format($request->property_price,0)}} Tsh</span></p>
                <div class="d-flex justify-content-start rounded-3 "
                  style="background-color: #efefef;">
                 <i class="fa fa-map-marker">
                     {{@$request->sub_location}},
                      {{@$request->districts->name}},
                      {{@$request->districts->region->name}}
                 </i>
                </div>
                <div class="d-flex pt-1">
                  <i class="fa fa-phone">  {{@$request->phone_number}} </i>
                </div>

              </div>
            </div>
          </div>
      </div>
        </div>
    @endforeach

 </div>

 @if ($client_request->hasMorePages())
                    
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
                 More Clients</button>
               </div>
             </div>
 @endif


 