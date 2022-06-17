@extends('layouts/main')
@section('container')
<div class="container-fluid">
    <div class="container text-center py-5" style="max-width: 800px">
        <div class="pt-5">
            <h1 class="display-4 mb-5">Category: {{$category->name}}</h1>
        </div>
        {{-- <div class="container-fluid mb-5">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pb-3">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item"><a href="/faq">FAQ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
                </ol>
            </nav>
        </div> --}}
    </div>
</div>

<div class="container" style="max-width: 1200px">
    <div class="row">
        <div class="col-md-4">
            <div class="container-fluid">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="post">
                            @csrf
                            <div class="input-group my-3">
                                <input type="text" class="form-control typeahead" placeholder="Search...">
                                <button class="btn btn-custom-primary btn-light" type="button" id="button-search"><span data-feather="search"></span></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body border-top">
                        <h5 class="mb-4">Category</h5>
                        <ul>
                            @foreach ($categories as $c)
                                <li class="mb-1"><a href="/category/{{$c->id}}" class="text-decoration-none text-reset faq-links">{{$c->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
        @foreach ($articles as $a)
            <div class="mb-4">
                <div class="my-1">
                    <a href="/faq/{{$a->id}}" class="faq-links text-decoration-none text-reset h5">{{$a->subject}}</a>
                </div>
                <div class="col-md-12 text-truncate text-muted">
                    {{$a->content}}
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

{{-- footer --}}
{{-- <div class="container">
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
</div> --}}

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