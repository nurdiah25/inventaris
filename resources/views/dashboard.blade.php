@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #f2f2f2; min-height: 200vh; padding: 0;">
    
    <!-- Judul Dashboard di sebelah kiri -->
    <div class="row">
        <div class="col-md-12" style="background-color: #ffffff; padding: 20px 30px 10px 30px;">
            <h3 class="font-weight-bold mb-0">Dashboard</h3>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Kontainer 1: Gudang Pusat -->
        <div class="col-md-6 mb-4">
            <div class="card text-center" 
                style="background-color: #ffffff; border-radius: 12px;
                       box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: none;
                       min-height: 270px;">
                <div class="card-body d-flex flex-column justify-content-start pt-4">
                    <h5 class="card-title mb-4" style="font-size: 1.6rem; font-weight: 600;">Gudang Pusat</h5>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Jenis Barang</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $jumlahGudangPusat ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Barang Keseluruhan</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $totalGudangPusat ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontainer 2: Cabang Banjarbaru -->
        <div class="col-md-6 mb-4">
            <div class="card text-center" 
                style="background-color: #ffffff; border-radius: 12px;
                       box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: none;
                       min-height: 270px;">
                <div class="card-body d-flex flex-column justify-content-start pt-4">
                    <h5 class="card-title mb-4" style="font-size: 1.6rem; font-weight: 600;">Cabang Banjarbaru</h5>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Jenis Barang</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $jumlahBanjarbaru ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Barang Keseluruhan</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $totalBanjarbaru ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kontainer 3: Cabang Martapura -->
        <div class="col-md-6 mb-4">
            <div class="card text-center" 
                style="background-color: #ffffff; border-radius: 12px;
                       box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: none;
                       min-height: 270px;">
                <div class="card-body d-flex flex-column justify-content-start pt-4">
                    <h5 class="card-title mb-4" style="font-size: 1.6rem; font-weight: 600;">Cabang Martapura</h5>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Jenis Barang</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $jumlahMartapura ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Barang Keseluruhan</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $totalMartapura ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontainer 4: Cabang Liang Anggang -->
        <div class="col-md-6 mb-4">
            <div class="card text-center" 
                style="background-color: #ffffff; border-radius: 12px;
                       box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: none;
                       min-height: 270px;">
                <div class="card-body d-flex flex-column justify-content-start pt-4">
                    <h5 class="card-title mb-4" style="font-size: 1.6rem; font-weight: 600;">Cabang Liang Anggang</h5>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Jenis Barang</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $jumlahLiangAnggang ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card" 
                                style="background-color: #e0ecf8; border-radius: 8px; padding: 15px; 
                                       min-height: 140px; display: flex; flex-direction: column; justify-content: center;">
                                <h6>Jumlah Barang Keseluruhan</h6>
                                <p style="font-size: 1.5rem; margin-top: 12px;">{{ $totalLiangAnggang ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
