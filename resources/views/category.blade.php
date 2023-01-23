@extends('layouts/main')
@section('container')

<div class="container mt-5" style="max-width: 1200px">
    <div class="row">
        <div class="col-md-4">
            <div class="container-fluid">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="/search" method="post" autocomplete="off">
                            @csrf
                            <div class="input-group my-3">
                                <input type="text" class="form-control typeahead" placeholder="Cari..." name="search">
                                <button class="btn btn-custom-primary btn-light" type="submit" id="button-search"><span data-feather="search"></span></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body border-top">
                        <h5 class="mb-4">Kategori</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $c)
                                <li class="list-group-item "><a href="/category/{{$c->id}}" class="text-decoration-none text-reset faq-links">{{$c->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h1 class="display-5 mb-4 pb-2">{{$category->name}}</h1>
        @foreach ($articles as $art => $a)
            <div class="mb-4">
                <div class="">
                    <a href="/article/{{$a->id}}" class="faq-links text-decoration-none text-reset h5">{{$a->subject}}</a>
                </div>
                <div class="col-md-12 text-truncate text-muted">
                    {!!$text[$art]!!}
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var path = "{{route('autocomplete')}}";
    $('input.typeahead').typeahead({
        source: function(terms, process) {
            return $.get(path, {terms:terms},function(data) {
                return process(data);
            });
        }
    });
</script>
@endsection