@extends('backend.agent.app')

@section('top')
    <style>
        /* Keep your existing styles unchanged */
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="agent-dashboard">
        <div class="container" style="margin-top:30px;">
            <h4 class="agent-title">Customer Management</h4>
            <div class="row">
                @include('agent.sidebar')

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#customerModal">
                                Add Customer
                            </button>
                            <div class="table-responsive"> <!-- Added table-responsive class -->
                                <table class="table table-bordered table-hover"> <!-- Added table-bordered and table-hover classes -->
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Actions</th> <!-- Added Actions column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->phone_number }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->district->name ?? 'N/A' }}</td>
                                                <td>{{ $customer->address }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary editButton"
                                                        data-id="{{ $customer->id }}" data-name="{{ $customer->name }}"
                                                        data-phone="{{ $customer->phone_number }}"
                                                        data-email="{{ $customer->email }}"
                                                        data-district="{{ $customer->district_id }}"
                                                        data-address="{{ $customer->address }}" 
                                                        data-bs-toggle="modal" data-bs-target="#customerModal">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
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

        <!-- Customer Modal -->
        <div>@include('company.customer.form')</div>

    </div>
@endsection

@section('bot')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".select_district, .select_region").select2({ placeholder: 'Select an option', allowClear: true });

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
                        }
                    });
                }
            });
            $(document).on('click', '.editButton', function () {
                save_method = 'edit';  // Set save method to 'edit' when editing a project division
                $('input[name=_method]').val('PATCH'); 
                $('#customerModal').modal('show');
                // Get data from the button attributes
                var customerId = $(this).data('id');
                var customerName = $(this).data('name');
                var customerPhone = $(this).data('phone');
                var customerEmail = $(this).data('email');
                var customerDistrict = $(this).data('district');
                var customerAddress = $(this).data('address');

                $('#customerId').val(customerId);
                $('#name').val(customerName);
                $('#phone_number').val(customerPhone);
                $('#email').val(customerEmail);
                $('#district_id').val(customerDistrict); // Assuming you want to set the district id
                $('#address').val(customerAddress);
 // Change the modal title and form action for update
 $('#customerModalLabel').text('Edit Customer');
    $('#customerForm').attr('action', '{{ route("agent.customers.update", ":id") }}'.replace(':id', customerId));
                
            });
            // Handle form submission
$('#customerForm').on('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = $(this).serialize(); // Serialize form data
    let actionUrl = $(this).attr('action');

    // Determine the request type based on action URL
    let requestType = actionUrl.includes('/update/') ? 'PUT' : 'POST'; // Change here

    $.ajax({
        url: actionUrl, // Use the form action
        type: requestType, // Use the determined request type
        data: formData,
        success: function(response) {
            // Handle success
            toastr.success(response.message); // Use toastr for notifications
            $('#customerModal').modal('hide'); // Close modal
            // Reload the page or update the customer list dynamically
            location.reload(); // Reload the page to see the updated customer list
        },
        error: function(xhr) {
            // Handle validation errors
            let errors = xhr.responseJSON.errors;
            for (const [key, value] of Object.entries(errors)) {
                $('#' + key + 'Error').text(value[0]); // Show error message
            }
        }
    });
})

        });

        document.getElementById('customerForm').addEventListener('submit', function (e) {
            let valid = true;

            // Validate name (at least two words)
            let name = document.getElementById('name').value.trim();
            let namePattern = /^[A-Za-z]+(\s[A-Za-z]+)+$/;
            if (!namePattern.test(name)) {
                document.getElementById('nameError').innerText = "Please enter at least two words (e.g., Kelvin Cosmas)";
                valid = false;
            } else {
                document.getElementById('nameError').innerText = "";
            }

            // Validate phone number (must start with 255 and have 12 digits)
            let phone = document.getElementById('phone_number').value.trim();
            let phonePattern = /^255[0-9]{9}$/;
            if (!phonePattern.test(phone)) {
                document.getElementById('phoneError').innerText = "Phone number must start with 255 and be 12 digits";
                valid = false;
            } else {
                document.getElementById('phoneError').innerText = "";
            }

            if (!valid) {
                e.preventDefault(); // Stop form from submitting if invalid
            }
         

        });

    </script>
@endsection