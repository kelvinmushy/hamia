@extends('backend.agent.app')

@section('content')
    <div class="container mt-4">
        <h4 class="agent-title">Maelezo ya Eneo la Mradi</h4>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Ukubwa wa Eneo: {{ $landDetails['size'] }} m²</h5>
                        <h6>Bei ya Eneo: {{ number_format($landDetails['price'], 2) }} TSH</h6>
                        <!-- Add any additional details you need -->
                        <a href="{{ route('agent.projects.index') }}" class="btn btn-secondary">Rudi kwenye Orodha ya Miradi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
