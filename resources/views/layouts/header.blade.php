<nav class="navbar navbar-expand-lg shadow-sm navbar-light bg-light pb-1">
   <div class="container" style="max-width: 1200px">
      <div class="d-flex flex-grow-1">
         <a class="navbar-brand d-none d-lg-inline-block" href="/">{{ env('APP_NAME') }}</a>

         <div class="d-flex flex-grow-1 justify-content-end">
            <div class="text-end">
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                  aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
            </div>
         </div>
      </div>

      <div class="collapse navbar-collapse flex-grow-1 text-right" id="navbarNavAltMarkup">
         <div class="navbar-nav ms-auto flex-nowrap">
            <a class="{{ $title == 'home' ? 'border-bottom border-custom-navbar border-2' : '' }} nav-link ms-2"
               href="/">Beranda</a>
            <div class="dropdown">
               <a class="{{ $title == 'category' ? 'border-bottom border-custom-navbar border-2' : '' }} nav-link ms-2 dropdown-toggle"
                  href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Kategori
               </a>
               <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="categoryDropdown">
                  <li><a class="dropdown-item" href="/category/1">Komputer</a></li>
                  <li><a class="dropdown-item" href="/category/2">Perangkat Lunak</a></li>
                  <li><a class="dropdown-item" href="/category/3">Jaringan</a></li>
               </ul>
            </div>
            <a class="{{ $title == 'create' ? 'border-bottom border-custom-navbar border-2' : '' }} nav-link ms-2"
               href="/create">Buat Tiket</a>
            @auth
               <div class="dropdown">
                  <a class="{{ $title == 'user' ? 'border-bottom border-custom-navbar border-2' : '' }} nav-link dropdown-toggle ms-2"
                     href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                     aria-expanded="false">
                     {{ auth()->user()->name }}
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                     <li><a class="dropdown-item" href="/user">Profil Pengguna</a></li>
                     @auth
                        @if (auth()->user()->user_role_id == 2 || auth()->user()->user_role_id == 3)
                           <li><a href="/admin/dashboard" class="dropdown-item">Dasbor Teknisi</a></li>
                        @endif
                     @endauth
                     <li>
                        <form action="/logout" method="post">
                           @csrf
                           <button class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin keluar?')" type="submit">Keluar</button>
                        </form>
                     </li>
                  </ul>
               </div>
            @else
               <a class="nav-link ms-2 {{ $title == 'login' ? 'border-bottom border-custom-navbar border-2' : '' }}"
                  href="/login">Masuk</a>
            @endauth
         </div>
      </div>
   </div>
</nav>
