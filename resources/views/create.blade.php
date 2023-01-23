@extends('layouts/main')
@section('container')
<div class="container-fluid">
    <div class="container py-5" style="max-width: 800px">
        <div class="py-5">
            <span class="text-center">
                <h1 class="display-4 mb-5">Buat Tiket Baru</h1>
            </span>
            <div class="card p-3 border-0 shadow-sm">
                <div class="card-body px-5 mt-3">
                    <form action="/create" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="Subject" name="subject" required>
                            <label for="subject">Subjek{{-- <span class="text-danger">*</span> --}}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="category_id" id="category" class="form-select" required>
                                <option value="">Pilih kategori...</option>
                                @foreach ($category as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                            <label for="category">Kategori</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('detail') is-invalid @enderror"" placeholder="Write problem detail here" id="detail" style="height:110pt" name="detail" required></textarea>
                            <label for="detail">Detil Keluhan</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" class="btn btn-custom-primary">Kirim Tiket</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- footer --}}

@endsection