@extends('backend.agent.app')

@section('title', 'Create Property')

@section('top')
  @livewireStyles
  <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
    integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .file-input {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    text-align: center;
    padding: 15px;
    margin-bottom: 15px;
    }

    .preview-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    }

    .image-container {
    position: relative;
    display: inline-block;
    }

    .preview-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    }

    .remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: rgba(255, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    width: 20px;
    height: 20px;
    font-size: 14px;
    line-height: 16px;
    text-align: center;
    }
  </style>
@endsection

@section('content')
  <div class="container" style="margin-top: 30px;">
    <h4 class="agent-title">DASHBOARD</h4>
    <div class="row">
    @include('agent.sidebar')
    <div class="col-md-8">
      <form enctype="multipart/form-data" name="property-form" id="property-form">
      {{ csrf_field() }}


      <div class="card">
        <div class="body">
        <div class="row mb-3">
          <div class="col-md-12">
          <div class="form-group">
            <label for="property_images">Upload Property Images (Max 5 images)</label>
            <input type="file" name="property_images[]" id="property_images" accept=".jpeg, .jpg, .png" multiple
            required class="form-control">
            <div id="image-preview" class="preview-images mt-2"></div>
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
          <div class="form-group">
            <label for="sub_category_id">Property Category</label>
            <select class="form-control select_sub_category" name="sub_category_id" required id="sub_category_id">
            <option value="">Select</option>
            @foreach($sub_category as $sub)
        <option value="{{$sub->id}}">{{$sub->name}}</option>
      @endforeach
            </select>
            @error('sub_category_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
            <label for="type_id">Select Property Type</label>
            <select class="form-control select_type" name="type_id" required id="type_id">
            <option value="">Select</option>
            @foreach($property_type as $property_type)
        <option value="{{$property_type->id}}">{{$property_type->name}}</option>
      @endforeach
            </select>
            @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
          <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" name="title" required id="title" />
            @error('title_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
          <div class="form-group">
            <label for="currency_id">Currency</label>
            <select class="form-control select_currency" name="currency_id" id="currency_id">
            <option value="">Select</option>
            @foreach($currency as $currency)
        <option value="{{$currency->id}}">{{$currency->name}}</option>
      @endforeach
            </select>
            @error('currency_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label for="term_id">Payment Terms</label>
            <select name="term_id" id="term_id" class="form-control select_term" required>
            <option value="">Select</option>
            @foreach($terms as $term)
        <option value="{{$term->id}}">{{$term->name}}</option>
      @endforeach
            </select>
            @error('term_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" required />
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
          <div class="form-group">
            <label for="region_id">Region</label>
            <select class="form-control select_region" name="region_id" required id="region_id">
            <option value="">Select</option>
            @foreach($region as $region)
        <option value="{{$region->id}}">{{$region->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label for="district_id">District</label>
            <select class="form-control select_district" name="district_id" required id="district_id">
            <option value="">Select</option>
            @foreach($district as $district)
        <option value="{{$district->id}}">{{$district->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label for="sub_location">Sub Location</label>
            <input type="text" class="form-control" name="sub_location" required />
            @error('sub_location') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
          <div class="form-group">
            <label for="property_feature">Property Features</label>
            <select class="form-control select_features" name="feature_id[]" id="property_feature"
            multiple="multiple">
            @foreach($features as $feature)
        <option value="{{$feature->id}}">{{$feature->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label for="nearby">Nearby</label>
            <select class="form-control select_near" name="nearby[]" id="nearby" multiple="multiple">
            @foreach($nearBye as $nearBye)
        <option value="{{$nearBye->id}}">{{$nearBye->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6 propertCondition">
          <div class="form-group">
            <label for="condition_id">Condition</label>
            <select class="form-control select_condition" name="condition_id" id="condition_id">
            @foreach($condition as $condition)
        <option value="{{$condition->id}}">{{$condition->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-6 propertFurnish">
          <div class="form-group">
            <label for="furnish_id">Furnishing</label>
            <select class="form-control select_furnish" name="furnish_id" id="furnish_id">
            @foreach($furnish as $furnish)
        <option value="{{$furnish->id}}">{{$furnish->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
          <div class="form-group">
            <label for="area">Square Feet/Area</label>
            <input type="number" class="form-control" name="area" required />
            @error('area') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-4 propertyBeadRoam">
          <div class="form-group">
            <label for="bedroom">Bedroom</label>
            <input type="number" class="form-control" name="bedroom" />
            @error('bedroom') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-4 propertyBathRoam">
          <div class="form-group">
            <label for="bathroom">Bathroom</label>
            <input type="number" class="form-control" name="bathroom" />
            @error('bathroom') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>
        </div>

        <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary btnSubmit" id="submit-all">Post Ad</button>
        </div>
      </div>
      </form>
    </div>
    </div>
  </div>

@endsection

@section('bot')
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.18.3/dist/sweetalert2.all.min.js"></script>
  <script>
    $(document).ready(function () {
    let selectedFiles = [];
    let fileNames = new Set(); // Track file names to prevent duplicates

    // Handle new file selection
    $('#property_images').on('change', function (event) {
      const files = event.target.files;
      const previewContainer = $('#image-preview');

      // Clear previous previews (but keep track of selected files)
      previewContainer.find('.image-container').remove();

      // Process new files
      const newFiles = Array.from(files).filter(file => {
      // Check for duplicates by name and size
      const fileKey = `${file.name}-${file.size}`;
      if (fileNames.has(fileKey)) {
        return false; // Skip duplicate
      }
      fileNames.add(fileKey);
      return true;
      });

      // Combine with existing selections
      selectedFiles = [...selectedFiles, ...newFiles];

      // Enforce 5-image limit
      if (selectedFiles.length > 5) {
      alert('Maximum 5 images allowed. Only the first 5 will be kept.');
      selectedFiles = selectedFiles.slice(0, 5);
      fileNames = new Set(selectedFiles.map(f => `${f.name}-${f.size}`));
      }

      // Update file input
      updateFileInput();

      // Display previews
      selectedFiles.forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = function (e) {
        const img = $('<img>', {
        src: e.target.result,
        class: 'preview-image',
        style: 'width: 100px; height: 100px; object-fit: cover; margin: 5px; border: 1px solid #ddd;'
        });

        const removeBtn = $('<button>', {
        type: 'button',
        class: 'remove-image btn btn-danger btn-sm',
        style: 'position: absolute; top: 5px; right: 5px; width: 20px; height: 20px; padding: 0; border-radius: 50%;'
        }).html('×').click(function () {
        // Remove from tracking
        const fileKey = `${file.name}-${file.size}`;
        fileNames.delete(fileKey);
        selectedFiles.splice(index, 1);
        updateFileInput();
        $(this).parent().remove();
        });

        const previewDiv = $('<div>', {
        class: 'image-container',
        style: 'position: relative; display: inline-block; margin: 5px;'
        }).append(img).append(removeBtn);

        previewContainer.append(previewDiv);
      };
      reader.readAsDataURL(file);
      });
    });

    // Update the file input with current selection
    function updateFileInput() {
      const dataTransfer = new DataTransfer();
      selectedFiles.forEach(file => dataTransfer.items.add(file));
      $('#property_images')[0].files = dataTransfer.files;
    }

    // Form submission handler
    $("#property-form").submit(function (event) {
      event.preventDefault();

      if (selectedFiles.length === 0) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Please upload at least one image.'
      });
      return;
      }

      let formData = new FormData(this);

      // Clear and re-add files to ensure proper formatting
      formData.delete('property_images[]');
      selectedFiles.forEach(file => {
      formData.append('property_images[]', file);
      });

      $.ajax({
      url: "/agent/properties",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('.btnSubmit').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
      },
      success: function (response) {
        if (response.success) {
          window.location.href = '/agent/preview/property/' + response.property_id;
        } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: response.message
        });
        }
      },
      error: function (xhr) {
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: xhr.responseJSON?.message || 'An error occurred'
        });
      },
      complete: function () {
        $('.btnSubmit').prop('disabled', false).html('Submit');
      }
      });
    });
    });
    $(document).ready(function () {



    $('#sub_category_id').on('change', function () {
      var id = $('#sub_category_id').val();
      $.ajax({
      type: 'GET',
      data: {
        "_token": "{{ csrf_token() }}",
        id: id,
      },
      url: '/agent/subcategory/propertyType',
      success: function (html) {
        $('select[name="type_id"]').empty();
        $('select[name="type_id"]').append('<option value="">Select Type</option>');
        $.each(html.data, function (key, value) {
        $('select[name="type_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
        });

      },
      error: function (data) {

      }

      });

    })
    $('.select_region').on('change', function () {
      var id = $('#region_id').val();
      $.ajax({
      type: 'GET',
      data: {
        "_token": "{{ csrf_token() }}",
        id: id,
      },
      url: '/agent/region/district',
      success: function (html) {
        $('select[name="district_id"]').empty();
        $('select[name="district_id"]').append('<option value="">Select District</option>');
        $.each(html.data, function (key, value) {
        $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
        });

      },
      error: function (data) {

      }

      });

    })

    $('#sub_category_id').on('change', function () {

      var id = $('#sub_category_id').val();
     

      if (id == 1 || id == 6 || id == 13) {
      $('.propertyBeadRoam').show();
      $('.propertyBathRoam').show();
      $('.propertFurnish').show();
      $('.propertCondition').show();

      } else {
      $('.propertyBeadRoam').hide();
      $('.propertyBathRoam').hide();
      $('.propertFurnish').hide();
      $('.propertCondition').hide();
      }

    })

    $(".select_region").select2({
      placeholder: 'Select Region',
      allowClear: true,

    })
    $(".select_near").select2({
      placeholder: 'Select NearBy',
      allowClear: true,

    })
    $(".select_type").select2({
      placeholder: 'Select Type',
      allowClear: true,

    })
    $(".select_purpose").select2({
      placeholder: 'Select Purpose',
      allowClear: true,

    })
    $(".select_features").select2({
      placeholder: 'Select Features',
      allowClear: true,


    })

    $(".select_sub_category").select2({
      placeholder: 'Select',
      allowClear: true,

    })

    $(".select_category").select2({
      placeholder: 'Select Category',
      allowClear: true,

    })
    $(".select_title").select2({
      placeholder: 'Select',
      allowClear: true,
      tags: true,
    })
    $(".select_term").select2({
      placeholder: 'Select',
      allowClear: true,

    })
    $(".select_district").select2({
      placeholder: 'Select',
      allowClear: true,

    })
    $(".select_condition").select2({
      placeholder: 'Select Condition',
      allowClear: true,

    })
    $(".select_furnish").select2({
      placeholder: 'Select Furnish',
      allowClear: true,

    })
    $(".select_currency").select2({
      placeholder: 'Select',
      allowClear: true,

    })




    })

  </script>
@endsection