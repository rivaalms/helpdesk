@extends('layouts/main')
@section('container')
<div class="container" style="max-width: 1200px;">
    <div class="container mb-5 pb-5" style="max-width: 800px;">
        <div class="my-5">
            <h1 class="display-2 text-center">Welcome!</h1>
        </div>
    </div>
    <div class="container-fluid mt-3 text-center">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card card-login border-0 shadow-sm px-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h5>Please Login</h5>
                        </div>
                        <form action="/login" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com"required>
                                <label for="email">Email Address</label>
                                @error('email')
                                <div class="invalid-feedback text-start">
                                    {{$message}}</div>    
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn fs-5 btn-custom-primary btn-submit py-3" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

{{-- footer --}}
    
@endsection