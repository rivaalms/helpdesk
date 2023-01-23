@extends('admin/layouts/main')
@section('admin/container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid px-0 pt-3">
        <div class="row">
            <div class="col-md-6">
                <h2 class="display-6">Sunting tiket</h2>
            </div>
            <div class="col-md-6 text-end pt-2">
                <a href="/admin/tickets" onclick="return confirm('Batalkan perubahan?')" class="btn btn-custom-secondary">Kembali ke daftar tiket</a>
            </div>
        </div>
    </div>

    <div class="container-fluid px-0 mt-5" style="max-width: 800px;">
        <div class="card border-0 shadow-sm">
            <div class="card-body px-5 mt-3">
                <form action="/admin/tickets/{{$ticket->id}}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{old('subject', $ticket->subject)}}" required>
                        <label for="subject">Subjek</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select name="category_id" id="category" class="form-select">
                                    @foreach ($category as $c)
                                    @if (old('category_id', $ticket->category_id) == $c->id)
                                    <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <label for="category">Kategori</label>
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
                        <label for="detail">Detil keluhan</span></label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <p class="text-danger">*required</p> --}}
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-custom-primary">Perbarui tiket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection