@extends('frontend.layouts.app')

@section('top')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @livewireStyles
@endsection
@section('content')

  


    <div class="container-fluid">

     <section  style="margin-top:100px">

           <div class="row clearfix">
            <div class="col-md-12">
                 <small  style="font-size:15px"><strong>Client Requests</strong></small>
            </div>
            </div>
    <div class="row clearfix">
    <div class="col-lg-4 col-md-12 col-sm-4 col-xs-4">
          </div>
     <div class="col-lg-4 col-md-12 col-sm-4 col-xs-4">
        
        <center><a href="#" class="btn btn-primary btn  m-b-15 addbtn">
            <i class="fa fa-plus"></i>
            Add Your Request
        </a></center>
    </div>

     <div class="col-lg-4 col-md-12 col-sm-4 col-xs-4">
       
    </div>

    </div>

    <div> @livewire('client-requests')</div>
      
        </div>
    </div>
</section> 
</div>
     @livewireScripts
@endsection
@section('bot')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div>@include('frontend.client_request_form')</div>

<script type="text/javascript">
$(document).ready(function(){


 $(".select_district").select2({
     placeholder: 'Select',
     allowClear: true,
     tags: true,
})
 $(".select_region").select2({
     placeholder: 'Select Region',
     allowClear: true,
     tags: true,
})
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

  $('.select_region').on('change',function(){
         var id=$('#region_id').val();
             $.ajax({
              type: 'GET',
              data: {
             "_token": "{{ csrf_token() }}",
              id: id,
              },
              url: '/region/district',
              success: function(html) {
              $('select[name="district_id"]').empty();
              $('select[name="district_id"]').append('<option value="">Select District</option>');
              $.each(html.data, function(key, value) {
            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

              },
              error: function(data) {
             
                 }

                 });
               
            })
      $(document).on('click', '.addbtn', function() {
      save_method = "add";
       $('input[name=_method]').val('POST');
      $('#modal-client').modal('show');
       $('#form-client')[0].reset();
       $('.modal-title').text('Add Request');
      });

             $(function() {
                    $('#form-client').on('submit', function(e) {
                        if (!e.isDefaultPrevented()) {
                            var id = $('#id').val();
                            if (save_method == 'add') url = "{{ url('/client/request/store') }}";
                            else url = "{{ url('/client/request/store') . '/' }}" + id;

                            $.ajax({
                                url: url,
                                type: "POST",
                                //                      data : $('#form-account').serialize(),
                                data: new FormData($("#form-client")[0]),
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    $(".btnSubmit").attr("disabled", true);
                                    $('.btnSubmit').html("Please Wait...");
                                },
                                success: function(data) {
                                    $('#modal-client').modal('hide');
                                    location.reload();
                                    $(".btnSubmit").attr("disabled", false);
                                    $('.btnSubmit').html("submit");
                                    swal({
                                        title: 'Success!',
                                        text: data.message,
                                        type: 'success',
                                        timer: '1500'
                                    })
                                },
                                error: function(data) {
                                    $(".btnSubmit").attr("disabled", false);
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

})	
  
 </script>

@endsection