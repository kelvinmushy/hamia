@extends('frontend.layouts.app')

@section('title', 'All Agents In Tanzania')

@section('top')
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @livewireStyles
    <style>
        .company-card {
            transition: transform 0.2s; /* Smooth transition for hover effect */
        }

        .company-card:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Increased shadow on hover */
        }

        .company-image {
            border: 2px solid #ddd; /* Optional: Light gray border */
            border-radius: 50%; /* Make it round */
            overflow: hidden; /* Ensure any overflow is hidden */
        }

        .company-image img {
            border-radius: 50%; /* Make the image round */
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <section style="margin-top:10px">
            <div class="row clearfix">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <small style="font-size:15px"><strong>Verified Agents Only </strong></small>
                </div>
            </div>
            <div>
                @livewire('all-agent')
                @livewireScripts
            </div>
        </section>
    </div>
@endsection

@section('bot')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript">
        window.onscroll = function (ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('load-more');
            }
        };

        $(document).ready(function () {
            $('#property_type_id').on('change', function (e) {
                livewire.emit('listenerPropertyType',
                    $('#property_type_id').select2("val"));

            });


            $('#selectPurpose').on('change', function (e) {
                livewire.emit('listenerPurpose',
                    $('#selectPurpose').select2("val"));

            });


            $('#city_id').on('change', function (e) {
                livewire.emit('listenerCity',
                    $('#city_id').select2("val"));

            });
            $('#district_id').on('change', function (e) {
                livewire.emit('listenerDistrict',
                    $('#district_id').select2("val"));

            });

            $("#city_id").select2({
                placeholder: 'Region/City...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/regionApi',
                    dataType: 'json',
                    data: function (params) {

                        return {
                            term: params.term || '',
                            page: params.page || 1,

                        }
                    },
                    cache: true
                }

            })
            $("#selectPurpose").select2({
                placeholder: 'Select Purpose...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/purposeApi',
                    dataType: 'json',
                    data: function (params) {

                        return {
                            term: params.term || '',
                            page: params.page || 1,

                        }
                    },
                    cache: true
                }

            })

            $("#property_type_id").select2({
                placeholder: 'Select Proprty Type...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/propertyTypeApi',
                    dataType: 'json',
                    data: function (params) {

                        return {
                            term: params.term || '',
                            page: params.page || 1,

                        }
                    },
                    cache: true
                }

            })

            $("#district_id").select2({
                placeholder: 'Select District...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/districtApi',
                    dataType: 'json',
                    data: function (params) {

                        return {
                            term: params.term || '',
                            page: params.page || 1,

                        }
                    },
                    cache: true
                }

            })


        })






    </script>
@endsection
