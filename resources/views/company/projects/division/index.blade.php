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
                   
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="agent-title fw-bold mb-3">
                                @if($type === 'residential')
                                    Maelezo ya Mradi wa Makazi wa mradi <span class="text text-info">{{ $project->name }}</span>
                                @elseif($type === 'farm_land')
                                    Maelezo ya Mradi wa Shamba wa mradi <span class="text text-info">{{ $project->name }}</span>
                                @elseif($type === 'commercial')
                                    Maelezo ya Mradi wa Biashara wa mradi <span class="text text-info">{{ $project->name }}</span>
                                @elseif($type === 'industrial')
                                    Maelezo ya Mradi wa Viwanda wa mradi <span class="text text-info">{{ $project->name }}</span>
                                @elseif($type === 'mixed')
                                    Maelezo ya Mradi wa Mchanganyiko
                                @else
                                    Maelezo ya Mradi
                                @endif
                            </h4>
                            
                    
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <p class="mb-1"><strong>Jina:</strong> {{ $project->name }}</p>
                                    <p class="mb-1"><strong>Ukubwa:</strong> {{ number_format($project->size_in_sq_m, 2) }} m²</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-1"><strong>Gharama:</strong> {{ number_format($project->payments->total_price ?? 0, 2) }} </p>
                                    <p class="mb-1">
                                        <strong>Eneo:</strong> 
                                        {{ $project->location->sub_location ?? '' }},
                                        {{ $project->location->district->name ?? '' }}
                                        {{ $project->location->district->region->name ?? '' }}
                                    </p>
                                </div>
                            </div>
                    
                            {{-- Show land sizes when type is mixed --}}
                            @if($project->type === 'mixed')
                                <hr>
                                <h6 class="fw-bold text-primary">Mgawanyo wa Vipande</h6>
                                <ul class="list-unstyled mb-3">
                                    @if($project->residential_size > 0)
                                        <li><strong>Ukubwa wa Makazi (Residential):</strong> {{ number_format($project->residential_size, 2) }} m²</li>
                                    @endif
                                    @if($project->farm_size > 0)
                                        <li><strong>Ukubwa wa Shamba (Farm Land):</strong> {{ number_format($project->farm_size, 2) }} m²</li>
                                    @endif
                                </ul>
                            @endif
                    
                            <div class="text-muted">
                                <strong>Jumla ya Vipande:</strong> {{ $totalDivisions }} &nbsp; | &nbsp;
                                <strong>Bei:</strong> {{ number_format($totalPrice, 2) }} &nbsp; | &nbsp;
                                <strong>Ukubwa Uliobaki Baada ya Kugawanywa:</strong> {{ number_format($remainingSize, 2) }} m²
                            </div>
                        </div>
                    </div>
                    


                    <!-- Projects Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="agent-title mb-0">Taarifa za Miradi</h4>
                                <button class="btn btn-success" id="btnOngeza">
                                    <i class="fa fa-plus"></i> Gawa Kipande
                                </button>
                            </div>

                            <div class="table-responsive">
                              
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jina la Sehemu/Namba</th>
                                            <th>Aina ya Sehemu</th>
                                            <th>Ukubwa (m²)</th>
                                            <th>Bei ya Uuzaji</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project_division as $index => $division)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $division->name }}</td>
                                                <td>{{ ucfirst($division->division_type) }}</td>
                                                <td>{{ $division->size }}</td>
                                                <td>{{ number_format($division->sell_price, 2) }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-sm btn-primary edit-project" data-id="{{ $division->id }}"
                                                        data-name="{{ $division->name }}" data-type="{{ $division->division_type }}"
                                                        data-size="{{ $division->size }}" data-sell_price="{{ $division->sell_price }}"
                                                        data-bs-toggle="modal" data-bs-target="#projectDivision">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('agent.project.division.destroy', $division->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Una uhakika?')">
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
                    </div> <!-- end card -->

                </div> <!-- end col-md-8 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>

    <div>@include('company.projects.division.form')</div>
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

});

    </script>

@endsection