@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12 my-4">
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                Back to List
            </a>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Detail</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Payment Number</th>
                                    <td>{{ $payment->payment_number }}</td>
                                </tr>
                                <tr>
                                    <th>Transaction Number</th>
                                    <td>{{ $payment->sale->transaction_number }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>
                                        <span class="badge {{ $payment->payment_method === 'cash' ? 'bg-success' : 'bg-primary' }}">
                                            {{ strtoupper($payment->payment_method) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $payment->status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                            {{ strtoupper($payment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Term Length</th>
                                    <td>{{ $payment->term_length ? $payment->term_length . ' Months' : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td>{{ \Carbon\Carbon::parse($payment->due_date)->format('d M Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($payment->payment_method === 'credit')
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Installment Details</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Installment #</th>
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payment->installments as $installment)
                                        <tr>
                                            <td>{{ $installment->installment_number }}</td>
                                            <td>Rp {{ number_format($installment->installment_amount, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($installment->due_date)->format('d M Y') }}</td>
                                            <td>
                                                <span class="badge {{ $installment->status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ strtoupper($installment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection