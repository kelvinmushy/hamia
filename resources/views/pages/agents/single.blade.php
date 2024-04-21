@extends('frontend.layouts.app')

@section('top')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
  <link rel="stylesheet" href="{{asset('css/property_card.css')}}">
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