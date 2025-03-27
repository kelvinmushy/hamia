<div class="row">
  <!-- Sidebar -->
  <div class="col-md-3">
      @include('frontend.partials.agentSidebar')
  </div>

  <!-- Main Content -->
  <div class="col-md-9">
      <section>
          <div class="row">
              @foreach($agents as $agent)
                  <div class="col-md-6">
                      <div class="card agent-card">
                          <div class="card-body p-4">
                              <div class="d-flex align-items-center">
                                  <!-- Agent Image -->
                                  <div class="agent-image">
                                      <a href="{{ route('agents.show', ['username' => str_slug($agent->username), 'id' => $agent->id]) }}">
                                          <img src="{{ url($agent->image ?? 'images/noimage.png') }}" 
                                               alt="{{ $agent->username }}" 
                                               class="img-fluid">
                                      </a>
                                  </div>

                                  <!-- Agent Details -->
                                  <div class="ms-3">
                                      <h5 class="mb-1">
                                          <a href="{{ route('agents.show', ['username' => $agent->username, 'id' => $agent->id]) }}" class="text-dark">
                                              {{ $agent->name }}
                                          </a>
                                      </h5>
                                      
                                      <p class="mb-1 text-muted">
                                          <i class="fa fa-map-marker-alt"></i>
                                          {{ $agent->user_location->sub_location ?? 'Location Not Available' }}
                                      </p>

                                      <p class="mb-0 text-muted">
                                          <i class="fa fa-phone"></i>
                                          {{ $agent->phone_number ?? 'Not Available' }}
                                      </p>
                                  </div>
                              </div>
                                   <!-- Agent Statistics -->
                          <div class="agent-stats mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="text-center">
                                    <h6 class="mb-0">15</h6>
                                    <p class="small text-muted">Properties Sold</p>
                                </div>
                                <div class="text-center">
                                    <h6 class="mb-0">8</h6>
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

      <!-- Load More / No More Agents -->
      <div class="row">
          <div class="col-md-12 text-center">
              @if ($agents->hasMorePages())
                  <button wire:click="loadMore()" class="btn btn-primary btn-lg shadow-sm">
                      Load More
                  </button>
              @else
                  <button class="btn btn-danger btn-lg shadow-sm" disabled>
                      No More Agents
                  </button>
              @endif
          </div>
      </div>
  </div>
</div>


