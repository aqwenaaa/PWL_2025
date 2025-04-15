@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <!-- Card Selamat Datang -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dashboard</h3>
            <div class="card-tools">x</div>
        </div>
        <div class="card-body">
            <h3>Selamat Datang di Nitipdong.na Point Of Sale System</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- Order Masuk -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $newOrders }}</h3>
                    <p>Order Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag animate__animated animate__fadeIn"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- Grafik Order -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $bounceRate }}<sup style="font-size: 20px">%</sup></h3>
                    <p>Grafik Order</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars animate__animated animate__fadeIn"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- User Baru -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $userRegistrations }}</h3>
                    <p>User Baru</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add animate__animated animate__fadeIn"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- Pembeli Terbanyak -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $uniqueVisitors }}</h3>
                    <p>Pembeli Terbanyak</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph animate__animated animate__fadeIn"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
</div>

@endsection