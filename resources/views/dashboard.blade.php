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
    {{-- Kartu Merah (gradasi merah tua ke muda) --}}
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card text-white" 
            style="background: linear-gradient(135deg, #E53935, #FF6F61); border: none; box-shadow: 0 4px 10px rgba(229,57,53,0.4);">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Pendapatan Bulan Ini</h4>
                <h2 class="mb-5">Rp 12.000.000</h2>
                <h6 class="card-text">Naik 15% dari bulan lalu</h6>
            </div>
        </div>
    </div>

    {{-- Kartu Kuning (gradasi kuning tua ke muda) --}}
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card text-dark" 
            style="background: linear-gradient(135deg, #FDD835, #FFF176); border: none; box-shadow: 0 4px 10px rgba(253,216,53,0.4);">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Pengeluaran Bulan Ini</h4>
                <h2 class="mb-5">Rp 7.500.000</h2>
                <h6 class="card-text">Turun 5% dari bulan lalu</h6>
            </div>
        </div>
    </div>

    {{-- Kartu Biru (gradasi biru tua ke muda) --}}
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card text-white" 
            style="background: linear-gradient(135deg, #0288D1, #4FC3F7); border: none; box-shadow: 0 4px 10px rgba(2,136,209,0.4);">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">Untung Bulan Ini</h4>
                <h2 class="mb-5">Rp 4.500.000</h2>
                <h6 class="card-text">Stabil</h6>
            </div>
        </div>
    </div>
</div>
@endsection
