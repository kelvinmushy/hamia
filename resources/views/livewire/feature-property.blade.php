<div class="row">
  <!-- Sidebar Section -->
  <div class="col-md-3">
      @include('frontend.partials.sidebar')
  </div>

  <!-- Main Content Section -->
  <div class="col-md-9">
      <!-- Offline Alert -->
      <p class="alert alert-warning text-center" wire:offline>
          ⚠ Whoops! Your device has lost connection. You are currently offline.
      </p>

      <!-- Property Listings Title -->
      <h4 class="mb-2"><b>🏡 Properties in Tanzania</b></h4>

      <div class="row" style="margin-top: 0;"> <!-- Directly setting margin-top to 0 -->
          <!-- Loop through Properties -->
          @foreach($properties as $property)
              <div class="col-lg-3 col-md-4 col-sm-6 px-1 py-1" style="margin-top: 0;"> <!-- Reduced margin-top for individual cards -->
                  <div class="card shadow-sm border-0 rounded-4 overflow-hidden property-card">
                      <a href="/property/{{ str_slug($property->property_location->name) }}/{{$property->sub_category->slug}}/{{ str_slug($property->title) }}/{{$property->id }}" class="text-decoration-none">
                          
                          <!-- Property Image -->
                          <div class="property-image" style="background-image: url('{{ asset('images/agent/03122323145665865a5ea3215_74ca9ad50147d6b022ac7135dbfa366b.jpeg') }}');"></div>
                          
                          <img src="{{ asset('images/agent/03122323145665865a5ea3215_74ca9ad50147d6b022ac7135dbfa366b.jpeg') }}" 
                               alt="Property Image" class="img-fluid property-img">

                          <div class="card-body p-2 text-dark">
                            <h6 class="card-title mb-1 text-truncate" style="font-size: 14px; text-transform: capitalize;">
                                {{ Str::limit(ucwords($property->title), 20) }}
                              </h6>
                               
                            <p class="card-text text-muted small mb-1">
                                  <b>{{ Str::title($property->currency->name) }} {{ number_format($property->price, 0) }}</b> 
                                  per {{ @$property->property_term->term->name }}
                              </p>
                              <p class="card-text text-muted small mb-0">
                                  <i class="fas fa-images"></i> {{ @$property->property_gallery->count() }} images
                              </p>
                          </div>
                      </a>
                  </div>
              </div>
          @endforeach
      </div>

      <!-- Pagination / Load More Section -->
      @if ($properties->hasMorePages())
          <div class="col-md-12 text-center mt-2">
              <button wire:click="loadMore()" class="btn btn-primary shadow-sm px-4 py-2">
                  Load More Properties
              </button>
          </div>
      @else
          <div class="col-md-12 text-center mt-2">
              <button class="btn btn-secondary shadow-sm px-4 py-2" disabled>
                  No More Properties
              </button>
          </div>
      @endif
  </div>
</div>

<!-- Custom Styles -->
<style>
.property-card {
  transition: transform 0.3s ease-in-out;
  border-radius: 15px; /* Increased border-radius */
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.12); /* Soft shadow */
  overflow: hidden; /* Ensures images stay within border-radius */
}
.property-card:hover {
  transform: translateY(-3px);
  box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2); /* Stronger hover shadow */
}
.property-image {
  height: 200px; /* Increased image height */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}
.property-img {
  width: 100%;
  height: 200px; /* Match the background-image div */
  object-fit: cover; /* Ensures the image fills the space without distortion */
  border-radius: 15px 15px 0 0; /* Matches card's border-radius */
}
.text-truncate {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
