@extends('backend.agent.app')

@section('top')
    <style>
        /* Modern Dashboard Styling */
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
        }

        .card-body {
            padding: 25px;
        }

        label {
            font-weight: 500;
            color: #2c3e50;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            height: auto;
            font-size: 14px;
        }

        .btn-primary {
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

        /* Select2 Styling */
        .select2-container .select2-selection--single {
            height: 42px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .agent-title {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 15px;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="agent-dashboard">
        <div class="container" style="margin-top:30px;">
            <h4 class="agent-title">Company Registration</h4>
            <div class="row">
                @include('agent.sidebar')

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="agent-title">Register Your Company</h4>

                            <form id="companyRegistrationForm" enctype="multipart/form-data">
                                @csrf
                                <!-- Company Name -->
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input id="company_name" name="name" type="text" class="form-control" required>
                                </div>

                                <!-- Region Dropdown -->
                                <div class="form-group">
                                    <label for="region_id">Region</label>
                                    <select class="form-control select_region" name="region_id" required id="region_id">
                                        <option value="">Select Region</option>
                                        @foreach($region as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- District Dropdown (Changes dynamically based on Region selection) -->
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select class="form-control select_district" name="district_id" id="district_id"
                                        required>
                                        <option value="">Select District</option>
                                    </select>
                                </div>

                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input id="address" name="sub_location" type="text" class="form-control" required>
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input id="phone_number" name="phone_number" type="text" class="form-control" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="email" class="form-control" required>
                                </div>

                                <!-- Logo Upload -->
                                <div class="form-group">
                                    <label for="logo">Company Logo</label>
                                    <input type="file" name="logo" class="form-control-file">
                                </div>

                                <button class="btn btn-primary w-100" type="submit">
                                    <i class="fa fa-save"></i> Register Company
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bot')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2
            $(".select_district, .select_region").select2({
                placeholder: 'Select an option',
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
            $('#phone_number').on('input', function () {
                let value = this.value.replace(/[^0-9]/g, '');
                if (!value.startsWith('225')) {
                    value = '225';
                }
                if (value.length > 12) {
                    value = value.substring(0, 12);
                }
                this.value = value;
            });

            $(document).ready(function () {
                $('#companyRegistrationForm').on('submit', function (event) {
                    event.preventDefault(); // Prevent default form submission

                    let formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('agent.company.store') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('.btn-primary').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                        },
                        success: function (response) {
                            $('.btn-primary').prop('disabled', false).html('<i class="fa fa-save"></i> Register Company');

                            // Handle success
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.href = response.redirect_url; // Redirect to success URL
                            }, 2000);
                        },
                        error: function (xhr) {
                            $('.btn-primary').prop('disabled', false).html('<i class="fa fa-save"></i> Register Company');

                            if (xhr.status === 400 && xhr.responseJSON.redirect_url) {
                                // Show error message and redirect if user already has a company
                                toastr.error(xhr.responseJSON.message);
                                setTimeout(() => {
                                    window.location.href = xhr.responseJSON.redirect_url;
                                }, 2000);
                            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                                // Show validation errors
                                let errorMessages = '';
                                $.each(xhr.responseJSON.errors, function (key, value) {
                                    errorMessages += value[0] + '<br>';
                                });
                                toastr.error(errorMessages);
                            } else {
                                toastr.error('Something went wrong. Please try again.');
                            }
                        }
                    });
                });
            });

        });

    </script>
@endsection