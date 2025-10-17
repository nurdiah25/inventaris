@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Dashboard</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Kartu Putih dengan bayangan halus --}}
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card" 
            style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: none;">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Pendapatan Bulan Ini</h4>
                <h2 class="mb-3">Rp 12.000.000</h2>
                <h6 class="card-text text-muted">Naik 15% dari bulan lalu</h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card" 
            style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: none;">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Pengeluaran Bulan Ini</h4>
                <h2 class="mb-3">Rp 7.500.000</h2>
                <h6 class="card-text text-muted">Turun 5% dari bulan lalu</h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card" 
            style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: none;">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Untung Bulan Ini</h4>
                <h2 class="mb-3">Rp 4.500.000</h2>
                <h6 class="card-text text-muted">Stabil</h6>
            </div>
        </div>
    </div>
</div>
@endsection
