@extends('layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
    <div class="row">
        <div class="col">
            <h1 class="h2">Daftar Komisi Marketing</h1>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <table id="komisiTable" class="table table-custom">
                <thead>
                    <tr>
                        <th>Marketing</th>
                        <th>Bulan</th>
                        <th>Omzet</th>
                        <th>Komisi %</th>
                        <th>Komisi Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($komisi as $data)
                        <tr>
                            <td>{{ $data['marketing'] }}</td>
                            <td>{{ $data['bulan'] }}</td>
                            <td>{{ number_format($data['omzet'], 0, ',', '.') }}</td>
                            <td>{{ $data['komisi_persen'] }}%</td>
                            <td>{{ number_format($data['komisi_nominal'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection