<!-- Unit Modal -->
<div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="unitModalLabel">Add New Unit</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="unitForm">
                @csrf
                <input type="hidden" name="unit_id" id="unit_id">

                <div class="modal-body">
                    <!-- Property Selection -->
                    <div class="mb-3">
                        <label for="property_id" class="form-label">Property</label>
                        <select name="property_id" id="property_id" class="form-control" required>
                            <option value="">-- Select Property --</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}">{{ $property->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Unit Name -->
                    <div class="mb-3">
                        <label for="unit_name" class="form-label">Unit Name</label>
                        <input type="text" name="unit_name" id="unit_name" class="form-control" placeholder="e.g. Apt 1A" required>
                    </div>

                    <!-- Unit Type -->
                    <div class="mb-3">
                        <label for="unit_type" class="form-label">Unit Type</label>
                        <select name="unit_type" id="unit_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <option value="apartment">Apartment</option>
                            <option value="office">Office</option>
                            <option value="shop">Shop</option>
                            <option value="studio">Studio</option>
                            <option value="warehouse">Warehouse</option>
                        </select>
                    </div>

                    <!-- Unit Size -->
                    <div class="mb-3">
                        <label for="size" class="form-label">Size (in m²)</label>
                        <input type="number" name="size" id="size" step="0.01" class="form-control" placeholder="e.g. 45.5">
                    </div>

                    <!-- Rent Price -->
                    <div class="mb-3">
                        <label for="rent_price" class="form-label">Monthly Rent Price</label>
                        <input type="number" name="rent_price" id="rent_price" step="0.01" class="form-control" required>
                    </div>

                    <!-- Additional Fields for Apartments -->
                    <div id="apartment-fields" style="display: none;">
                        <!-- Floor Number -->
                        <div class="mb-3">
                            <label for="floor_number" class="form-label">Floor Number</label>
                            <input type="number" name="floor_number" id="floor_number" class="form-control" required>
                        </div>

                        <!-- Number of Bedrooms -->
                        <div class="mb-3">
                            <label for="num_bedrooms" class="form-label">Number of Bedrooms</label>
                            <input type="number" name="num_bedrooms" id="num_bedrooms" class="form-control" required>
                        </div>

                        <!-- Number of Bathrooms -->
                        <div class="mb-3">
                            <label for="num_bathrooms" class="form-label">Number of Bathrooms</label>
                            <input type="number" name="num_bathrooms" id="num_bathrooms" class="form-control" required>
                        </div>

                        <!-- Balcony -->
                        <div class="mb-3">
                            <label for="balcony" class="form-label">Balcony</label>
                            <select name="balcony" id="balcony" class="form-control">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="fa fa-save me-1"></i> Save Unit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


