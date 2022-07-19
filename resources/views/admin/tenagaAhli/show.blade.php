@extends('layouts.app')
@section('breadcrumb', 'Tenaga Ahli')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('tenagaAhli.update', $peserta->id) }}" method="POST" enctype="multipart/form-data" id="step-form-horizontal" class="step-form-horizontal">
                @method("PUT")
                @csrf
                <div>
                    <h4>Data diri</h4>
                    <section  style="overflow-y: scroll;width: 100%">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">Nama</label> --}}
                                    <input type="text" name="name" value="{{ $peserta->nama }}" class="form-control" required placeholder="Full name" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">No. KTP</label> --}}
                                    <input type="text" name="no_ktp" value="{{ $peserta->ktp }}" class="form-control" required placeholder="No. KTP" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">Tempat Lahir</label> --}}
                                    <input type="text" name="tempat_lahir" class="form-control" value="{{ $peserta->tempat_lahir }}"  required placeholder="Tempat Lahir" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">Tanggal Lahir</label> --}}
                                    <input type="date" name="tgl_lahir" class="form-control bootstrapMaterialDatePicker" required value="{{ $peserta->tanggal_lahir }}" placeholder="Full name" >
                                </div>
                            </div>
                            @if (count($peserta->getNotif()) > 0)
                                
                            <div class="col-lg-12 mt-3 alert alert-warning">
                                @foreach ($peserta->getNotif() as $item)
                                    <div>
                                        <h4><a href="{{ route('tenagaAhli.change.status', $item->id) }}" class="btn btn-success btn-sm" style="padding: 0.05rem 0.23rem !important"><i class="fa fa-check"></i></a> {{ $item->tender->nama_tender }}</h4>
                                        {{ $item->text }}
                                    </div><br>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </section>
                    <h4>Ijazah</h4>
                    <section style="overflow-y: scroll;width: 100%">
                        <div class="row">
                            <div class="col-lg-12">
                                @php
                                    $lastElement = end($peserta->ijazah);
                                @endphp
                                @if (count($peserta->ijazah) > 0)
                                    @foreach ($peserta->ijazah as $key => $item)
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-xl-3">
                                            <div class="form-group">
                                                <label for="">Bidang Studi</label>
                                                <input type="text" class="form-control" name="name_ijazah_{{$item->id}}" value="{{$item->nama}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-xl-3">
                                            <div class="form-group">
                                                <label for="">File <a href="#showPreview" onclick="changePreview('{{$item->file}}', '{{$item->nama}}')" data-toggle="modal" data-target="#showPreview" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat file"><i class="fa fa-eye"></i></a></label>
                                                <input type="file" class="form-control" name="file_ijazah_{{$item->id}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-xl-3">
                                            <div class="form-group">
                                                <label for="">Tingkat</label>
                                                <input type="text" class="form-control" name="tingkat_{{$item->id}}" value="{{$item->tingkat}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-xl-2">
                                            <div class="form-group">
                                                <label for="">Tahun Lulus</label>
                                                <input type="text" class="form-control" name="tahun_lulus_{{$item->id}}" value="{{$item->tahun_lulus}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-xl-1">
                                            <div class="row">
                                                @if ($key == $lastIdIj)
                                                <div class="col-lg-6">
                                                    <span class="btn btn-success btn-md mt-4" id="addScnt" style="margin-top: 50px"><i class="fa fa-plus"></i></span>
                                                </div>
                                                @endif
                                                    <div class="col-lg-6">
                                                        <a href="{{ route('tenagaAhli.file.delete', $item->id) }}?type=ijazah" class="btn btn-danger btn-md mt-4" style="margin-top: 50px"><i class="fa fa-trash"></i></a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                        
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-3 col-xl-3">
                                                    <div class="form-group">
                                                        <label for="">Bidang Studi</label>
                                                        <input type="text" class="form-control" name="name_ijazah[]">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-3 col-xl-3">
                                                    <div class="form-group">
                                                        <label for="">File</label>
                                                        <input type="file" class="form-control" name="file_ijazah[]">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-3 col-xl-3">
                                                    <div class="form-group">
                                                        <label for="">Tingkat</label>
                                                        <input type="text" class="form-control" name="tingkat[]">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-3 col-xl-2">
                                                    <div class="form-group">
                                                        <label for="">Tahun Lulus</label>
                                                        <input type="text" class="form-control" name="tahun_lulus[]">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-3 col-xl-1">
                                                    <span class="btn btn-success btn-md mt-4" id="addScnt" style="margin-top: 50px"><i class="fa fa-plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div id="frm_scents"></div>
                    </section>
                    <h4>Ska</h4>
                    <section  style="overflow-y: scroll;width: 100%">
                        @if (count($peserta->ska) > 0)
                            @foreach ($peserta->ska as $key2 => $item_ska)
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-xl-2">
                                            <div class="form-group">
                                                <label for="">Kode</label>
                                                <input type="text" class="form-control" value="{{$item_ska->nama}}"  name="name_ska_{{$item_ska->id}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-2 col-xl-2">
                                            <div class="form-group">
                                                <label for="">File <a href="#showPreview" onclick="changePreview('{{$item_ska->file}}', '{{$item_ska->nama}}')" data-toggle="modal" data-target="#showPreview" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat file"><i class="fa fa-eye"></i></a></label>
                                                <input type="file" class="form-control" value="{{$item_ska->file_ska}}"  name="file_ska_{{$item_ska->id}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-2 col-xl-2">
                                            <div class="form-group">
                                                <label for="">Tingkat</label>
                                                <input type="text" class="form-control" value="{{$item_ska->tingkat}}"  name="tingkat_ska_{{$item_ska->id}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-1 col-xl-2">
                                            <div class="form-group">
                                                <label for="">Berlaku sampai dengan</label>
                                                <input type="date" class="form-control" value="{{$item_ska->berlaku}}"  name="berlaku_{{$item_ska->id}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-xl-2">
                                            <div class="form-group">
                                                <label for="">Kualifikasi</label>
                                                <input type="text" class="form-control" value="{{$item_ska->klasifikasi}}"  name="klasifikasi_{{$item_ska->id}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-xl-1">
                                            <div class="row">
                                                @if ($key2 == $lastIdIj)
                                                <div class="col-lg-6">
                                                    <span class="btn btn-success btn-md mt-4" id="addScntz" style="margin-top: 50px"><i class="fa fa-plus"></i></span>
                                                </div>
                                                @endif
                                                <div class="col-lg-6">
                                                    <a href="{{ route('tenagaAhli.file.delete', $item_ska->id) }}?type=ska" class="btn btn-danger btn-md mt-4" style="margin-top: 50px"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-xs-12 col-md-3 col-xl-2">
                                        <div class="form-group">
                                            <label for="">Bidang Studi</label>
                                            <input type="text" class="form-control" name="name_ska[]">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-2 col-xl-2">
                                        <div class="form-group">
                                            <label for="">File</label>
                                            <input type="file" class="form-control" name="file_ska[]">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-2 col-xl-2">
                                        <div class="form-group">
                                            <label for="">Tingkat</label>
                                            <input type="text" class="form-control" name="tingkat_ska[]">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-1 col-xl-2">
                                        <div class="form-group">
                                            <label for="">Berlaku sampai dengan</label>
                                            <input type="date" class="form-control" name="berlaku[]">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3 col-xl-2">
                                        <div class="form-group">
                                            <label for="">Kualifikasi</label>
                                            <input type="text" class="form-control" name="klasifikasi[]">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3 col-xl-1">
                                        <span class="btn btn-success btn-md mt-4" id="addScntz" style="margin-top: 50px"><i class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div id="frm_scentz"></div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade modal-fullscreen" id="showPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <script>

        var scntDiv = $("#frm_scents");
        var i = $("#p_scents").length + 1;
        var scntDivz = $("#frm_scentz");
        var z = $("#p_scentz").length + 1;

