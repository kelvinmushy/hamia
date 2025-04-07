<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
        @include('frontend.partials.agentSidebar')
    </div>

    <!-- Main Content -->
    <div class="col-md-9">
        <section>
            <div class="row">
                @foreach($company as $company)
                    <div class="col-md-6">
                        <div class="card company-card shadow-lg">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <!-- Company Image -->
                                    <div class="company-image">
                                        <a href="{{ route('agents.show', ['name' => $company->name, 'id' => $company->id]) }}" class="text-dark">
                                            <img src="{{ url($company->logo ?? 'images/noimage.png') }}" 
                                                 alt="{{ $company->name }}" 
                                                 class="img-fluid rounded-circle" 
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        </a>
                                    </div>

                                    <!-- Company Details -->
                                    <div class="ms-3">
                                        <h5 class="mb-1">
                                            <a href="{{ route('agents.show', ['name' => $company->name, 'id' => $company->id]) }}" class="text-dark">
                                                {{ $company->name }}
                                            </a>
                                        </h5>
                                        <p class="mb-1 text-muted">
                                            <i class="fa fa-map-marker-alt"></i>
                                            {{ $company->location->sub_location ?? 'Location Not Available' }}
                                        </p>
                                        <p class="mb-0 text-muted">
                                            <i class="fa fa-phone"></i>
                                            {{ $company->phone_number ?? 'Not Available' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Company Statistics -->
                                <div class="company-stats mt-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-center">
                                            <h6 class="mb-0">{{ $company->property->count() }}</h6>
                                            <p class="small text-muted">Properties Sold</p>
                                        </div>
                                        <div class="text-center">
                                            <h6 class="mb-0">{{ $company->property->count() }}</h6>
                                            <p class="small text-muted">Properties Rented</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Load More / No More agent -->
        <div class="row">
            {{-- Uncomment if you want to use Load More functionality --}}
            {{-- <div class="col-md-12 text-center">
                @if ($company->hasMorePages())
                    <button wire:click="loadMore()" class="btn btn-primary btn-lg shadow-sm">
                        Load More
                    </button>
                @else
                    <button class="btn btn-danger btn-lg shadow-sm" disabled>
                        No More agent
                    </button>
                @endif
            </div> --}}
        </div>
    </div>
</div>
