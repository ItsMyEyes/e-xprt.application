@extends('layouts.app')
@section('breadcrumb', 'Tenaga Ahli')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('tenagaAhli.store') }}" method="POST" enctype="multipart/form-data" id="step-form-horizontal" class="step-form-horizontal">
                @csrf
                <div>
                    <h4>Data Diri</h4>
                    <section>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">Nama</label> --}}
                                    <input type="text" name="name" class="form-control" required placeholder="Full name" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">No. KTP</label> --}}
                                    <input type="text" name="no_ktp" class="form-control" required placeholder="No. KTP" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">Tempat Lahir</label> --}}
                                    <input type="text" name="tempat_lahir" class="form-control" required placeholder="Tempat Lahir" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{-- <label for="">Tanggal Lahir</label> --}}
                                    <input type="date" name="tgl_lahir" class="form-control bootstrapMaterialDatePicker" required placeholder="Full name" >
                                </div>
                            </div>
                        </div>
                    </section>
                    <h4>Ijazah</h4>
                    <section>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-xs-12 col-md-3 col-xl-3">
                                        <div class="form-group">
                                            <label for="">Nama Dokumen</label>
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
                        <div id="frm_scents"></div>
                    </section>
                    <h4>Ska</h4>
                    <section>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
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
                                        <span class="btn btn-success btn-md mt-4" id="addScntz" style="margin-top: 50px"><i class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="frm_scentz"></div>
                    </section>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
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
                    <label for="">Nama Dokumen</label>
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
