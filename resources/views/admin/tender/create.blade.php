@extends('layouts.app')
@section('breadcrumb', 'Tender')
@section('content')
<div class="row">
    <div class="col-xs-12 col-lg-12">
        <div class="card">
            <h2 class="card-header">
            </h2>
            <div class="card-body">
                
                <form action="{{ route('tender.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama tender</label>
                        <input type="text" name="nama_tender" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Owner</label>
                        <input type="text" name="nama_perusahaan"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Divisi</label>
                        <input type="number" class="form-control" name="divis_count">
                    </div>

                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
