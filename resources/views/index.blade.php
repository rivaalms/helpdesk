@extends('layouts/main')
@section('container')
<div class="container-fluid {{-- bg-custom-secondary --}}">
    <div class="container text-center py-5" style="max-width: 800px">
        <div class="py-5">
            <h1 class="display-4 mb-5">How can we help?</h1>
            <form action="" method="post">
                @csrf
                <div class="input-group input-group-lg mb-3">
                    <input type="text" autocomplete="off" class="form-control typeahead" id="search" placeholder="Search...">
                    <button class="btn btn-custom-primary btn-light" type="button" id="button-search"><span class="mb-1" data-feather="search"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- cards --}}
<div class="container my-5 text-center" style="max-width: 1200px">
    <div class="py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Computer</h5>
                        <div class="mx-5 px-3 my-3"><hr></div>
                        @foreach ($computer as $c)
                            <div class="mb-1">
                                <span class="faq-links mb-1"><a href="/faq/{{$c->id}}" class="text-reset text-decoration-none card-text">{{$c->subject}}</a></span>
                            </div>
                        @endforeach
                        <a href="/category/{{$computer_cat->id}}" class="btn btn-custom-primary mt-3">See All</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Software</h5>
                        <div class="mx-5 px-3 my-3"><hr></div>
                        @foreach ($software as $s)
                            <div class="mb-1">
                                <span class="faq-links mb-1"><a href="/faq/{{$s->id}}" class="text-reset text-decoration-none card-text">{{$s->subject}}</a></span>
                            </div>
                        @endforeach
                        <a href="/category/{{$software_cat->id}}" class="btn btn-custom-primary mt-3">See All</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Network</h5>
                        <div class="mx-5 px-3 my-3"><hr></div>
                        @foreach ($network as $n)
                            <div class="mb-1">
                                <span class="faq-links mb-1"><a href="/faq/{{$n->id}}" class="text-reset text-decoration-none card-text">{{$n->subject}}</a></span>
                            </div>
                        @endforeach
                        <a href="/category/{{$network_cat->id}}" class="btn btn-custom-primary mt-3">See All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- open ticket --}}
<div class="container-fluid my-5">
    <div class="container py-5" style="max-width: 1200px">
        <div class="row">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
                <h2>Didn't find any solutions?</h2>
                <a href="/create" class="btn btn-custom-primary btn-lg my-2">Open support ticket</a>
            </div>
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