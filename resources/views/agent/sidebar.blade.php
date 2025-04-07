<div class="col-md-4">
    <div class="card rounded-4 shadow-lg">
        <div class="card-body p-4">
            <!-- User Info -->
            <div class="row align-items-center mb-4">
                <div class="col-auto">
                    <img src="{{ url(isset(auth()->user()->company->logo) ? auth()->user()->company->logo : 'images/noimage.jpg') }}"
                        alt="{{ auth()->user()->company->name }}"
                        class="img-fluid rounded-circle"
                        style="height: 100px; width: 100px; object-fit: cover; border: 3px solid #ddd;">
                </div>
                <div class="col">
                    <span class="h5 text-dark fw-bold">{{ auth()->user()->name }}</span><br>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <div class="sidebar-menu">
                @if(auth()->user()->company)

                    @php
                        $accountRoutes = ['agent.company.edit', 'agent.changepassword', 'agent.social'];
                        $projectRoutes = ['agent.projects.index'];
                        $clientRoutes = ['clients.manage', 'clients.privacy', 'clients.security'];
                    @endphp

                    <!-- My Advertisements -->
                    <div class="sidebar-item mb-2">
                        <a href="{{ route('agent.properties.index') }}"
                            class="nav-link d-flex align-items-center rounded px-3 py-2 {{ request()->routeIs('agent.properties.index') ? 'fw-bold text-primary bg-light' : 'text-dark' }}">
                            <i class="fa fa-calendar me-2"></i>
                            <span>My Advertisements</span>
                        </a>
                    </div>

                    <!-- Customer/Client -->
                    @php $isClientActive = in_array(Route::currentRouteName(), $clientRoutes); @endphp
                    <div class="sidebar-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded px-3 py-2 {{ $isClientActive ? 'text-primary bg-light' : 'text-dark collapsed' }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#submenuClient"
                            aria-expanded="{{ $isClientActive ? 'true' : 'false' }}" aria-controls="submenuClient">
                            <i class="fa fa-users me-2"></i>
                            <span>Customer/Client</span>
                        </a>
                        <div id="submenuClient" class="collapse {{ $isClientActive ? 'show' : '' }}">
                            <a class="nav-link ps-4 {{ Route::is('clients.manage') ? 'fw-bold text-primary' : 'text-dark' }}"
                                href="#">Manage Customer</a>
                            <a class="nav-link ps-4 {{ Route::is('clients.privacy') ? 'fw-bold text-primary' : 'text-dark' }}"
                                href="#">Privacy</a>
                            <a class="nav-link ps-4 {{ Route::is('clients.security') ? 'fw-bold text-primary' : 'text-dark' }}"
                                href="#">Security</a>
                        </div>
                    </div>

                    <!-- Project/Mradi -->
                    @php $isProjectActive = in_array(Route::currentRouteName(), $projectRoutes); @endphp
                    <div class="sidebar-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded px-3 py-2 {{ $isProjectActive ? 'text-primary bg-light' : 'text-dark collapsed' }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#submenuProject"
                            aria-expanded="{{ $isProjectActive ? 'true' : 'false' }}" aria-controls="submenuProject">
                            <i class="fa fa-cogs me-2"></i>
                            <span>Project/Mradi</span>
                        </a>
                        <div id="submenuProject" class="collapse {{ $isProjectActive ? 'show' : '' }}">
                            <a class="nav-link ps-4 {{ Route::is('agent.projects.index') ? 'fw-bold text-primary' : 'text-dark' }}"
                                href="/agent/projects">Manage Project/Mradi</a>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="sidebar-item mb-2">
                        <a href="{{ route('agent.message') }}"
                            class="nav-link d-flex align-items-center rounded px-3 py-2 {{ request()->routeIs('agent.message') ? 'fw-bold text-primary bg-light' : 'text-dark' }}">
                            <i class="fa fa-envelope me-2"></i>
                            <span>Messages</span>
                        </a>
                    </div>

                    <!-- Account Settings -->
                    @php $isAccountActive = in_array(Route::currentRouteName(), $accountRoutes); @endphp
                    <div class="sidebar-item mb-2">
                        <a class="nav-link d-flex align-items-center rounded px-3 py-2 {{ $isAccountActive ? 'text-primary bg-light' : 'text-dark collapsed' }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#submenuProfile"
                            aria-expanded="{{ $isAccountActive ? 'true' : 'false' }}" aria-controls="submenuProfile">
                            <i class="fa fa-user-circle me-2"></i>
                            <span>Account Settings</span>
                        </a>
                        <div id="submenuProfile" class="collapse {{ $isAccountActive ? 'show' : '' }}">
                            <a class="nav-link ps-4 d-flex align-items-center {{ Route::is('agent.company.edit') ? 'fw-bold text-primary' : 'text-dark' }}"
                                href="{{ route('agent.company.edit', auth()->user()->company->id) }}">
                                <i class="fa fa-user me-2"></i> Profile
                            </a>
                            <a class="nav-link ps-4 d-flex align-items-center {{ Route::is('agent.social') ? 'fw-bold text-primary' : 'text-dark' }}"
                                href="{{ route('agent.social') }}">
                                <i class="fa fa-share-alt me-2"></i> Social Media
                            </a>
                            <a class="nav-link ps-4 d-flex align-items-center {{ Route::is('agent.changepassword') ? 'fw-bold text-primary' : 'text-dark' }}"
                                href="{{ route('agent.changepassword') }}">
                                <i class="fa fa-key me-2"></i> Change Password
                            </a>
                        </div>
                    </div>
                @endif

                <hr>

                <!-- Logout -->
                <div class="sidebar-item mb-2">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link text-danger d-flex align-items-center rounded px-3 py-2">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
