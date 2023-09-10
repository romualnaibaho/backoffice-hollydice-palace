@extends('layouts.authentication')

@section('content')
<div class="bg-gradient-primary d-flex" style="height: 100vh">
    <div class="container my-auto">
        <!-- Outer Row -->
        <div class="row justify-content-center my-auto">
    
            <div class="col-xl-10 col-lg-12 col-md-9">
    
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="height: 70vh">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6 d-flex">
                                <div class="p-5 m-auto" style="width: 100%">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to office</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('do-login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input name="email"  type="email" class="form-control form-control-user" placeholder="Email Address">
                                            @if ($errors->has('email'))
                                                <span class="help-block text-center">
                                                    <strong style="color:red;font-size:12px;">{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user" placeholder="Password">
                                            @if ($errors->has('password'))
                                                <span class="help-block text-center">
                                                    <strong style="color:red;font-size:12px;">{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
