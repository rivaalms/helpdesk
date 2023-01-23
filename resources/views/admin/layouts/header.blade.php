<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm pb-1">
   <div class="container-fluid" style="padding: 0px 128px;">
      <div class="d-flex flex-grow-1">
         <a class="navbar-brand d-lg-inline-block" href="/">{{ env('APP_NAME') }}</a>
         <p class="navbar-text d-inline-block m-0">| Teknisi</p>

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
            <a class="{{ $title == 'summary' ? 'border-bottom border-custom-navbar border-2' : '' }} nav-link ms-2"
               href="/admin/dashboard">Statistik</a>
            <a class="{{ $title == 'tickets' ? 'border-bottom border-custom-navbar border-2' : '' }} nav-link ms-2"
               href="/admin/tickets">Daftar Tiket</a>
            @if (auth()->user()->user_role_id == 3)
               <a class="{{ $title == 'register_request' ? 'border-bottom border-custom-navbar border-2' : '' }} nav-link ms-2"
                  href="/admin/register-request">Permohonan Registrasi</a>
            @endif
            <div class="dropdown">
               <a class="nav-link dropdown-toggle ms-2" href="#" id="navbarDarkDropdownMenuLink" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  {{ auth()->user()->name }}
               </a>
               <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="/user">Profil pengguna</a></li>
                  <li>
                     <form action="/logout" method="post">
                        @csrf
                        <button class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin keluar?')" type="submit">Keluar</button>
                     </form>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</nav>
