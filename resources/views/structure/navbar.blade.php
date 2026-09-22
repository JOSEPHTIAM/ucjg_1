<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('ucjg_sodikoville.jpg') }}" alt="Logo UCJG" class="me-2">
            <div>
                <div class="navbar-brand-text">UCJG SODIKO-VILLE</div>
                <div class="navbar-brand-subtext">Union Chrétienne des Jeunes Gens</div>
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active-link' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door-fill me-1"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active-link' : '' }}" href="{{ route('about') }}">
                        <i class="bi bi-info-circle-fill me-1"></i> À Propos
                    </a>
                </li>

                <!-- Gestion dynamique Utilisateur Connecté / Non Connecté -->
                @auth
                <li class="nav-item dropdown ms-lg-2">
                    <a class="btn btn-ucjg-blue dropdown-toggle d-flex align-items-center gap-2 shadow-sm" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle" style="width: 28px; height: 28px; object-fit: cover;">
                        <span>{{ Auth::user()->nom }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-ucjg-gold shadow-sm">
                        <i class="bi bi-person-fill me-1"></i> Connexion
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>