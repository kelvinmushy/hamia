<!-- Repayment Modal -->
<div class="modal fade" id="repaymentModal" tabindex="-1" aria-labelledby="repaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="repaymentModalLabel">Lipa Malipo ya Awamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="repaymentForm">
                    {{ csrf_field() }}
                    <input type="text" id="pay_project_id" name="project_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Tarehe ya Malipo</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kiasi cha Kulipa (TZS)</label>
                        <input type="number" name="payment_amount" id="payment_amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Njia ya Malipo</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="mpesa">M-Pesa</option>
                            <option value="tigo_pesa">Tigo Pesa</option>
                            <option value="airtel_money">Airtel Money</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Lipa Sasa</button>
                </form>
            </div>
        </div>
    </div>
</div>
