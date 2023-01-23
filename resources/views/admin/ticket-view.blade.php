@extends('admin/layouts/main')
@section('admin/container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid">
        <div class="container text-center py-5" style="max-width: 800px">
            <div class="py-5">
                <h1 class="display-4 mb-5">Tampilan tiket</h1>
            </div>
        </div>
    </div>

    {{-- ticket view --}}
    <div class="container" style="max-width: 800px;">
        @if (session()->has('reply_success'))
        <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
            {{session('reply_success')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('open_success'))
        <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
            {{session('open_success')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('close_success'))
        <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
            {{session('close_success')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h3>Rincian tiket</h3>
                </div>
                <div class="col-md-6 text-end mb-3">
                    <a href="/admin/tickets" class="btn btn-custom-secondary">Kembali ke daftar tiket</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <p class="text-muted mb-2"><strong>ID:</strong> #{{$ticket->id}}</p>
                <p class="text-muted mb-2"><strong>Subjek:</strong> {{$ticket->subject}}</p>
                <p class="text-muted mb-2"><strong>Kategori:</strong> {{$ticket->category->name}}</p>
                <p class="text-muted mb-2"><strong>Status: </strong><span class="px-2 py-1 rounded {{($ticket->status_id == 1) ? 'status-span-open' : 'status-span-closed'}}">{{$ticket->status->name}}</span></p>
            </div>

            <div class="col-lg-6">
                <p class="text-muted mb-2"><strong>Pemohon:</strong> {{$ticket->user->name}}</p>
                <p class="text-muted mb-2"><strong>Divisi:</strong> {{$ticket->user->departement->name}}</p>
                <p class="text-muted mb-2"><strong>Tanggal dibuat:</strong> {{\Carbon\Carbon::parse($ticket->created_at)->format('d-m-Y H:i')}}</p>
                @if ($ticket->status_id == 2)
                <p class="text-muted mb-2"><strong>Tanggal tiket selesai:</strong> {{\Carbon\Carbon::parse($ticket->closed_at)->format('d-m-Y H:i')}}</p>
                @endif
            </div>

            <div class="col-lg-12 mt-3">
                <p class="text-muted mb-2"><strong>Deskripsi:</strong> {{$ticket->detail}}</p>
            </div>
        </div>

        <div class="mt-3 text-end">
            <form class="d-inline me-1" method="post" action="/admin/tickets/{{ $ticket->id }}/{{ ($ticket->status_id == 1) ? 'close' : 'open' }}">
                @csrf
                <button class="btn btn-sm btn-custom-secondary" data-bs-toggle="tooltip" title="Tandai tiket {{ ($ticket->status_id == 1) ? 'selesai' : 'diproses' }}">
                    <span data-feather="{{ ($ticket->status_id == 1) ? 'circle' : 'check-circle' }}"></span>
                </button>
            </form>
            <a href="/admin/tickets/{{$ticket->id}}/edit" class="btn btn-sm btn-custom-secondary">Sunting tiket</a>
        </div>
    </div>

    {{-- reply --}}
    <div class="container my-5" style="max-width: 800px;">
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-5">
                <h4 class="mb-4">Balasan</h4>
                @if (count($replies))
                @foreach ($replies as $r)
                <div class="card border-0 shadow-sm mb-3" style="background-color: #fbf9f9;">
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="text-muted mb-0 flex-grow-1">
                                <strong>{{$r->user->name}}</strong>
                            </p>
                            @if ($r->user->user_role_id == 2 || $r->user->user_role_id == 3)
                            <span class="badge bg-secondary rounded-pill">Teknisi</span>
                            @endif
                        </div>
                        <p class="text-muted"><small><i>{{$r->created_at->format('d-m-Y H:i')}} | {{$r->created_at->diffForHumans()}}</i></small></p>
                        <p class="text-muted">{{$r->message}}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="container mb-5 text-center">
                    <div class="card border-0 shadow-sm mb-3" style="background-color: #fbf9f9;">
                        <div class="card-body">
                            <p class="mb-0">Tidak ada balasan.</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-6 col-sm-12 mb-5">
                <h4 class="mb-4">Tulis balasan</h4>
                    <form action="/admin/tickets/{{$ticket->id}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                        <div class="mb-3">
                            {{-- <input type="hidden" value="{{$ticket->user->id}}" name="user_id"> --}}
                            <label for="message" class="form-label text-muted">Pesan</label>
                            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                        </div>
                        <div class="pb-5 text-end">
                            <button class="btn btn-custom-primary" type="submit">Kirim</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection