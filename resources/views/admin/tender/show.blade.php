@extends('layouts.app')
@section('breadcrumb', 'Tender')
@section('content')
<div class="row">
    <div class="col-xs-12 col-lg-12">
        <div class="card">
            <h2 class="card-header">
            </h2>
            <div class="card-body">
                
                <form action="{{ route('tender.update', $tender->id) }}" method="post">
                    @method("PUT")
                    @csrf
                    <div class="form-group">
                        <label for="">Nama tender</label>
                        <input type="text" value="{{ $tender->nama_tender }}"  name="nama_tender" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Owner</label>
                        <input type="text" value="{{ $tender->nama_perusahaan }}"  name="nama_perusahaan"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Divisi</label>
                        <input type="number" class="form-control" value="{{ $tender->divis_count }}"  name="divis_count">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="terbuat" {{ $tender->status == 'terbuat' ? 'selected' : '' }} disabled>Terbuat</option>
                            <option value="progress" {{ $tender->status == 'progress' ? 'selected' : '' }} >Process</option>
                            <option value="selesai" {{ $tender->status == 'selesai' ? 'selected' : '' }} >Selesai</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
