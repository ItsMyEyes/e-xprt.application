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
                    <h3 class="pull-left">Pilih Tenaga Ahli Tender {{ $tender->nama_tender }}</h3>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No.KTP</th>
                                <th>Ijazah</th>
                                <th>SKA</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $item)
                                @if (!$item->checkChooseOnTender($tender->id))
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ "******".substr($item->ktp, -3) }}</td>
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
                                    <td>
                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#pilih-{{$item->id}}">Pilih</a>
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#komentar-{{$item->id}}">Komentar</a>
                                        <div class="modal fade" id="komentar-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Comment {{$item->nama}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('tender.tenagaAhli.comment', $tender->id) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="not_clear">
                                                            <input type="hidden" name="type" value="{{auth()->user()->role == 'hc' ? 'pemasaran' : 'hc'}}">
                                                            <input type="hidden" name="id_peserta" value="{{$item->id}}">
                                                            <input type="hidden" name="id_tender" value="{{$tender->id}}">
                                                            <div class="form-group">
                                                                <label for="">Komentar</label>
                                                                <textarea name="text" id="" rows="10" class="form-control">{{ $item->getCommentar($tender->id) }}</textarea>
                                                            </div>
                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="pilih-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pilih {{$item->nama}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('tender.tenagaAhli.choose', ['id' => $item->id, 'id_tender' => $tender->id]) }}" method="get">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="">Jabatan</label>
                                                                <input type="text" name="divisi" id="" class="form-control">
                                                            </div>
                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
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
