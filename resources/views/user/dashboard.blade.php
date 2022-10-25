@extends("layouts.app")
@section("title","User Dashboard")
@section('content')
    <div class="row" >
        <div class="col-md-12">
            <div class="card rounded-0 border-0 shadow-sm">
                <div class="card-body">
                    <h3>Welcome, <span class="text-danger">{{Auth::user()->name}}</span></h3>
                    <p>Your Token is :</p>
                </div>
            </div>
        </div>
    </div>
@endsection