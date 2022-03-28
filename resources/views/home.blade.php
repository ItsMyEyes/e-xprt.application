@extends('layouts.app')
@section('content')

<div class="row mb-3">
    <div class="col-12">
            <button onclick="startFCM()" style="width: 100%" class="btn btn-success" style="color: #fff;">Simpan token dan Izinkan pemberitahuan</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-1">
            <div class="card-body">
                <h3 class="card-title text-white">Tender</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{$tender}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-building"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-2">
            <div class="card-body">
                <h3 class="card-title text-white">Jumlah Tenaga Ahli</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{$tenaga}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-user"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-3">
            <div class="card-body">
                <h3 class="card-title text-white">Pengguna</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{$penguna}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-4">
            <div class="card-body">
                <h3 class="card-title text-white">Notifikasi</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">{{$notifikasi}}</h2>
                </div>
                <span class="float-right display-5 opacity-5"><i class="mdi mdi-bell-outline"></i></span>
            </div>
        </div>
    </div>
</div>

@endsection