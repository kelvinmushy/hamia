@extends('backend.agent.app')

@section('content')
    <div class="agent-dashboard">
        <div class="container mt-4">
            <h4 class="agent-title">Maelezo ya Mradi</h4>

            <div class="row">
                @include('agent.sidebar')

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- Project Name and General Info -->
                            <h5>Jina la Mradi: {{ $project->name }}</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Field</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Aina ya Mradi</td>
                                        <td>{{ ucfirst($project->type) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukubwa wa Eneo (m²)</td>
                                        <td>{{ $project->size_in_sq_m }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukubwa wa Eneo la Makazi (m²)</td>
                                        <td>{{ $project->residential_size }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukubwa wa Eneo la Mashamba (m²)</td>
                                        <td>{{ $project->farm_size }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Payment Information -->
                            <h5>Maelezo ya Malipo</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Field</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Aina ya Malipo</td>
                                        <td>{{ ucfirst($project->payments->payment_type) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gharama ya Jumla</td>
                                        <td>{{ number_format($project->payments->total_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kiasi Kilicholipwa</td>
                                        <td>{{ number_format($project->payments->amount_paid, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muda wa Malipo (Miezi)</td>
                                        <td>{{ $project->payments->installment_period }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kiasi cha Kila Awamu</td>
                                        <td>{{ number_format($project->payments->installment_amount, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Payment Status -->
                            <h5>Status ya Malipo</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($project->payments->payment_status == 'completed')
                                                <span class="badge bg-success">Malipo Imekamilika</span>
                                            @elseif($project->payments->payment_status == 'ongoing')
                                                <span class="badge bg-warning">Malipo yanaendelea</span>
                                            @else
                                                <span class="badge bg-danger">Malipo hayajaanza</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Location Information -->
                            <h5>Mahali pa Mradi</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Field</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mkoa</td>
                                        <td>{{ $project->location->district->region->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Wilaya</td>
                                        <td>{{ $project->location->district->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sub-location</td>
                                        <td>{{ $project->location->sub_location }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Repayment History Section -->
                            <h5>Historia ya Malipo</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tarehe ya Malipo</th>
                                        <th>Kiasi cha Malipo</th>
                                        <th>Aina ya Malipo</th>
                                        <th>Salio Liliobakia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->repayments as $index => $repayment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($repayment->payment_date)->format('d M Y') }}</td>
                                            <td>{{ number_format($repayment->payment_amount, 2) }}</td>
                                            <td>{{ ucfirst($repayment->payment_method) }}</td>
                                            <td>{{ number_format($repayment->remaining_balance, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Back to Project List -->
                            <a href="{{ route('agent.projects.index') }}" class="btn btn-secondary">Rudi kwenye Orodha ya Miradi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
