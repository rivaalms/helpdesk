@extends('admin/layouts/main')
@section('admin/container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid px-0 pt-3">
        <div class="mb-4">
            <h2>Ticket List</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="/admin/tickets">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search')}}">
                        <button class="btn btn-custom-primary btn-light" type="submit" id="button-search"><span data-feather="search"></span></button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="/admin/tickets/create" class="btn btn-custom-primary">Create a Ticket</a>
            </div>
        </div>
        <table class="table table-hover align-middle">
            <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Requester</th>
                    <th>Date Created</th>
                    <th>Action</th>
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
                                <button class="badge bg-danger border-0" onclick="return confirm('Confirm delete?')"><span data-feather="trash-2" style="width: 20px; height:auto;"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center pt-3">
            {{$tickets->links()}}
        </div>
    </div>
</div>
@endsection