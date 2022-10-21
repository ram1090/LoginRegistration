@extends("layouts.guest")
@section("title","Register New User")
@section('content')
<div class="card rounded-0 shadow-sm card-primary" style="min-width:450px;">
    <div class="card-header bg-primary text-white rounded-0">
        <h4 class="card-title font-weight-normal">Register New User</h4>
    </div>
    <div class="card-body">
        @if(session()->has('message'))
        <div class="alert alert-success my-2"><span style="font-size:14px;">{!! session()->get('message') !!} <a href="{{route('loginForm')}}">Click here to login</a></span></div>
        @endif
        <form action="{{route('registerStore')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name <sup class="text-danger">*</sup></label>
                <input type="text" value="{{old('name')}}"
                    class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="Enter name">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
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
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Password Confirmation<sup
                        class="text-danger">*</sup></label>
                <input type="password" value="{{old('password_confirmation')}}"
                    class="form-control rounded-0 @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation" placeholder="Confirm password">

                @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary rounded-0">Register</button>
                <p class="my-2">If you have already account | <a href="{{route('loginForm')}}">Click here to login</a></p>
                <a href="{{url('/')}}">Back to Home</a>
            </div>
        </form>
    </div>
    <div class="card-footer fst-italic text-muted">
        <small>Developed By : <span class="text-danger">Ramshankar Maurya</span></small>
    </div>
</div>

@endsection