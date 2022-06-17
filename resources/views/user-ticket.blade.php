@extends('layouts/main')
@section('container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid {{-- bg-custom-secondary --}}">
        <div class="container text-center py-5" style="max-width: 800px">
            <div class="py-5">
                <h1 class="display-4 mb-5">Ticket View</h1>
            </div>
        </div>
    </div>

    {{-- ticket view --}}
    <div class="container" style="max-width: 800px;">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h3>Ticket Details</h3>
                </div>
                <div class="col-md-6 text-end mb-3">
                    <a href="/user" class="btn btn-custom-primary">All Tickets</a>
                </div>
            </div>
        </div>
        <p class="text-muted mb-1"><strong>Ticket ID:</strong> #{{$ticket->id}}</p>
        <p class="text-muted mb-1"><strong>Requester:</strong> {{$ticket->user->name}}</p>
        <p class="text-muted mb-1"><strong>Departement:</strong>@if ($ticket->user->user_role_id == 1) {{$worker->departement->name}} @else - @endif </p>
        <p class="text-muted mb-1"><strong>Subject:</strong> {{$ticket->subject}}</p>
        <p class="text-muted mb-1"><strong>Category:</strong> {{$ticket->category->name}}</p>
        <p class="text-muted mb-1"><strong>Status:</strong> {{$ticket->status->name}}</p>
        <p class="text-muted mb-1"><strong>Ticket Handler:</strong> {{$admin->user->name}}</p>
        @if ($ticket->status_id == 2)
            <p class="text-muted mb-1"><strong>Date Closed:</strong>{{$ticket->closed_at}}</p>
        @endif
        <p class="text-muted mb-1"><strong>Description:</strong> {{$ticket->detail}}</p>
    </div>

    {{-- reply --}}
    <div class="container my-5" style="max-width: 800px;">
        @if(count($replies))
        <h4 class="mb-4">Replies</h4>
        <div class="container mb-5">
            @foreach ($replies as $r)
            <div class="card border-0 shadow-sm mb-3" style="background-color: #fbf9f9;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted mb-0"><strong class="me-2">{{$r->user->name}}</strong> @if($r->user->user_role_id == 2)<small><span class="bg-secondary px-2 rounded" style="color: white;">{{$r->user->user_role->name}}</span></small> @endif </p>
                        </div>
                        <div class="col-md-6 text-end">
                            @if ($r->user->user_role_id == 2)
                            <p class="text-muted mb-0">{{$r->user->user_role->name}}</p>
                            @else
                            
                            @endif
                        </div>
                    </div>
                    <p class="text-muted"><small><i>{{$r->created_at->format('Y-m-d H:i')}} | {{$r->created_at->diffForHumans()}}</i></small></p>
                    <p class="text-muted">{{$r->message}}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <h4 class="mb-4">Create a Reply</h4>
        <div class="container">
            <form action="/user-dashboard/{{$ticket->id}}" method="post">
            <div class="mb-3">
                    <label for="message" class="form-label text-muted">Message</label>
                    <textarea class="form-control" id="message" rows="6"></textarea>
                </div>
                <div class="mb-3">
                    <button class="btn btn-custom-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- footer --}}
<div class="container">
    <footer class="py-2 mt-auto">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
        <p class="text-center text-muted">&copy; 2021 Company, Inc</p>
    </footer>
</div>
@endsection