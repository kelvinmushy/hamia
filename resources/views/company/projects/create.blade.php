@extends('backend.agent.app')

@section('content')
    <div class="container mt-4">
        <h4 class="agent-title">Sajili Mradi Mpya</h4>

        <form id="projectRegistrationForm" enctype="multipart/form-data">
            @csrf

            <!-- Jina la Mradi -->
            <div class="form-group">
                <label for="project_name">Jina la Mradi</label>
                <input id="project_name" name="name" type="text" class="form-control" required>
            </div>

            <!-- Aina ya Mradi -->
            <div class="form-group">
                <label for="project_type">Aina ya Mradi</label>
                <select class="form-control" name="type" id="project_type" required>
                    <option value="">Chagua Aina</option>
                    <option value="residential">Makazi</option>
                    <option value="farm_land">Mashamba</option>
                    <option value="mixed">Mchanganyiko (Makazi + Mashamba)</option>
                </select>
            </div>

            <!-- Ukubwa wa Eneo Jumla -->
            <div class="form-group">
                <label for="size">Ukubwa wa Eneo Jumla (m²)</label>
                <input id="size" name="size" type="number" class="form-control" required>
            </div>

            <!-- Mgawanyo wa Makazi na Mashamba (Unaonekana tu ikiwa mradi ni mchanganyiko) -->
            <div id="allocation_section" style="display: none;">
                <h5>Mgawanyo wa Eneo</h5>
                <div class="form-group">
                    <label for="residential_size">Eneo la Makazi (m²)</label>
                    <input id="residential_size" name="residential_size" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="farm_size">Eneo la Mashamba (m²)</label>
                    <input id="farm_size" name="farm_size" type="number" class="form-control">
                </div>
            </div>

            <!-- Aina ya Malipo -->
            <div class="form-group">
                <label for="payment_type">Aina ya Malipo</label>
                <select class="form-control" name="payment_type" id="payment_type" required>
                    <option value="">Chagua Aina ya Malipo</option>
                    <option value="cash">Cash</option>
                    <option value="installment">Installment</option>
                </select>
            </div>

            <!-- Jumla ya Gharama -->
            <div class="form-group">
                <label for="price">Jumla ya Gharama</label>
                <input id="price" name="price" type="number" class="form-control" required>
            </div>

            <!-- Kiasi Kilicholipwa -->
            <div class="form-group">
                <label for="amount_paid">Kiasi Kilicholipwa</label>
                <input id="amount_paid" name="amount_paid" type="number" class="form-control" required>
            </div>

            <!-- Sehemu ya Malipo kwa Awamu -->
            <div id="installment_section" style="display: none;">
                <h5>Mpangilio wa Malipo kwa Awamu</h5>
                <div class="form-group">
                    <label for="installment_period">Muda wa Malipo (Miezi)</label>
                    <input id="installment_period" name="installment_period" type="number" class="form-control">
                </div>

                <div class="form-group">
                    <label for="installment_amount">Kiasi cha Kila Awamu</label>
                    <input id="installment_amount" name="installment_amount" type="number" class="form-control">
                </div>
            </div>

            <button class="btn btn-primary w-100" type="submit">
                <i class="fa fa-save"></i> Sajili Mradi
            </button>
        </form>
    </div>
@endsection

@section('bot')
    <script>
        $(document).ready(function () {
            $(".select_region").select2({ placeholder: 'Chagua Mkoa' });
            $(".select_district").select2({ placeholder: 'Chagua Wilaya' });

            // On change project type
            $('#project_type').on('change', function () {
                if ($(this).val() === 'mixed') {
                    $('#allocation_section').slideDown();
                } else {
                    $('#allocation_section').slideUp();
                }
            });

            // On change payment type
            $('#payment_type').on('change', function () {
                if ($(this).val() === 'installment') {
                    $('#installment_section').slideDown();
                } else {
                    $('#installment_section').slideUp();
                }
            });
        });
    </script>
@endsection