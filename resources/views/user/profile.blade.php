@extends("layouts.app")
@section("title","User Profile")
@section('content')
    <div class="row" >
        <div class="col-md-12">
            <div class="card rounded-0 border-0 shadow-sm">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <td>Registration Date</td>
                            <td>:</td>
                            <td>{{Auth::user()->created_at->diffForHumans()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection