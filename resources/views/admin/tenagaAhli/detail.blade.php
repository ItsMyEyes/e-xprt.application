@extends('layouts.app')
@section('breadcrumb', 'Detail Peserta')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-12">
                        <div class="row">
                            <div class="col col-sm-9 float-left">
                                <table class="table table-hover table-no-br">
                                    <tr>
                                        <td width="30%">Nama Lengkap</td>
                                        <td width="3%">:</td>
                                        <td>{{ $peserta->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>No.KTP</td>
                                        <td>:</td>
                                        <td>{{ $peserta->ktp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat lahir</td>
                                        <td>:</td>
                                        <td>{{ $peserta->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>{{ $peserta->tanggal_lahir }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Ijazah</h2>
                <table class="table table-hover table-no-br">
                    <tr>
                        <th>Bidang Studi</th>
                        <th>Tingkat</th>
                        <th>Tahun Lulus</th>
                        <th>Action</th>
                    </tr>
                    @if (count($peserta->ijazah) > 0)
                        @foreach ($peserta->ijazah as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tingkat }}</td>
                                <td>{{ $item->tahun_lulus }}</td>
                                <td><a href="#showPreview" onclick="changePreview('{{$item->file}}', '{{$item->nama}}')" data-toggle="modal" data-target="#showPreview" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat file"><i class="fa fa-file"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">SKA</h2>
                <table class="table table-hover table-no-br">
                    <tr>
                        <th>Bidang Studi</th>
                        <th>Tingkat</th>
                        <th>Berlaku sampai dengan</th>
                        <th>Klasifikasi</th>
                        <th>Action</th>
                    </tr>
                    @if (count($peserta->ska) > 0)
                        @foreach ($peserta->ska as $itemSka )
                            <tr>
                                <td>{{ $itemSka->nama }}</td>
                                <td>{{ $itemSka->tingkat }}</td>
                                <td>{{ $itemSka->berlaku }}</td>
                                <td>{{ $itemSka->klasifikasi }}</td>
                                <td><a href="#showPreview" onclick="changePreview('{{$itemSka->file}}', '{{$itemSka->nama}}')" data-toggle="modal" data-target="#showPreview" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat file"><i class="fa fa-file"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </table>
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
