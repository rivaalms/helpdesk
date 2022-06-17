<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- custom css --}}
    {{-- <link rel="stylesheet" href="{{asset('/css/custom.css?v='),time()}}"> --}}
    <link rel="stylesheet" href="/css/custom.css">

    {{-- for faq links --}}
    {{-- <link rel="stylesheet" href="{{asset('/css/faq-links.css?v='),time()}}"> --}}
    <link rel="stylesheet" href="/css/faq-links.css">

    <title>Helpdesk</title>
  </head>

  <body class="bg-light">
    
    @include('layouts/header')
    <main>
      @yield('container')
    </main>
    @include('layouts/footer')

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    {{-- Feather Icons --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script>feather.replace()</script>
  </body>
</html>