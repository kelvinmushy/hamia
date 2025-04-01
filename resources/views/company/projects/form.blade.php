<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Ongeza Mradi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="projectForm"  enctype="multipart/form-data">
                    {{ csrf_field() }}  
                    <input type="hidden" name="_method" id="formMethod" value="POST"> 
                    <input type="hidden" id="project_id" name="project_id">

                    <div class="mb-3">
                        <label class="form-label">Jina la Mradi</label>
                        <input type="text" name="name" id="project_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Aina ya Mradi</label>
                        <select class="form-control" name="type" id="project_type" required>
                            <option value="residential">Makazi</option>
                            <option value="farm_land">Mashamba</option>
                            <option value="mixed">Mchanganyiko</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ukubwa wa Eneo Jumla (m²)</label>
                        <input type="number" name="size_in_sq_m" id="size" class="form-control" required>
                    </div>

                    <div id="allocation_section" class="d-none">
                        <h5>Mgawanyo wa Eneo</h5>
                        <div class="mb-3">
                            <label class="form-label">Eneo la Makazi (m²)</label>
                            <input type="number" name="residential_size" id="residential_size" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Eneo la Mashamba (m²)</label>
                            <input type="number" name="farm_size" id="farm_size" class="form-control">
                        </div>
                    </div>

                    <!-- 📌 Location Fields -->
                    <h5>Mahali pa Mradi</h5>
                    <div class="mb-3">
                        <label class="form-label">Mkoa</label>
                        <select class="form-control select_region" name="region" id="region" required style="width: 100%">
                            <option value="">Chagua Mkoa</option>
                            @foreach ($region as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Wilaya</label>
                        <select class="form-control select_district" name="district_id" id="district_id" required style="width: 100%">
                            <option value="">Chagua Wilaya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Aina ya Malipo</label>
                        <select class="form-control" name="payment_method" id="payment_method" required>
                            <option value="cash">Cash</option>
                            <option value="installment">Installment</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumla ya Gharama</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kiasi Kilicholipwa</label>
                        <input type="number" name="amount_paid" id="amount_paid" class="form-control">
                    </div>

                    <div id="installment_section" class="d-none">
                        <h5>Mpangilio wa Malipo kwa Awamu</h5>
                        <div class="mb-3">
                            <label class="form-label">Muda wa Malipo (Miezi)</label>
                            <input type="number" name="installment_period" id="installment_period" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kiasi cha Kila Awamu</label>
                            <input type="number" name="installment_amount" id="installment_amount" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Hifadhi</button>
                </form>
            </div>
        </div>
    </div>
</div>
