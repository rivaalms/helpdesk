@extends('layouts/main')
@section('container')
<div class="container-fluid">
    <div class="container py-5" style="max-width: 800px">
        <div class="py-5">
            <span class="text-center">
                <h1 class="display-4 mb-5">Open New Ticket</h1>
            </span>
            <div class="card p-3 border-0 shadow-sm">
                <div class="card-body px-5 mt-3">
                    <form action="/create" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" required>
                            <label for="subject">Subject{{-- <span class="text-danger">*</span> --}}</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="category_id" id="category" class="form-select">
                                        {{-- <option value="0">Uncategorized</option> --}}
                                        @foreach ($category as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="category">Category</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="admin_user_id" id="admin" class="form-select" required>
                                        <option value="0">Select agent...</option>
                                        @foreach ($admin as $a)
                                            <option value="{{$a->id}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="admin">Assigned to</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Write problem detail here" id="detail" style="height:110pt" name="detail" required></textarea>
                            <label for="detail">Detail{{-- <span class="text-danger">*</span> --}}</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <p class="text-danger">*required</p> --}}
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" class="btn btn-custom-primary">Submit Ticket</button>
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