$(function() {
  $("#addScnt").click(function() {
    $(`<div class="row remove_${i}" id="p_scents">
            <div class="col-xs-12 col-md-3 col-xl-3">
                <div class="form-group">
                    <label for="">Bidang Studi</label>
                    <input type="text" name="name_ijazah[]" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-xl-3">
                <div class="form-group">
                    <label for="">File</label>
                    <input type="file" class="form-control" name="file_ijazah[]">
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-xl-3">
                <div class="form-group">
                    <label for="">Tingkat</label>
                    <input type="text" class="form-control" name="tingkat[]">
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-xl-2">
                <div class="form-group">
                    <label for="">Tahun Lulus</label>
                    <input type="text" class="form-control" name="tahun_lulus[]">
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-xl-1">
                <span class="btn btn-danger btn-md mt-4" onclick="removeCont('.remove_${i}')" style="margin-top: 50px"><i class="fa fa-trash"></i></span>
            </div>
        </div>`
    ).appendTo(scntDiv);
    i++;
    return false;
  });
});

$(function() {
  $("#addScntz").click(function() {
    $(`<div class="row remove_${z}" id="p_scents">
        <div class="col-xs-12 col-md-3 col-xl-2">
            <div class="form-group">
                <label for="">Kode</label>
                <input type="text" class="form-control" name="name_ska[]">
            </div>
        </div>
        <div class="col-xs-12 col-md-2 col-xl-2">
            <div class="form-group">
                <label for="">File</label>
                <input type="file" class="form-control" name="file_ska[]">
            </div>
        </div>
        <div class="col-xs-12 col-md-2 col-xl-2">
            <div class="form-group">
                <label for="">Tingkat</label>
                <input type="text" class="form-control" name="tingkat_ska[]">
            </div>
        </div>
        <div class="col-xs-12 col-md-1 col-xl-2">
            <div class="form-group">
                <label for="">Berlaku sampai dengan</label>
                <input type="date" class="form-control" name="berlaku[]">
            </div>
        </div>
        <div class="col-xs-12 col-md-3 col-xl-2">
            <div class="form-group">
                <label for="">Kualifikasi</label>
                <input type="text" class="form-control" name="klasifikasi[]">
            </div>
        </div>
        <div class="col-xs-12 col-md-3 col-xl-1">
            <span class="btn btn-danger btn-md mt-4" onclick="removeCont('.remove_${z}')" style="margin-top: 50px"><i class="fa fa-trash"></i></span>
        </div>
    </div>`
    ).appendTo(scntDivz);
    z++;
    return false;
  });
});

function removeCont(_this) {
  if (i > 1) {
    $(_this).remove();
    i--;
  }
  if (z > 1) {
    $(_this).remove();
    z--;
  }
}

    </script>
@endsection
