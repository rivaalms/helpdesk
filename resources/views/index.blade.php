@extends('layouts/main')
@section('container')
<div class="container-fluid gradient-container">
    <div class="container py-5" style="max-width: 1200px">
        <div class="row">
            <div class="col-lg-6">
                <div class="py-5">
                    <h1 class="display-5 mb-5">
                        Selamat 
                        @if (($time > 4) && ($time < 11))
                        pagi, 
                        @elseif ($time < 15)
                        siang, 
                        @elseif ($time < 18)
                        sore, 
                        @else
                        malam, 
                        @endif
                        <br>Ada yang bisa kami bantu?
                    </h1>
                    <form action="/search" method="post">
                        @csrf
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" autocomplete="off" class="form-control typeahead" id="search" name="search" placeholder="Cari..." required>
                            <button class="btn btn-custom-primary btn-light" type="submit" id="button-search"><span class="mb-1" data-feather="search"></span></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="img-container px-5 pt-4">
                    <img class="img-fluid" src="/images/troubleshooting.jpg" alt="Troubleshooting">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5 mt-3" style="max-width: 1200px">
    <div class="text-center">
        <h2 class="fs-3">Pilih topik berdasarkan kendala</h2>
    </div>
    <div class="py-4">
        <div class="row">
            @foreach ($category as $c)
                <div class="col-md-4">
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body d-flex">
                            <div class="me-3">
                                <img src=@if($c->id == 1) "/images/pc.png" @elseif($c->id == 2) "/images/software.png" @elseif($c->id == 3) "/images/router.png" @endif alt="" style="height: 40px; width:auto;" class="img-fluid">
                            </div>
                            <div class="d-flex flex-grow-1 align-items-center">
                                <a href="/category/{{$c->id}}" class="text-decoration-none text-reset stretched-link fs-5">{{$c->name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- cards --}}
<div class="container mb-5 mt-3" style="max-width: 1200px">
    <div class="text-center">
        <h2 class="fs-3">Yang sering ditanyakan</h2>
    </div>
    <div class="py-4 d-flex justify-content-center">
        <div class="accordion" id="faq" style="width: 65%">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{$articles->find(3)->subject}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#faq">
                    <div class="accordion-body">
                        {!!$articles->find(3)->content!!}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        {{$articles->find(4)->subject}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#faq">
                    <div class="accordion-body">
                        {!!$articles->find(4)->content!!}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        {{$articles->find(5)->subject}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#faq">
                    <div class="accordion-body">
                        {!!$articles->find(5)->content!!}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        {{$articles->find(6)->subject}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse" id="collapseFour" aria-labelledby="headingFour" data-bs-parent="#faq">
                    <div class="accordion-body">
                        {!!$articles->find(6)->content!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- open ticket --}}
<div class="container-fluid pb-3">
    <div class="container my-5" style="max-width: 1200px">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="img-container">
                    <img class="img-fluid" src="/images/customer-support.jpg" alt="Customer Support">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 d-flex align-items-center">
                <div class="">
                    <h2 class="mb-3">Tidak menemukan solusi?</h2>
                    <p class="text-muted">Anda bisa membuat tiket bantuan untuk mendapatkan bantuan lebih lanjut terhadap masalah Anda.</p>
                    <a href="/create" class="btn btn-custom-primary btn-lg my-2">Buat tiket bantuan</a>
                </div>
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