<div class="modal fade" id="projectDivision" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="projectDivisionLabel">Ongeza Sehemu ya Mradi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Funga"></button>
            </div>

            <div class="modal-body">
                <form id="divisionForm">
                    @csrf

                    <!-- Jina la Sehemu -->
                    <div class="mb-3">

                        <input type="hidden" name="project_id" id="project_id" class="form-control" maxlength="200"
                            required value="{{$project_id}}">
                        <input type="hidden" name="division_id" id="division_id">

                    </div>

                    <!-- Project ID (hidden) -->


                    <!-- Aina ya Sehemu -->
                    <div class="mb-3">

                        <input type="hidden" name="division_type" id="division_type" value="{{$type}}" />

                    </div>

                    <!-- Ukubwa -->
                    <div class="mb-3">
                        <label for="size" class="form-label">Ukubwa (m²)</label>
                        <input type="number" name="size" id="size" class="form-control" step="0.01" required>
                    </div>

                    <!-- Bei ya Uuzaji -->
                    <div class="mb-3">
                        <label for="sell_price" class="form-label">Bei ya Uuzaji</label>
                        <input type="number" name="sell_price" id="sell_price" class="form-control" step="0.01"
                            required>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Hifadhi Sehemu</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>