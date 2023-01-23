@extends('admin/layouts/main')
@section('admin/container')
<div class="container-fluid" style="padding: 0px 128px;">
    <div class="container-fluid px-0 pt-3">
        <div class="mb-4">
            <h2 class="display-6">Permohonan Registrasi</h2>
        </div>

        @if (session()->has('approved'))
        <div class="alert alert-info alert-dismissible fade show text-start mb-3" role="alert">
            {{session('approved')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('rejected'))
        <div class="alert alert-info alert-dismissible fade show text-start mb-3" role="alert">
            {{session('rejected')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-hover align-middle mt-4">
            <thead>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Divisi</th>
                {{-- <th>Username Telegram</th> --}}
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($request as $r)
                    <tr>
                        <td>{{$r->name}}</td>
                        <td>{{$r->email}}</td>
                        <td>{{$r->phone_number}}</td>
                        <td>{{$r->departement->name}}</td>
                        {{-- <td>{{$r->telegram_username}}</td> --}}
                        <td>
                            <a href="/register/{{$r->id}}/approve" class="badge bg-success" onclick="return confirm('Terima permohonan?')"><span data-feather="check" style="width: 20px; height:auto;"></span></a>
                            <a href="/register/{{$r->id}}/reject" class="badge bg-danger" onclick="return confirm('Tolak permohonan?')"><span data-feather="x" style="width: 20px; height:auto;"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection