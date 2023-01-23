@extends('layouts/main')
@section('container')
<div class="container" style="max-width: 1200px;">
    <div class="container mt-5 pb-2" style="max-width: 800px;">
        <div class="mt-5 pt-5">
            <h1 class="display-3 text-center">Buat akun baru</h1>
            <p class="text-center text-muted">Sudah punya akun? <a class="text-decoration-none color-primary link-regis" href="/login">Masuk</a>.</p>
        </div>
    </div>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <div class="card card-login border-0 shadow-sm px-4 py-3">
                    <div class="card-body">
                        <form action="/register" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama lengkap" value="{{old('name')}}" required>
                                <label for="name">Nama</label>
                                @error('name')
                                <div class="invalid-feedback text-start">
                                    {{$message}}</div>    
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="nama@econtoh.com" value="{{old('email')}}" required>
                                <label for="email">Email</label>
                                @error('email')
                                <div class="invalid-feedback text-start">
                                    {{$message}}</div>    
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="Nomor telepon" value="{{old('phone_number')}}" required>
                                        <label for="phone_number">Nomor telepon</label>
                                        @error('phone_number')
                                        <div class="invalid-feedback text-start">
                                            {{$message}}</div>    
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('departement_id') is-invalid @enderror" name="departement_id" id="departement_id" aria-label="Divisi" required>
                                          <option value="">Pilih divisi...</option>
                                          @foreach ($departement as $d)
                                              <option value="{{$d->id}}">{{$d->name}}</option>
                                          @endforeach
                                        </select>
                                        <label for="floatingSelect">Divisi</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="telegram_username" class="form-control @error('telegram_username') is-invalid @enderror" id="telegram_username" placeholder="Nama pengguna Telegram" value="{{old('telegram_username')}}" required>
                                        <label for="telegram_username">Nama pengguna Telegram</label>
                                        @error('telegram_username')
                                        <div class="invalid-feedback text-start">
                                            {{$message}}</div>    
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Kata Sandi" required>
                                        <label for="password">Kata Sandi</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Konfirmasi Kata Sandi" required>
                                        <label for="password">Konfirmasi Kata Sandi</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button class="btn fs-5 btn-custom-primary btn-submit py-3" type="submit">Buat akun</button>
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