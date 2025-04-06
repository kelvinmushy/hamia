@extends('backend.agent.app')

@section('top')
<style>
    /* Modern Dashboard Styling with Consistent Fonts */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
    }
    
    .agent-dashboard {
        background-color: #f8f9fa;
        min-height: 100vh;
    }
    
    .agent-title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eaeaea;
    }
    
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        border: none;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .card-body {
        padding: 25px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 10px 15px;
        height: auto;
        font-size: 14px;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    .btn-primary {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #3498db;
        border-color: #3498db;
        padding: 10px 25px;
        font-weight: 500;
        font-size: 14px;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    
    select.form-control {
        height: 42px;
    }
    
    h4 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    
    hr {
        border-top: 1px solid #eee;
        margin: 20px 0;
    }
    
    /* Select2 styling to match our font */
    .select2-container .select2-selection--single {
        height: 42px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 42px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            margin-top: 15px;
        }
        
        .agent-title {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 15px;
        }
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="agent-dashboard">
    <div class="container" style="margin-top:30px;">
        <h4 class="agent-title">DASHBOARD</h4>
        <div class="row">
            @include('agent.sidebar')
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="agent-title">PROFILE</h4>

                        <form action="{{route('agent.profile.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" name="name" type="text" value="{{ $profile->name }}" class="form-control" required>
                                    </div>
                                </div>
                               
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="email" value="{{ $profile->email }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input id="phone_number" name="phone_number" type="tel" value="{{@$profile->phone_number}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Profile Image</label>
                                        <input type="file" name="image" class="form-control-file">
                                        @if($profile->image)
                                            <small class="text-muted">Current image will be replaced</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about">About</label>
                                        <textarea id="about" name="about" class="form-control" rows="4">{{@$profile->about}}</textarea>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Location</h4>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="region_id">Region</label>
                                        <select class="form-control select_region" name="region_id" required id="region_id" style="width:100%">
                                            <option value="">Select Region</option>
                                            @foreach($region as $region)
                                                <option value="{{$region->id}}" {{ $profile->location && $profile->location->district->region_id == $region->id ? 'selected' : '' }}>
                                                    {{$region->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="district_id">District</label>
                                        <select class="form-control select_district" name="district_id" id="district_id" required style="width:100%">
                                            <option value="">Select District</option>
                                            @foreach($district as $district)
                                                <option value="{{$district->id}}" {{ $profile->location && $profile->location->district_id == $district->id ? 'selected' : '' }}>
                                                    {{$district->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sub_location">Sub Location</label>
                                        <input type="text" name="sub_location" id="sub_location" class="form-control" 
                                               value="{{ $profile->location ? $profile->location->sub_location : '' }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-save"></i> Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bot')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // Initialize Select2
    $(".select_district").select2({
        placeholder: 'Select District',
        allowClear: true
    });
    
    $(".select_region").select2({
        placeholder: 'Select Region',
        allowClear: true
    });

    // Region change handler
    $('.select_region').on('change', function(){
        var id = $(this).val();
        if(id) {
            $.ajax({
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                url: '/agent/region/district',
                success: function(html) {
                    $('select[name="district_id"]').empty();
                    $('select[name="district_id"]').append('<option value="">Select District</option>');
                    $.each(html.data, function(key, value) {
                        $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        } else {
            $('select[name="district_id"]').empty();
            $('select[name="district_id"]').append('<option value="">Select District</option>');
        }
    });
    
    // Phone number input formatting
    $('#phone_number').on('input', function() {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });
});
</script>
@endsection