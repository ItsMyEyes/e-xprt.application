@extends('layouts.app')
@section('breadcrumb', 'Tenaga Ahli')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-xl-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{ request()->get('name') }}" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_ktp" value="{{ request()->get('no_ktp') }}" placeholder="No.KTP">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="tingkat_ijazah" value="{{ request()->get('tingkat_ijazah') }}" placeholder="Tingkat Ijazah">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="tingkat_ska" value="{{ request()->get('tingkat_ska') }}" placeholder="Tingkat SKA">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <h3 class="pull-left">Data Tenaga Ahli</h3>
                    <a href="{{ route('tenagaAhli.create') }}" class="btn btn-primary btn-md pull-right"><i class="fa fa-plus"></i></a>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No.KTP</th>
                                <th>Ijazah</th>
                                <th>SKA</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $item)
                                <tr>
                                    <td><a href="{{ route('tenagaAhli.show', $item->id) }}" style="text-decoration: underline;color: blue">{{ $item->nama }}</a></td>
                                    <td>{{ "******".substr($item->ktp, -3) }}</td>
                                    <td>{{ $item->countIjazah() }}</td>
                                    <td>{{ $item->countSka() }}</td>
                                    @if ($item->checkStatus())
                                        <td><span class="btn btn-success btn-sm" style="color: #fff;cursor: default">Aman</span></td>
                                        @else
                                        <td><span class="btn btn-danger btn-sm" style="color: #fff;cursor: default">Tidak aman</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('tenagaAhli.edit', $item->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        @if ($item->checkAvailableDelete())
                                            <a href="{{ route('tenagaAhli.del', $item->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        @endif
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
