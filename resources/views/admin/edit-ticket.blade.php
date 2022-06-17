@extends('admin/layouts/main')
@section('admin/container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid {{-- bg-custom-secondary --}}">
        <div class="container text-center py-5" style="max-width: 800px">
            <div class="py-5">
                <h1 class="display-4 mb-5">Edit Ticket</h1>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 800px;">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="/admin/tickets/{{$ticket->id}}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{old('subject', $ticket->subject)}}" required>
                        <label for="subject">Subject<span class="text-danger">*</span></label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select name="category_id" id="category" class="form-select">
                                    <option value="0">Uncategorized</option>
                                    @foreach ($category as $c)
                                    @if (old('category_id', $ticket->category_id) == $c->id)
                                    <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <label for="category">Category</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select name="status_id" id="status" class="form-select">
                                    @foreach ($status as $s)
                                    @if (old('status_id', $ticket->status_id) == $s->id)
                                    <option value="{{$s->id}}" selected>{{$s->name}}</option>
                                    @else
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <label for="status">Status</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Write problem detail here" id="detail" style="height:110pt" name="detail" required>{{$ticket->detail}}</textarea>
                        <label for="detail">Detail{{-- <span class="text-danger">* --}}</span></label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <p class="text-danger">*required</p> --}}
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-custom-primary">Update Ticket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection