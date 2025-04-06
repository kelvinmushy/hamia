@extends('backend.agent.app')

@section('content')
    <div class="agent-dashboard">
        <div class="container " style="margin-top:120px">

            <div class="row">
                <!-- Sidebar -->
                @include('agent.sidebar')

                <!-- Main Content -->
                <div class="col-md-8">

                    <!-- Project Info -->

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="agent-title mb-0">Taarifa za Vitengo (Units)</h4>

                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#unitModal">
                                    <i class="fa fa-plus"></i> Ongeza Kitengo
                                </button>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jina la Kitengo</th>
                                            <th>Aina</th>
                                            <th>Ukubwa (m²)</th>
                                            <th>Kodi ya Mwezi</th>
                                            <th>Hatua</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($units as $index => $unit)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $unit->name }}</td>
                                                <td>{{ ucfirst($unit->type) }}</td>
                                                <td>{{ number_format($unit->size, 2) }}</td>
                                                <td>{{ number_format($unit->monthly_rent, 2) }}</td>
                                                <td>
                                                    <!-- Edit -->
                                                    <button class="btn btn-sm btn-primary edit-unit" data-id="{{ $unit->id }}"
                                                        data-name="{{ $unit->name }}" data-type="{{ $unit->type }}"
                                                        data-size="{{ $unit->size }}"
                                                        data-monthly_rent="{{ $unit->monthly_rent }}" data-bs-toggle="modal"
                                                        data-bs-target="#unitModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <!-- Delete -->
                                                    <form action="{{ route('agent.unit.destroy', $unit->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Una uhakika unafuta?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                </div> <!-- end col-md-8 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>

    <div>@include('company.projects.property_unity.form')</div>
    {{-- <div>@include('company.projects.project_repayment')</div> --}}


    <!-- Project Modal -->

@endsection

@section('bot')
    <script>

        $(document).ready(function () {

            // Open the modal to add a new project division
            $(document).on('click', '#btnOngeza', function () {
                save_method = "add";
                $('input[name=_method]').val('POST');
                $('#projectDivision').modal('show');
                $('#divisionForm')[0].reset();
                $('.modal-title').text('Ongeza Sehemu ya Mradi');
            });

            var storeDivisionUrl = "{{ route('agent.project.division.store') }}";  // Endpoint for storing new division
            var updateDivisionUrl = "{{ route('agent.project.division.update', ':id') }}";  // Endpoint for updating an existing division

            // AJAX Form Submission for Project Division
            $("#divisionForm").on("submit", function (event) {
                event.preventDefault(); // Prevent default form submission

                let formData = new FormData(this);

                // Check if saving or updating
                if (save_method === 'add') {
                    url = storeDivisionUrl;  // Set this variable in your Blade file
                    formData.set('_method', 'POST'); // Ensure it's a POST request
                } else {
                    url = updateDivisionUrl.replace(':id', $("#division_id").val());
                    formData.set('_method', 'PUT'); // Laravel requires PUT for updates
                }

                $.ajax({
                    url: url,
                    type: "POST", // Always use POST (Laravel will convert it to PUT using _method)
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $(".btn-primary").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                    },
                    success: function (response) {
                        $(".btn-primary").prop("disabled", false).html('<i class="fa fa-save"></i> Hifadhi Sehemu');
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    },
                    error: function (xhr) {
                        $(".btn-primary").prop("disabled", false).html('<i class="fa fa-save"></i> Hifadhi Sehemu');
                        if (xhr.status === 400 && xhr.responseJSON.redirect_url) {
                            toastr.error(xhr.responseJSON.message);
                            setTimeout(() => {
                                window.location.href = xhr.responseJSON.redirect_url;
                            }, 2000);
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
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

            // Edit the project division when clicking the edit button
            $('.edit-project').on('click', function () {
                save_method = 'edit';  // Set save method to 'edit' when editing a project division
                $('input[name=_method]').val('PATCH');  // Set form method to PATCH

                let divisionId = $(this).data('id');  // Fetch project division ID
                console.log("Clicked Edit Button for Division ID:", divisionId);  // Debugging

                // Assign values to modal input fields
                $('#division_id').val(divisionId);
                $('#name').val($(this).data('name'));
                $('#division_type').val($(this).data('type')).trigger('change');
                $('#size').val($(this).data('size'));
                $('#sell_price').val($(this).data('sell_price'));
            });
            $('#unit_type').on('change', function () {
                if (this.value === 'apartment') {
                    $('#apartment-fields').show();  // Show additional apartment fields
                } else {
                    $('#apartment-fields').hide();  // Hide additional apartment fields
                }
            });
        });

    </script>

@endsection