<!-- Uza Modal -->
<div class="modal fade" id="uzaModal" tabindex="-1" aria-labelledby="uzaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uzaModalLabel">Uza Sehemu ya Mradi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uzaForm" method="POST" action="{{ route('agent.project.division.payment.store', ['project' => $project->id, 'division' => $division->id]) }}">
                    @csrf
                
                    <input type="hidden" id="division_id" name="division_id">

                    <!-- Client Selection -->
                    <div class="form-group">
                        <label for="client_id">Mteja</label>
                        <select name="customer_id" id="client_id" class="form-control" required>
                            <option value="">-- Chagua Mteja --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sell Price -->
                    <div class="form-group">
                        <label for="sell_price">Bei ya Sehemu</label>
                        <input type="number" name="sell_price" id="sell_price1" class="form-control"  readonly>
                    </div>

                    <!-- Payment Type Selection (Cash or Installments) -->
                    <div class="form-group">
                        <label for="payment_type">Aina ya Malipo</label>
                        <select name="payment_type" id="payment_type" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="installments">Installments</option>
                        </select>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="form-group">
                        <label for="payment_method">Umelipa Kwa</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="tigo_pesa">Tigo Pesa</option>
                            <option value="voda_m_pesa">Vodafone M-Pesa</option>
                            <option value="halopesa">Halopesa</option>
                            <option value="airtel_money">Airtel Money</option>
                            <option value="selcom">Selcom</option>
                            <option value="mamba">Mamba</option>
                            <option value="easy_pesa">Easy Pesa</option>
                        </select>
                    </div>

                    <!-- Payment Amount -->
                    <div class="form-group">
                        <label for="payment" id="payment_label">Malipo ya Awali/Maliza</label>
                        <input type="number" name="payment" id="payment" class="form-control" required>
                    </div>

                    <!-- Installment Details (Hidden by Default) -->
                    <div id="installment_fields" style="display: none;">
                        <div class="form-group">
                            <label for="installment_count">Idadi ya Malipo</label>
                            <input type="number" id="installment_count" name="installment_count" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="payment_frequency">Aina ya Malipo (Week/Month)</label>
                            <select id="payment_frequency" name="payment_frequency" class="form-control">
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
