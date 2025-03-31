@extends('backend.agent.app')

@section('top')
<style>
    /* Improved Dashboard Styling */
    .agent-dashboard {
        background-color: #f8f9fa;
        min-height: 100vh;
    }
    
    .agent-title {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eaeaea;
    }
    
    .sidebar-item a {
        color: #34495e;
        font-weight: 500;
        padding: 10px 15px;
        border-radius: 4px;
        transition: all 0.3s ease;
        display: block;
    }
    
    .sidebar-item a:hover {
        color: #fff;
        background-color: #3498db;
        text-decoration: none;
    }
    
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        border: none;
    }
    
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-weight: 600;
        padding: 15px 20px;
    }
    
    .table {
        width: 100%;
    }
    
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        padding: 8px 20px;
        font-weight: 500;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    
    .form-control {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 10px 15px;
        height: auto;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    /* Action Links */
    .action-link {
        color: #3498db;
        margin: 0 5px;
        transition: all 0.2s;
    }
    
    .action-link:hover {
        text-decoration: none;
        color: #2980b9;
    }
    
    .action-link.delete {
        color: #e74c3c;
    }
    
    .action-link.delete:hover {
        color: #c0392b;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            margin-top: 15px;
        }
        
        .agent-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="agent-dashboard">
    <div class="container" style="margin-top:30px;">
        <h4 class="agent-title">DASHBOARD</h4>
        <div class="row">
            @include('agent.sidebar')
            
            <div class="col-md-8">
                <!-- Social Media Form Card -->
                <div class="card">
                    <div class="card-header">
                        Social Media Links
                    </div>
                    <div class="card-body">
                        <form action="/agent/social/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Social Media</label>
                                        <select class="form-control" id="social_media_id" name="social_media_id" required>
                                            <option value="">-- Select Social Media --</option>
                                            @foreach($social as $media)
                                                <option value="{{$media->id}}">{{$media->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Social Media URL/Link</label>
                                        <input type="url" name="social_link" id="social-link" class="form-control" 
                                               required placeholder="https://www.facebook.com/yourprofile" 
                                               pattern="https?://.+">
                                        <small class="form-text text-muted">Please enter a valid URL including http:// or https://</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Social Media List Card -->
                <div class="card">
                    <div class="card-header">
                        Your Social Media Links
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Social Platform</th>
                                        <th>URL</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_social as $social)
                                    <tr>
                                        <td>
                                            <i class="fa fa-{{ strtolower($social->social_media->name) }} mr-2"></i>
                                            {{$social->social_media->name}}
                                        </td>
                                        <td>
                                            <a href="{{$social->url}}" target="_blank" class="text-truncate" style="max-width: 150px; display: inline-block;">
                                                {{ Str::limit($social->url, 30) }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{$social->url}}" target="_blank" class="action-link" title="View">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <a href="/agent/social/delete/{{$social->id}}" class="action-link delete" title="Delete" onclick="return confirm('Are you sure you want to delete this link?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // Add confirmation for delete actions
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('.delete');
        
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if(!confirm('Are you sure you want to delete this social link?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection