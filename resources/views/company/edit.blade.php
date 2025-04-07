@extends('backend.agent.app')

@section('top')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        border: none;
    }
</style>
@endsection

@section('content')
<div class="container" style="margin-top:30px;">
    <h4 class="agent-title">Edit Company</h4>
    <div class="row">
        @include('agent.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="agent-title">Update Company Information</h4>

                    <form id="editCompanyForm" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                    
                        <!-- Company Name -->
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input id="company_name" name="name" type="text" class="form-control" value="{{ $company->name }}" required>
                        </div>
                    
                        <!-- Region Dropdown -->
                        <div class="form-group">
                            <label for="region_id">Region</label>
                            <select class="form-control select_region" name="region_id" required id="region_id">
                                <option value="">Select Region</option>
                                @foreach($region as $region)
                                    <option value="{{ $region->id }}" {{ $region->id == $company->location->district->region_id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- District Dropdown -->
                        <div class="form-group">
                            <label for="district_id">District</label>
                            <select class="form-control select_district" name="district_id" id="district_id" required>
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" {{ $district->id == $company->location->district_id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" name="sub_location" type="text" class="form-control" value="{{ $company->location->sub_location }}" required>
                        </div>
                    
                        <!-- Phone Number -->
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input id="phone_number" name="phone_number" type="text" class="form-control" value="{{ $company->phone_number }}" required>
                        </div>
                    
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ $company->email }}" required>
                        </div>
                    
                        <!-- About Textarea -->
                        <div class="form-group">
                            <label for="about">About Company</label>
                            <textarea id="about" name="about" class="form-control" rows="5" placeholder="Write something about the company...">{{ $company->about }}</textarea>
                        </div>
                    
                        <!-- Logo Upload -->
                        <div class="form-group">
                            <label for="logo">Company Logo</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                    
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-save"></i> Update Company
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bot')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function(){
    // Initialize Select2
    $(".select_region, .select_district").select2({
        placeholder: "Select an option",
        allowClear: true
    });

      // Fetch Districts Based on Region Selection
      $('.select_region').on('change', function () {
                var regionId = $(this).val();
                if (regionId) {
                    $.ajax({
                        type: 'GET',
                        url: '/agent/region/district',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: regionId
                        },
                        success: function (response) {
                            $('select[name="district_id"]').empty().append('<option value="">Select District</option>');
                            $.each(response.data, function (key, value) {
                                $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function (error) {
                            console.log('Error:', error);
                        }
                    });
                } else {
                    $('select[name="district_id"]').empty().append('<option value="">Select District</option>');
                }
            });

    // Phone Number Formatting
    $('#phone_number').on('input', function() {
        let value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        if (!value.startsWith('225')) {
            value = '225';
        }
        if (value.length > 12) {
            value = value.substring(0, 12);
        }
        this.value = value;
    });

    // Submit form via AJAX
    $('#editCompanyForm').on('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "/agent/profile",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            beforeSend: function() {
                $('.btn-primary').prop('disabled', true).text('Updating...');
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr) {
                alert('Error! ' + xhr.responseJSON.message);
            }
        });
    });
});
</script>
@endsection
