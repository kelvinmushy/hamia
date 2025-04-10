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
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden property-card position-relative">
                        <?php $x = $property->image; ?>
                        <a href="/property/{{ str_slug($property->property_location->name) }}/{{$property->sub_category->slug}}/{{ str_slug($property->title) }}/{{$property->id }}" class="text-decoration-none">
                            
                            <!-- Property Image -->
                            <div class="property-image" style="background-image: url('{{ asset($x) }}'); height: 200px; background-size: cover; background-position: center;">
                                <!-- Overlay for Number of Images -->
                                <div class="property-count">
                                    <i class="fas fa-images"></i> {{ @$property->property_gallery->count() }}
                                </div>

                                <!-- Premium Badge -->
                                @if($property->featured==1) <!-- Assuming 'is_premium' is a boolean attribute -->
                                    <span class="badge bg-warning text-dark position-absolute" style="top: 10px; left: 10px;">
                                        Premium
                                    </span>
                                @endif
                            </div>
                        </a>
                        <div class="card-body p-2 text-dark">
                            <h6 class="card-title mb-1 text-truncate" style="font-size: 14px; text-transform: capitalize;">
                                {{ Str::limit(ucwords($property->title), 20) }}
                            </h6>
                            <p class="card-text text-muted small mb-1">
                                <b>{{ Str::title($property->currency->name) }} {{ number_format($property->price, 0) }}</b> 
                                per {{ @$property->property_term->term->name }}
                            </p>
                        </div>
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
