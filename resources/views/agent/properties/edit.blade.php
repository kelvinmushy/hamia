@extends('backend.agent.app')

@section('title', 'Edit Property')

@section('top')
  @livewireStyles
  <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css" />

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" />
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
  <div class="container" style="margin-top:30px;">
    <h4 class="agent-title">Edit Property</h4>
    <div class="row">
    @include('agent.sidebar')

    <div class="col-md-8">
      <form method="POST" enctype="multipart/form-data" name="property-form">
      {{ csrf_field() }}

      <div class="card">
        <div class="body">
        <input type="hidden" name="property_id" id="property_id" class="form-control" value="{{ $property->id }}">

        <div class="form-group">
          <label for="property_images">Upload Property Images (Max 5 images)</label>
          <input type="file" name="property_images[]" id="property_images" accept=".jpeg, .jpg, .png" multiple
          class="form-control">

          <div id="image-preview" class="preview-images mt-2">
          @foreach($property->property_gallery as $image)
        <!-- Existing Image -->
        <input type="hidden" name="existing_images[]" value="{{ $image->path }}">
        <div class="image-container" id="existing-image-{{ $image->id }}">
        <img
        src="{{ Storage::exists($image->path) ? asset('storage/' . $image->path) : asset($image->path) }}"
        alt="Property Image" class="preview-image">
        <button type="button" class="remove-image" data-image-id="{{ $image->id }}"
        data-image-path="{{ $image->path }}">×</button>
        </div>
      @endforeach
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <label for="tinymce">Description</label>
            <textarea name="description" id="description" class="form-control" required>
  {{$property->description}}
  </textarea>
          </div>
          </div>
        </div>
        <div class="row">

          <div class="col-md-6">
          <div class="form-group">
            <label>Property Category</label>
            <select class="form-control select_sub_category" name="sub_category_id" required id="sub_category_id"
            style="width:100%">
            <option value="">Select</option>
            @foreach($sub_category as $sub)
        <option value="{{$sub->id}}" {{ $sub->id == @$property->sub_category_id ? 'selected' : '' }}>
          {{$sub->name}}
        <option>
        @endforeach
            </select>
            @error('sub_category_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label> Select Property Type</label>
            <select class="form-control select_type" name="type_id" required id="type_id" style="width:100%">
            <option value="">Select</option>
            @foreach($property_type as $property_type)
        <option value="{{$property_type->id}}" {{ $property_type->id == @$property->type_id ? 'selected' : '' }}>{{$property_type->name}}
        <option>
        @endforeach
            </select>
            @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <label> Title</label>
            <input class="form-control" name="title" required id="title" style="height:30px;border-radius: 5px;"
            value="{{@$property->title}}" />
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          <div class="form-group">
            <label class="form-label">Currency</label>
            <select class="form-control select_currency" name="currency_id" id="currency_id"
            value="{{@$property->currency_id}}" style="width:100%">
            <option value="">Select</option>
            @foreach($currency as $currency)
        {{--
        <option value="{{$currency->id}}">{{$currency->name}}</option>
        --}}
        <option value="{{$currency->id}}" {{ $currency->id == $property->currency_id ? 'selected' : '' }}>
          {{$currency->name}}
        <option>
        @endforeach
            </select>
          </div>
          @error('price') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label>Payment Terms</label>
            <select name="term_id" id="term_id" class="form-control select_term" required style="width:100%">
            <option value="">Select</option>
            @foreach($terms as $term)
        <option value="{{$term->id}}" {{ $term->id == @$property->property_term->term_id ? 'selected' : '' }}>
          {{$term->name}}
        <option>
        @endforeach
            </select>
            @error('term_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="price" required
            style="height:30px;border-radius: 5px;" value="{{$property->price}}">
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          <div class="form-group">
            <label class="form-label">Region</label>
            <select class="form-control select_region" name="region_id" required id="region_id"
            style="width:100%">
            <option value="">Select</option>
            @foreach($region as $region)
        <option value="{{$region->id}}" {{ $region->id == @$property->property_location->region_id ? 'selected' : '' }}>{{$region->name}}
        <option>
        @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group form-float">
            <label class="form-label">District</label>
            <select class="form-control select_district" name="district_id" id="district_id" required
            style="width:100%">
            <option value="">Select</option>
            @foreach($district as $district)
        <option value="{{$district->id}}" {{ $district->id == @$property->property_location->district_id ? 'selected' : '' }}>{{$district->name}}
        <option>
        @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group ">
            <label class="form-label">sub location</label>
            <input type="text" class="form-control" name="sub_location"
            value="{{@$property->property_location->name}}" required style="height:30px;border-radius: 5px;">
          </div>
          @error('sub_location') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group ">
            <label>Property Features</label>
            <select class="form-control select_features" name="feature_id[]" id="property_feature"
            multiple="multiple" style="width:100%">
            @foreach($features as $feature)
        <option value="{{$feature->id}}">{{$feature->name}}</option>
        @foreach($property->property_features as $f)
      <option value="{{$feature->id}}" {{ $feature->id == @$f->feature_id ? 'selected' : '' }}>
        {{$feature->name}}
      <option>
      @endforeach
        @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label for="tinymce-nearby">Nearby</label>
            <select class="form-control  select_near" name="nearby[]" id="nearby" multiple="multiple"
            style="width:100%">
            @foreach($nearBye as $nearBye)
        @foreach($property->property_near_by as $key => $by)
      <option value="{{$nearBye->id}}" {{ $nearBye->id == @$by->near_by_id ? 'selected' : '' }}>
        {{$nearBye->name}}
      <option>
      @endforeach
        @endforeach
            </select>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group propertCondition">
            <label for="tinymce-nearby">Condition</label>
            <select class="form-control  select_condition" name="condition_id" id="condition_id"
            style="width:100%">
            @foreach($condition as $condition)
        <option value="{{$condition->id}}" {{ $condition->id == @$property->propertyCondition->condition_id ? 'selected' : '' }}>{{$condition->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group propertFurnish">
            <label for="tinymce-nearby">Furnishing</label>
            <select class="form-control select_furnish" name="furnish_id" id="furnish_id" style="width:100%">
            @foreach($furnish as $furnish)
        <option value="{{$furnish->id}}" {{ $furnish->id == @$property->propertyFurnish->furnish_id ? 'selected' : '' }}>{{$furnish->name}}</option>
      @endforeach
            </select>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          <div class="form-group">
            <label class="form-label">Square Feet/Area(sqm)</label>
            <input type="number" class="form-control" name="area" required style="height:30px;border-radius: 5px;"
            value="{{@$property->property_area->value}}">
            @error('area') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-4 propertyBeadRoam">
          <div class="form-group form-float">
            <label class="form-label">Bedroom</label>
            <input type="number" class="form-control" name="bedroom" style="height:30px;border-radius: 5px;"
            value="{{@$property->bead_room->value}}">
            @error('bedroom') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
          <div class="col-md-4 propertyBathRoam">
          <div class="form-group form-float">
            <label class="form-label">bathroom</label>
            <input type="number" class="form-control" name="bathroom" style="height:30px;border-radius: 5px;"
            value="{{@$property->property_barth->value}}">
            @error('bathroom') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          </div>
        </div>
        </div>

      </div>


      <div class="card card-footer">
        <div class="form-group" style="float:right">
        <button type="submit" class="btn btn-primary btnSubmit" id="submit-all">Post Ad</button>
        </div>
      </div>
      </form>
    </div>
    <div class="col-md-2"></div>
    </div>
  </div>
@endsection

@section('bot')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
    let selectedFiles = [];
    let existingImages = [];

    // Initialize existing images (ensure unique)
    function initExistingImages() {
      existingImages = [];
      $('input[name="existing_images[]"]').each(function () {
      const val = $(this).val();
      if (!existingImages.includes(val)) {
        existingImages.push(val);
      }
      });
    }
    initExistingImages();

    // Handle new file selection
    $('#property_images').on('change', function (event) {
      const files = event.target.files;
      selectedFiles = Array.from(files);

      // Check total images don't exceed 5
      if (existingImages.length + selectedFiles.length > 5) {
      alert('Maximum 5 images allowed (including existing ones)');
      $(this).val('');
      selectedFiles = [];
      return;
      }

      // Clear previous new file previews (keep existing images)
      $('#image-preview').find('.image-container').not('[id^="existing-image-"]').remove();

      // Display new file previews
      selectedFiles.forEach((file, index) => {
      const reader = new FileReader();

      reader.onload = function (e) {
        const previewDiv = $('<div>', {
        class: 'image-container',
        id: 'new-image-' + index
        });

        const img = $('<img>', {
        src: e.target.result,
        class: 'preview-image'
        });

        const removeBtn = $('<button>', {
        type: 'button',
        class: 'remove-image'
        }).html('×').click(function () {
        $(this).parent().remove();
        selectedFiles = selectedFiles.filter((_, i) => i !== index);
        updateFileInput();
        });

        previewDiv.append(img).append(removeBtn);
        $('#image-preview').append(previewDiv);
      };

      reader.readAsDataURL(file);
      });
    });

    // Handle removal of existing images
    $(document).on('click', '.image-container[id^="existing-image-"] .remove-image', function () {
      const imagePath = $(this).data('image-path');
      const imageId = $(this).data('image-id');

      // Remove from existingImages array
      existingImages = existingImages.filter(path => path !== imagePath);

      // Remove the hidden input
      $(`input[name="existing_images[]"][value="${imagePath}"]`).remove();

      // Remove the preview
      $(this).parent().remove();
    });

    // Update the file input after removal
    function updateFileInput() {
      const dataTransfer = new DataTransfer();
      selectedFiles.forEach(file => dataTransfer.items.add(file));
      $('#property_images')[0].files = dataTransfer.files;
    }

    // Form submission
    $('form[name="property-form"]').submit(function (e) {
      e.preventDefault();

      // Validate at least one image exists
      if (existingImages.length === 0 && selectedFiles.length === 0) {
      alert('Please upload at least one image');
      return;
      }

      const formData = new FormData(this);

      // Clear any existing file data
      formData.delete('property_images[]');

      // Append new files manually
      selectedFiles.forEach(file => {
      formData.append('property_images[]', file);
      });

      // Clear and append existing images
      formData.delete('existing_images[]');
      existingImages.forEach(path => {
      formData.append('existing_images[]', path);
      });

      $.ajax({
      url: $(this).attr('action') || '/agent/update/properties',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        $('.btnSubmit').prop('disabled', true).html('Processing...');
      },
      success: function (response) {
        if (response.success) {
        window.location.href = '/agent/preview/property/' + response.property_id;
        } else {
        alert(response.message || 'Update failed');
        }
      },
      error: function (xhr) {
        const error = xhr.responseJSON?.error || 'An error occurred';
        alert(error);
      },
      complete: function () {
        $('.btnSubmit').prop('disabled', false).html('Post Ad');
      }
      });
    });
   

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
      if (id == 1 || id == 6) {
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

      $(".select_condition").select2({
      placeholder: 'Select Condition',
      allowClear: true,

      })
      $(".select_furnish").select2({
      placeholder: 'Select Furnish',
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

      $(".select_currency").select2({
      placeholder: 'Select',
      allowClear: true,

      })
    });
    </script>

@endsection