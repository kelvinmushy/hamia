<div class="col-md-4">
    <div class="card shadow-sm" style="border-radius: 8px;">
        <div class="card-body">
            <!-- User Info (Image and Name on Left) -->
            <div class="row align-items-center">
                <div class="col-auto">
                    <img 
                        src="{{ url(isset(auth()->user()->image) ? auth()->user()->image : 'images/noimage.jpg') }}" 
                        alt="{{ auth()->user()->name }}" 
                        class="img-fluid rounded-circle" 
                        style="height: 120px; width: 120px; object-fit: cover; border: 3px solid #ddd;">
                </div>
                <div class="col">
                    <span class="h4 font-weight-bold">{{ auth()->user()->name }}</span><br>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>
            <hr>

            <!-- Sidebar Menu with Dynamic Spacing -->
            <div class="sidebar-menu">
                <div class="sidebar-item">
                    <a href="{{ route('agent.properties.index') }}" class="text-dark">
                        <i class="fa fa-calendar"></i> My Advertisements
                    </a>
                </div>
                <hr>
                <div class="sidebar-item">
                    <a href="{{ route('agent.social') }}" class="text-dark">
                        <i class="fa fa-share-alt"></i> Social Media
                    </a>
                </div>
                <hr>
                <div class="sidebar-item">
                    <a href="{{ route('agent.message') }}" class="text-dark">
                        <i class="fa fa-envelope"></i> Messages
                    </a>
                </div>
                <hr>
                <div class="sidebar-item">
                    <a href="{{ route('agent.profile') }}" class="text-dark">
                        <i class="fa fa-user"></i> Profile
                    </a>
                </div>
                <hr>
                <div class="sidebar-item">
                    <a href="{{ route('agent.changepassword') }}" class="text-dark">
                        <i class="fa fa-key"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
