@extends('backend.agent.app')

@section('content')
    <div class="agent-dashboard">
        <div class="container mt-4">
            <h4 class="agent-title">Orodha ya Miradi</h4>

            <div class="row">
                @include('agent.sidebar')

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="agent-title">Tarifa za Miradi</h4>

                            <!-- Add Project Button (Opens Modal) -->
                            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#projectModal">
                                <i class="fa fa-plus"></i> Ongeza Mradi
                            </button>

                            <!-- Projects Table -->
                            <div class="table-responsive">
                                <table class="table table-striped" id="projectsTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Jina la Mradi</th>
                                            <th>Aina</th>
                                            <th>Ukubwa (m²)</th>
                                            <th>Aina ya Malipo</th>
                                            <th>Gharama</th>
                                            <th>Hatua</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $index => $project)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $project->name }}</td>
                                                <td>{{ ucfirst($project->type) }}</td>
                                                <td>{{ $project->size_in_sq_m }}</td>
                                                <td>{{ ucfirst($project->payments->payment_type) }}</td>
                                                <td>{{ number_format($project->payments->total_price, 2) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-project"
                                                        data-id="{{ $project->id }}" data-name="{{ $project->name }}"
                                                        data-type="{{ $project->type }}"
                                                        data-size="{{ $project->size_in_sq_m }}"
                                                        data-residential_size="{{ $project->residential_size }}"
                                                        data-farm_size="{{ $project->farm_size }}"
                                                        data-payment_type="{{ $project->payments->payment_type }}"
                                                        data-price="{{ $project->payments->total_price }}"
                                                        data-amount_paid="{{ $project->payments->amount_paid }}"
                                                        data-installment_period="{{ $project->payments->installment_period }}"
                                                        data-installment_amount="{{ $project->payments->installment_amount }}"
                                                         data-region="{{ $project->location->district->region->id}}"
                                                        data-district="{{ $project->location->district_id }}"
                                                        data-address="{{ $project->location->sub_location }}" data-bs-toggle="modal"
                                                        data-bs-target="#projectModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <form action="{{ route('agent.projects.destroy', $project->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Una uhakika?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>@include('company.projects.form')</div>
    <!-- Project Modal -->

@endsection

@section('bot')
    <script>

        $(document).ready(function () {

            $("#project_type").on("change", function () {
                if ($(this).val() === "mixed") {
                    $("#allocation_section").removeClass("d-none").slideDown();
                } else {
                    $("#allocation_section").slideUp(function () {
                        $(this).addClass("d-none");
                        // Clear values when hidden
                        $("#residential_size").val("");
                        $("#farm_size").val("");
                    });
                }
            });
            // Initialize Select2
            $(".select_district, .select_region, .select_ward").select2({
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

            // Fetch Wards Based on District Selection
            $('.select_district').on('change', function () {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        type: 'GET',
                        url: '/agent/district/ward',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: districtId
                        },
                        success: function (response) {
                            $('select[name="ward"]').empty().append('<option value="">Select Ward</option>');
                            $.each(response.data, function (key, value) {
                                $('select[name="ward"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function (error) {
                            console.log('Error:', error);
                        }
                    });
                } else {
                    $('select[name="ward"]').empty().append('<option value="">Select Ward</option>');
                }
            });


            // Show/Hide Installment Section when Payment Type is Selected
            $('#payment_method').on('change', function () {
                if ($(this).val() === 'installment') {
                    $('#installment_section').removeClass('d-none').slideDown(); // Show section
                } else {
                    $('#installment_section').slideUp(function () {
                        $(this).addClass('d-none'); // Hide section
                    });
                }
            });

            // AJAX Form Submission
            $("#projectForm").on("submit", function (event) {
                event.preventDefault(); // Prevent default form submission

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('agent.projects.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $(".btn-primary").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                    },
                    success: function (response) {
                        $(".btn-primary").prop("disabled", false).html('<i class="fa fa-save"></i> Hifadhi');

                        // Handle success
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect_url; // Redirect to success URL
                        }, 2000);
                    },
                    error: function (xhr) {
                        $(".btn-primary").prop("disabled", false).html('<i class="fa fa-save"></i> Hifadhi');

                        if (xhr.status === 400 && xhr.responseJSON.redirect_url) {
                            // Show error message and redirect if necessary
                            toastr.error(xhr.responseJSON.message);
                            setTimeout(() => {
                                window.location.href = xhr.responseJSON.redirect_url;
                            }, 2000);
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // Show validation errors
                            let errorMessages = "";
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                errorMessages += value[0] + "<br>";
                            });
                            toastr.error(errorMessages);
                        } else {
                            toastr.error("Something went wrong. Please try again.");
                        }
                    }
                });
            });

            $('.edit-project').on('click', function () {
                let projectId = $(this).data('id'); // Fetch project ID

                console.log("Clicked Edit Button for Project ID:", projectId); // Debugging

                // Assign values to modal input fields
                $('#project_id').val(projectId);
                $('#project_name').val($(this).data('name'));
                $('#project_type').val($(this).data('type'));
                $('#size').val($(this).data('size'));
                $('#residential_size').val($(this).data('residential_size'));
                $('#farm_size').val($(this).data('farm_size'));
                $('#payment_method').val($(this).data('payment_type'));
                $('#price').val($(this).data('price'));
                $('#amount_paid').val($(this).data('amount_paid'));
                $('#installment_period').val($(this).data('installment_period'));
                $('#installment_amount').val($(this).data('installment_amount'));

                // Populate Location Fields
                $('#region').val($(this).data('region')).trigger('change');
                $('#district').val($(this).data('district')).trigger('change');
                $('#address').val($(this).data('address'));

                // Show hidden sections if necessary
                if ($(this).data('type') === 'mixed') {
                    $('#allocation_section').removeClass('d-none'); // Show size distribution fields
                } else {
                    $('#allocation_section').addClass('d-none');
                }

                // Show hidden sections if necessary
                if ($(this).data('type') === 'mixed') {
                    $('#allocation_section').removeClass('d-none'); // Show size distribution fields
                } else {
                    $('#allocation_section').addClass('d-none');
                }

                if ($(this).data('payment_type') === 'installment') {
                    $('#installment_section').removeClass('d-none'); // Show installment section
                } else {
                    $('#installment_section').addClass('d-none');
                }
            });

        });
    </script>
@endsection