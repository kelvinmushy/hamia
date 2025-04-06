<div class="col-md-4">
    <div class="card shadow-lg rounded-4">
        <div class="card-body p-4">
            <!-- User Info (Image and Name on Left) -->
            <div class="row align-items-center mb-4">
                <div class="col-auto">
                    <img src="{{ url(isset(auth()->user()->company->logo) ? auth()->user()->company->logo : 'images/noimage.jpg') }}"
                        alt="{{ auth()->user()->company->name }}" class="img-fluid rounded-circle"
                        style="height: 100px; width: 100px; object-fit: cover; border: 3px solid #ddd;">
                </div>
                <div class="col">
                    <span class="h5 text-dark font-weight-bold">{{ auth()->user()->name }}</span><br>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>

            <!-- Sidebar Menu with Dynamic Spacing -->
            <div class="sidebar-menu">
                @if(auth()->user()->company)
                    <!-- Sidebar Item 1: My Advertisements -->
                    <div class="sidebar-item mb-2">
                        <a href="{{ route('agent.properties.index') }}" class="d-flex align-items-center text-dark">
                            <i class="fa fa-calendar me-2"></i>
                            <span>My Advertisements</span>
                        </a>
                    </div>

                    <!-- Sidebar Item 2: Project/Mradi with Submenu -->
                    <div class="sidebar-item mb-2">
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="collapse"
                            data-bs-target="#submenu1" aria-expanded="false" aria-controls="submenu1">
                            <i class="fa fa-cogs me-2"></i>
                            <span>Project/Mradi</span>
                        </a>
                        <div id="submenu1" class="collapse">
                            <a class="nav-link ps-4" href="#">Manage Project/Mradi</a>
                            <a class="nav-link ps-4" href="#">Privacy</a>
                            <a class="nav-link ps-4" href="#">Security</a>
                        </div>
                    </div>
                    <!-- Sidebar Item 4: Tenant Management with Submenu -->
                    <div class="sidebar-item mb-2">
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="collapse"
                            data-bs-target="#submenuTenant" aria-expanded="false" aria-controls="submenuTenant">
                            <i class="fa fa-building me-2"></i>
                            <span>Tenant Management</span>
                        </a>
                        <div id="submenuTenant" class="collapse">
                            {{-- <a class="nav-link ps-4" href="{{ route('tenants.index') }}">All Tenants</a>
                            <a class="nav-link ps-4" href="{{ route('tenants.create') }}">Add New Tenant</a> --}}
                            <a class="nav-link ps-4" href="#">Lease Agreements</a>
                            <a class="nav-link ps-4" href="#">Rent Collection</a>
                            <a class="nav-link ps-4" href="{{ route('agent.units.index') }}">Manage Units</a>
                        </div>
                    </div>

                    <!-- Sidebar Item 3: Customer/Client with Submenu -->
                    <div class="sidebar-item mb-2">
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="collapse"
                            data-bs-target="#submenu2" aria-expanded="false" aria-controls="submenu2">
                            <i class="fa fa-users me-2"></i>
                            <span>Customer/Client</span>
                        </a>
                        <div id="submenu2" class="collapse">
                            <a class="nav-link ps-4" href="#">Manage Customer</a>
                            <a class="nav-link ps-4" href="#">Privacy</a>
                            <a class="nav-link ps-4" href="#">Security</a>
                        </div>
                    </div>

                    {{-- <!-- Sidebar Item 4: Tenate with Submenu -->
                    <div class="sidebar-item mb-2">
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="collapse"
                            data-bs-target="#submenu3" aria-expanded="false" aria-controls="submenu3">
                            <i class="fa fa-building me-2"></i>
                            <span>Tenate</span>
                        </a>
                        <div id="submenu3" class="collapse">
                            <a class="nav-link ps-4" href="#">Manage Tenate</a>
                            <a class="nav-link ps-4" href="#">Privacy</a>
                            <a class="nav-link ps-4" href="#">Security</a>
                        </div>
                    </div> --}}

                    <!-- Sidebar Item 5: Social Media -->
                    <div class="sidebar-item mb-2">
                        <a href="{{ route('agent.social') }}" class="d-flex align-items-center text-dark">
                            <i class="fa fa-share-alt me-2"></i>
                            <span>Social Media</span>
                        </a>
                    </div>

                    <!-- Sidebar Item 6: Messages -->
                    <div class="sidebar-item mb-2">
                        <a href="{{ route('agent.message') }}" class="d-flex align-items-center text-dark">
                            <i class="fa fa-envelope me-2"></i>
                            <span>Messages</span>
                        </a>
                    </div>

                    <!-- Sidebar Item 7: Profile -->

                    <!-- Sidebar Item 7: Profile -->
                    <div class="sidebar-item mb-2">
                        <a href="{{ route('agent.company.edit', auth()->user()->company->id) }}"
                            class="d-flex align-items-center text-dark">
                            <i class="fa fa-user me-2"></i>
                            <span>Profile</span>
                        </a>
                    </div>
                @endif


                <!-- Sidebar Item 8: Change Password -->
                <div class="sidebar-item mb-2">
                    <a href="{{ route('agent.changepassword') }}" class="d-flex align-items-center text-dark">
                        <i class="fa fa-key me-2"></i>
                        <span>Change Password</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>