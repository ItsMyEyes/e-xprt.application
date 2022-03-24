@extends('layouts.app')
@section('breadcrumb', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <h3 class="pull-left">Tenaga Ahli</h3>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No.KTP</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ "******".substr($item->ktp, -3) }}</td>
                                    @if ($item->checkStatus())
                                        <td><span class="btn btn-success btn-sm" style="color: #fff;cursor: default">Aman</span></td>
                                        @else
                                        <td><span class="btn btn-warning btn-sm" style="color: #fff;cursor: default">Belum Diperbaiki</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('tenagaAhli.show', $item->id) }}" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection