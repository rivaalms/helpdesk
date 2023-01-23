@extends('admin/layouts/main')
@section('admin/container')
<div class="container-fluid" style="padding: 0px 128px;">
    <div class="container-fluid px-0 pt-3">
        <div class="mb-4">
            <h2 class="display-6">Daftar tiket</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="/admin/tickets">
                    {{-- @csrf --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari tiket..." name="search" value="{{ request('search')}}">
                        <button class="btn btn-custom-primary btn-light" type="submit" id="button-search"><span data-feather="search"></span></button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="/admin/tickets/create" class="btn btn-custom-primary">Buat tiket</a>
            </div>
        </div>

        @if (session()->has('ticket_success'))
        <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
            {{session('ticket_success')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('update_success'))
        <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
            {{session('update_success')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('delete'))
        <div class="alert alert-warning alert-dismissible fade show text-start mb-3" role="alert">
            {{session('delete')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-hover align-middle mt-4">
            <thead class="ticket-table">
                <tr>
                    <th>@sortablelink('id', 'ID')</th>
                    <th>@sortablelink('subject', 'Subjek')</th>
                    <th>@sortablelink('category_id', 'Kategori')</th>
                    <th>@sortablelink('status_id', 'Status')</th>
                    <th>@sortablelink('user_id', 'Pemohon')</th>
                    <th>@sortablelink('created_at', 'Tanggal dibuat')</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $t)
                    <tr>
                        <td class="py-3">#{{$t->id}}</td>
                        <td><a href="/admin/tickets/{{$t->id}}" class="text-reset text-decoration-none faq-links">{{$t->subject}}</a></td>
                        <td>{{$t->category->name}}</td>
                        <td><span class="{{($t->status_id == 1 ? 'status-span-open' : 'status-span-closed')}}">{{$t->status->name}}</span></td>
                        <td>{{$t->user->name}}</td>
                        <td>{{$t->created_at->format('d-m-Y H:i')}}</td>
                        <td class="text-center">
                            {{-- <a href="/admin/tickets/{{$t->id}}" class="badge bg-info"><span data-feather="eye"></span></a> --}}
                            <a href="/admin/tickets/{{$t->id}}/edit" class="badge bg-warning"><span data-feather="edit-3" style="width: 20px; height:auto;"></span></a>
                            <form action="/admin/tickets/{{$t->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Hapus tiket #{{$t->id}}?')"><span data-feather="trash-2" style="width: 20px; height:auto;"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center pt-3 mb-5">
            {{$tickets->links()}}
        </div>
    </div>
</div>
@endsection