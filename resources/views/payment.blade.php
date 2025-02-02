@extends('layouts.main')

@section('container')

<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Payment List</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Payment Number</th>
                            <th>Transaction Number</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Term Length</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_number }}</td>
                            <td>{{ $payment->sale->transaction_number }}</td>
                            <td>{{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $payment->payment_method === 'cash' ? 'bg-success' : 'bg-primary' }}">
                                    {{ strtoupper($payment->payment_method) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $payment->status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                    {{ strtoupper($payment->status) }}
                                </span>
                            </td>
                            <td>{{ $payment->term_length ? $payment->term_length . ' Months' : '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->due_date)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection