 
 <div class="row">
        <div class="col-md-3">
        @include('frontend.partials.sidebar')
        </div>
        <div class="col-md-9" >
         
       
         
         @include('frontend.partials.property_type')
       
       
         <div class="row" >
{{--          
            @include('frontend.agent_horizoontal') --}}
  @foreach($properties as $property)

           
    <div class="b-listing-cards__item">
    <div class="fw-card qa-fw-card b-trending-card h-height-100p">
    <a href="/kiomoni/houses-apartments-for-rent/4bdrm-villa-in-kiomoni-for-rent-5OCLyyErqIQPWKhEeSptxhMj.html?page=1&amp;pos=8&amp;cur_pos=8&amp;ads_per_page=20&amp;ads_count=20&amp;lid=r-mk58cgbMz0wRrm2A" class="">
       <div class="fw-card-media qa-fw-card-media" style="background-color: rgb(255, 255, 255); background-image:
        url(&quot;https://pictures-tanzania.jijistatic.com/4655066_MzAwLTIyNi0yNjVmODBkNzA0.jpg&quot;);">
      {{-- <div class="b-trending-card__boosted-label h-flex-center" style="color: rgb(255, 255, 255); background-color: rgb(0, 181, 63);">
        Enterprise
      </div>  --}}
      <div class="b-trending-card__counter">
        7
      </div>
      </div> 
      <div class="fw-card-content qa-fw-card-content"><div class="b-trending-card__title">
        4bdrm Villa in Kiomoni for rent
      </div> <div class="b-trending-card__price">
        TSh 10,400,000 per month
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
