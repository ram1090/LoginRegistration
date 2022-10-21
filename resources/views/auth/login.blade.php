@extends("layouts.guest")
@section("title","User Login")
@section('content')
<div class="card rounded-0 shadow-sm card-primary" style="min-width:450px;">
    <div class="card-header bg-primary text-white rounded-0">
        <h4 class="card-title font-weight-normal">Login User</h4>
    </div>
    <div class="card-body">
        @if(session()->has('message'))
        <div class="alert alert-danger my-2"><span style="font-size:14px;">{!! session()->get('message') !!}</span></div>
        @endif
        <form action="{{route('loginCheck')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
                <input type="email" value="{{old('email')}}"
                    class="form-control rounded-0 @error('email') is-invalid @enderror" id="email" name="email"
                    placeholder="Enter email">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password<sup class="text-danger">*</sup></label>
                <input type="password" value="{{old('password')}}"
                    class="form-control rounded-0 @error('password') is-invalid @enderror" id="password" name="password"
                    placeholder="Enter password">
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary rounded-0">Login</button>
                <p class="my-2">If you don't have account. <a href="{{route('registerForm')}}">Create an account</a></p>
                <a href="{{url('/')}}">Back to Home</a>
            </div>
        </form>
    </div>
    <div class="card-footer fst-italic text-muted">
        <small>Developed By : <span class="text-danger">Ramshankar Maurya</span></small>
    </div>
</div>

@endsection