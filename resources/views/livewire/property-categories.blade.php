
 <div class="row" >
        <div class="col-md-3">
        @include('frontend.partials.sidebar')
        </div>
        <div class="col-md-9" >
         
         <p class="alert alert-warning" wire:offline>
        Whoops, your device has lost connection. The web page you are viewing is offline.
        </p>
         
         {{-- @include('frontend.partials.property_type') --}}
       
     <p><b>{{ $properties[0]->sub_category->name}} </b></p>
         <div class="row" >
{{--          
            @include('frontend.agent_horizoontal') --}}
  @foreach($properties as $property)
      
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
@if ($properties->hasMorePages())
     <div class="col-md-12 text-center justify-content-center">
      <div x-intersect.full="$wire.loadMore()" class="p-4">
      <div wire:loading wire:target="loadMore" class="loading-indicator">
      
          <button wire:click="loadMore()" class="btn btn-primary btn-lg shadow-sm">
           More...</button> 
      
      </div>
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

