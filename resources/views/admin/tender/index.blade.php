@extends('layouts.app')
@section('breadcrumb', 'Tender')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <h3 class="pull-left">Tender</h3>
                    <a href="{{ route('tender.create') }}" class="btn btn-primary btn-md pull-right"><i class="fa fa-plus"></i></a>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tender</th>
                                <th>Nama Owner</th>
                                <th>Divisi</th>
                                <th>Tenaga Ahli</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($tender as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->nama_tender }}</td>
                                    <td>{{ $item->nama_perusahaan }}</td>
                                    <td>{{ $item->divis_count }}</td>
                                    <td><a href="{{ route('tender.tenagaAhli.show', $item->id) }}" class="btn btn-success btn-md">Tenaga ahli ({{ $item->countPeserta() }})</a></td>
                                    <td><span class="btn btn-{{ $item->getColour() }} btn-sm" style="cursor: text">{{ $item->status }}</span></td>
                                    <td>
                                        <a href="{{ route('tender.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('tender.destroy', $item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        <a href="/export/peserta/{{ $item->id }}/tender" class="btn btn-success btn-sm">Cetak</a>
                                        <a href="/sendnotificaiton?id={{$item->id}}" class="btn btn-info btn-sm">Notifikasi Ke HR</a>
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
