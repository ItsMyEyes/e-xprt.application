@extends('layouts.app')
@section('breadcrumb', 'Dashboard')
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
                                <input type="text" class="form-control" name="kode_ska" value="{{ request()->get('kode_ska') }}" placeholder="Kode Ska">
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
                    <h3 class="pull-left">Tenaga Ahli</h3>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Ijazah</th>
                                <th>Keahlian/SKK/SKA</th>
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
                                    <td>
                                        @if (count($item->ijazah) > 0)
                                        <ul>
                                            @foreach ($item->ijazah as $ij)
                                                <li>{{ $ij->nama }} - {{ $ij->tingkat }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($item->ska) > 0)
                                        <ul>
                                            @foreach ($item->ska as $ska)
                                                <li>{{ $ska->nama }} - {{ $ska->tingkat }}</li>
                                            @endforeach
                                        </ul>
                                        @endif</td>
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