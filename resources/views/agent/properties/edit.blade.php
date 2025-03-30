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
        <img src="{{ Storage::exists($image->path) ? asset('storage/' . $image->path) : asset($image->path) }}"
        alt="Property Image" class="preview-image">
        <button type="button" class="remove-image" data-image-id="{{ $image->id }}"
        data-image-path="{{ $image->path }}">×</button>
        </div>
      @endforeach
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
});
 </script>
@endsection