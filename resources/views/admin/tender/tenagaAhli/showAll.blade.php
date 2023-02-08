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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Ijazah</th>
                                <th>Keahlian/SKS/SKA</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $i = 1;
                            @endphp
                            @foreach ($peserta as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td><span class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{$item->id}}">Periksa ({{ $item->countIjazah() }})</span></td>
                                    <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">File Ijazah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @if (count($item->ijazah) > 0)
                                                            @foreach ($item->ijazah as $ij)
                                                                <div class="col-xs-12 col-md-6 col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">{{ strlen($ij->nama) > 10 ? substr($ij->nama, 0, 10).'...' : $ij->nama}}</label>
                                                                        <div class="row">
                                                                            <div class="col-xl-1"><a href="#showPreview" onclick="changePreview('{{$ij->file}}', '{{$ij->nama}}')" data-toggle="modal" data-target="#showPreview" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat file"><i class="fa fa-file"></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td><span class="btn btn-primary" data-toggle="modal" data-target="#ska-{{$item->id}}">Periksa ({{ $item->countSka() }})</span></td>
                                    <div class="modal fade" id="ska-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">File Ska</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @if (count($item->ska) > 0)
                                                            @foreach ($item->ska as $ska)
                                                                <div class="col-xs-12 col-md-6 col-xl-4">
                                                                    <div class="form-group">
                                                                        <label for="">{{ strlen($ska->nama) > 10 ? substr($ska->nama, 0, 10).'...' : $ska->nama}}</label>
                                                                        <div class="row">
                                                                            <div class="col-xl-1"><a href="#showPreview" onclick="changePreview('{{$ska->file}}', '{{$ska->nama}}')" data-toggle="modal" data-target="#showPreview" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat file"><i class="fa fa-file"></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <td><span class="btn btn-info btn-sm" style="color: #fff;cursor: default">{{$item->checkStatus()}}</span></td>
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
<div class="modal fade" id="showPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <iframe src="" style="height: 550px; width: 450px" id="changeMe" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function changePreview(p, name) {
            if (p != null) $('#changeMe').attr('src', p)
            $('#exampleModalLabel').text(name)
        }
    </script>
@endsection