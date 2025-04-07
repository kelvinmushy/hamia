@extends('frontend.layouts.app')

@section('top')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
  <link rel="stylesheet" href="{{asset('css/property_card.css')}}">
  <style>
    .property-card {
        transition: transform 0.2s, box-shadow 0.2s; /* Smooth transition for hover effect */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Initial shadow */
    }

    .property-card:hover {
        transform: translateY(-5px); /* Lift effect on hover */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Increased shadow on hover */
    }

    .property-image {
        background-size: cover; /* Cover the entire area */
        background-position: center; /* Center the image */
        height: 200px; /* Fixed height for image */
        position: relative; /* For absolute positioning of the count */
    }

    .property-count {
        position: absolute; /* Position the count at the bottom */
        bottom: 10px; /* 10px from the bottom */
        right: 10px; /* 10px from the right */
        background: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
        color: white; /* White text color */
        padding: 5px 10px; /* Padding for better spacing */
        border-radius: 5px; /* Rounded corners */
    }
    
</style>
    @livewireStyles
@endsection
@section('content')

         
  
    <div class="container-fluid">

     <section  style="margin-top:10px">
         
            <div> <livewire:agent-profile :agent_id="$id"></div>
           @livewireScripts
        </div>
    </div>
</section> 
</div>
@endsection

@section('bot')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
      window.onscroll = function(ev) {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
       window.livewire.emit('load-more');
      }
     };

     $(document).ready(function(){
         $('#property_type_id').on('change', function(e) { 
            livewire.emit('listenerPropertyType', 
            $('#property_type_id').select2("val"));
      
        });

      
        $('#selectPurpose').on('change', function(e) { 
            livewire.emit('listenerPurpose', 
            $('#selectPurpose').select2("val"));
      
        });

      
        $('#city_id').on('change', function(e) { 
            livewire.emit('listenerCity', 
            $('#city_id').select2("val"));
      
        });
           $('#district_id').on('change', function(e) { 
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
                    data: function(params) {
                       
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
                    data: function(params) {
                       
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
                    data: function(params) {
                       
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
                    data: function(params) {
                       
                        return {
                            term: params.term || '',
                            page: params.page || 1,
                           
                        }
                    },
                    cache: true
                }

            })


     })

  
       
  $(function(){
            $('#form-message').on('submit', function (e) {
                   save_method = "add";
                  $('input[name=_method]').val('POST');
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('/property/message')}}";
                    else url = "{{ url('/universal/tool') . '/' }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
//                      data : $('#form-account').serialize(),
                        data: new FormData($("#form-message")[0]),
                        contentType: false,
                        processData: false,
                        beforeSend:function(){
                        $(".btnSubmit").attr("disabled",true);
                        $('.btnSubmit').html("Please Wait...");
                        },
                        success : function(data) {
                          
                            $(".btnSubmit").attr("disabled",false);
                            $('.btnSubmit').html("submit");
                             $('#form-message')[0].reset();
                           swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            $(".btnSubmit").attr("disabled",false);
                            $('.btnSubmit').html("submit");
                           swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
            
        });
  

    </script>

@endsection