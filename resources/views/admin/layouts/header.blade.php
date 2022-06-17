<nav class="navbar navbar-expand-lg navbar-light bg-custom-navbar pb-3">
    <div class="container" style="max-width: 1200px">
        <div class="d-flex flex-grow-1">
            <a class="navbar-brand d-none d-lg-inline-block" href="/">Navbar</a>
        
            <div class="w-100 text-right">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <div class="collapse navbar-collapse flex-grow-1 text-right" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto flex-nowrap">
                <a class="nav-link ms-2" href="/admin/dashboard">Summary</a>
                <a class="nav-link ms-2" href="/admin/tickets">Tickets</a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle ms-2" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="/user">User Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                      </ul>
                </div>
            </div>
      </div>
    </div>
  </nav>