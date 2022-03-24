@extends('layouts.app')
@section('breadcrumb', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-xs-12 col-lg-12">
        <div class="card">
            <h2 class="card-header">
            </h2>
            <div class="card-body">
                
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">plain password</label>
                        <input type="password" class="form-control" name="plain_password">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="">~~ select your role ~~</option>
                            <option value="admin">admin</option>
                            <option value="hc">Hc</option>
                            <option value="pemasaran">Pemasaran</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
