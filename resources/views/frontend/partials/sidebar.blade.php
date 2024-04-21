<div >

<aside>
         <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card card-header" style="background-color:#FF7F50; ;color:#fff"><b>Property Categories</b></h5>
                    <div class="card card-body" style="margin-top:-40px">
                            {{-- <div class="col-sm-12">
                                <div class="form-group">
                                   <div wire:ignore>
                                  <select class="form-control"  id="selectPurpose" wire:model="purpose_id">
                                    
                                </select>
                                </div>
                                </div>
                            </div> --}}
                          <div class="center">
                                @if($slug=="all")
                                   <a><b>All Properties</b></a> ({{$all_property}})<br>
                                @else
                                 <a href="/" style="color:#000" >All Properties</a> ({{$all_property }})<br>
                                 
                                @endif
                             @foreach ($subCategory as $propertCategory)

                             @if($slug=="all")
                              
                                {{-- <a href="/{{@$propertCategory->slug}}" style="color:#000">
                                {{Str::limit(@$propertCategory->name,50)}} ({{ $propertCategory->properties->count() }})
                                </a><br> --}}
                                 @if ( $propertCategory->properties->count() ==0)
                                <a style="color:#000">
                                {{Str::limit(@$propertCategory->name,50)}}({{ $propertCategory->properties->count() }}) 
                                </a><br>
                               @else
                                 <a href="/{{@$propertCategory->slug}}" style="color:#000">
                                {{Str::limit(@$propertCategory->name,50)}}({{ $propertCategory->properties->count() }}) 
                                </a><br> 
                               @endif

                             @elseif($slug==$propertCategory->slug)
                                
                               <a href="/{{@$propertCategory->slug}}" style="color:#000">
                                 <b>{{Str::limit(@$propertCategory->name,50)}}</b>({{ $propertCategory->properties->count() }})
                                </a><br>
                              
                             @else
                               @if ( $propertCategory->properties->count() ==0)
                                <a style="color:#000">
                                {{Str::limit(@$propertCategory->name,50)}}({{ $propertCategory->properties->count() }}) 
                                </a><br>
                               @else
                                 <a href="/{{@$propertCategory->slug}}" style="color:#000">
                                {{Str::limit(@$propertCategory->name,50)}}({{ $propertCategory->properties->count() }}) 
                                </a><br> 
                               @endif
                              
                             @endif
                               

                            @endforeach
                          </div>

                                                       
                           
                        
                    </div>
                </div>
            </div>
           
        </div>

        {{-- d-none d-md-block --}}
<div class="row clearfix" style="margin-top:-20px" >
   <div class="col-md-12">
     <div class="card">
     
     <div class="card card-body">   
        <div class="form-group">


         <div wire:ignore>


        {{-- <select class="form-control"  id="city_id" wire:model.live="city_id">             
        </select>
         --}}
       <select wire:model.live="regionId" class="form-control">
                <option value="" selected>Choose state</option>
         @foreach($this->regions as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
         @endforeach

      </select>
        
        </div></div>
            @if ($this->districts->count()!=0)

          <div class="form-group">
            {{-- <select class="form-control"  id="district_id" wire:model.live="district_id">
             </select>
              --}}
               <div wire:ignore>
             <select class="form-control" wire:model.live="districtId">
                    <option value="" selected>Choose district</option>
                    @foreach($this->districts as $x)
                        <option value="{{ $x->id }}">{{ $x->name }}</option>
                    @endforeach
              </select> </div> 
                </div>
              @endif


            <div class="form-group m-t-5">
            <div wire:ignore>
            <input type="number" class="form-control" placeholder="From Price" name="from_price"  style="height:30px;border-radius:2px" min="0" wire:model.live="from_price">
             </div>
             </div>    
              <div class="form-group m-t-5">
             <div wire:ignore>
             <input type="number" class="form-control" placeholder="To Price" name="to_price"   style="height:30px;border-radius:2px" min="0" wire:model.live="to_price"> 
             </div>
            </div>             
      </div>
  </div>



@if($slug=="all")

@else
  <div class="row d-none d-md-block" style="margin-top:-20px" >
     <div class="col-md-12" >
    
     <div class="card">
            <div class="header">
        <h2><strong>Furnishing</strong></h2>
        </div>
          <div class="card card-body" style="margin-top:-21px;"> 
            @foreach ($furnish as $furnish)
             
                    <div class="form-check">
                    <label class="form-check-label">
                       @if($furnish->propertyFurnish->count()>0)
                        @if($slug=="all")
                       <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id">
                        {{$furnish->name}} ({{$furnish->propertyFurnish->count()}})
                        @else
                          @if($furnish->propertyFurnishCount($slug,$furnish->id)>0)
                              <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id">
                              {{$furnish->name}} ({{$furnish->propertyFurnishCount($slug,$furnish->id) }})
                          @else
                             <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id" disabled>
                             {{$furnish->name}} ({{$furnish->propertyFurnishCount($slug,$furnish->id) }})
                          @endif
                       
                        @endif
                     
                    
                      @else
                    <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id" disabled>
                     {{$furnish->name}} ({{$furnish->propertyfurnish->count()}})
                      @endif
                     </label>
                </div>
               

       @endforeach
         </div>

     </div> 
     </div>
     </div>


 <div class="row clearfix d-none d-md-block" style="margin-top:-23px;" >
     <div class="col-md-12">
     <div class="card" >
       <div class="header">
        <h2><strong>Condition</strong></h2>
        </div>
      
        
        <div class="card-body" style="margin-top:-21px;"> 
            @foreach ($condition as $condition)
             
                    <div class="form-check">
                    <label class="form-check-label">
                       @if($condition->propertyCondition->count()>0)
                        @if($slug=="all")
                       <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id">
                        {{$condition->name}} ({{$condition->propertyCondition->count()}})
                        @else
                          @if($condition->propertyConditionCount($slug,$condition->id)>0)
                              <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id">
                              {{$condition->name}} ({{$condition->propertyConditionCount($slug,$condition->id) }})
                          @else
                             <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id" disabled>
                             {{$condition->name}} ({{$condition->propertyConditionCount($slug,$condition->id) }})
                          @endif
                       
                        @endif
                     
                    
                      @else
                    <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id" disabled>
                     {{$condition->name}} ({{$condition->propertyCondition->count()}})
                      @endif
                     </label>
                </div>
               

       @endforeach
      </div>
      
     </div>
     </div>
     </div> 
@endif
 

</div>


</aside>



</div>


