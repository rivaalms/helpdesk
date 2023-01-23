@extends('admin/layouts/main')
@section('admin/container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid px-0 pt-3">
        <div class="row">
            <div class="col-md-6">
                <h2 class="display-6">Buat tiket baru</h2>
            </div>
            <div class="col-md-6 text-end pt-2">
                <a href="/admin/tickets" class="btn btn-custom-secondary">Kembali ke daftar tiket</a>
            </div>
        </div>
    </div>

    <div class="container-fluid px-0 mt-5" style="max-width: 800px;">
        <div class="card p-3 border-0 shadow-sm">
            <div class="card-body px-5 mt-3">
                <form action="/admin/tickets" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <select name="user_id" id="user_id" class="form-select">
                            @foreach ($user as $u)
                            <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select>
                        <label for="user_id">Pemohon</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" required>
                        <label for="subject">Subjek{{-- <span class="text-danger">*</span> --}}</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="category_id" id="category" class="form-select">
                            <option value="">Pilih kategori...</option>
                            @foreach ($category as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        <label for="category">Kategori</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Write problem detail here" id="detail" style="height:110pt" name="detail" required></textarea>
                        <label for="detail">Detil keluhan{{-- <span class="text-danger">*</span> --}}</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <p class="text-danger">*required</p> --}}
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-custom-primary">Kirim tiket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection