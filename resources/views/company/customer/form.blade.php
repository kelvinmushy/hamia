<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="customerForm" method="POST" action="{{ route('agent.customers.store') }}">
            @csrf
            <input type="hidden" name="customer_id" id="customerId"> <!-- Hidden input for customer ID -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                        <small class="text-danger" id="nameError"></small>
                    </div>
                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required />
                        <small class="text-danger" id="phoneError"></small>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Region</label>
                        <select name="region_id" class="form-control select_region" id="region_id" required>
                            <option value="">-- Select Region --</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>District</label>
                        <select name="district_id" class="form-control select_district" id="district_id" required>
                            <option value="">-- Select District --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
