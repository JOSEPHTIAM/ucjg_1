<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>UCJG de Sodiko-ville de Douala</title>
        
        <link rel="icon" type="image/png" href="{{ asset('ucjg_sodikoville.jpg') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS & Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Fichier CSS personnalisé -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    
    <body>

        @include('structure.navbar')

        @include('structure.slider')

        <section id="piliers" class="py-5">
            <div class="container my-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="color: var(--ucjg-blue);">Nos piliers fondamentaux</h2>
                    <div style="width: 50px; height: 3px; background-color: var(--ucjg-gold); margin: 8px auto;"></div>
                </div>

                <div class="row g-4">
                
                    <!-- SEULE CETTE CARTE OUVRE LA PAGE DU PROGRAMME DE LA RETRAITE SPIRITUELLE -->
                    <div class="col-md-4">
                        <a href="{{ route('retraite') }}" class="feature-card-link">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                                <h4 style="color: var(--ucjg-blue);">Retraite et Méditation</h4>
                                <p class="text-muted small mb-0">Programme de la retraite spirituelle 2026 : 5 jours de jeûne, prière et enseignement.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('membre_ucjg') }}" class="feature-card-link">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-people"></i></div>
                                <h4 style="color: var(--ucjg-blue);">Unité de la Jeunesse</h4>
                                <p class="text-muted small mb-0">Fraternité et dynamisme au sein de notre communauté à Sodiko-Ville.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('about') }}" class="feature-card-link">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-book"></i></div>
                                <h4 style="color: var(--ucjg-blue);">Parole et Enseignement</h4>
                                <p class="text-muted small mb-0">La Parole de Dieu comme fondement et guidance pour chaque jeune.</p>
                            </div>
                        </a>
                    </div>

                    <!-- Carte 3 cliquable vers A Propos -->
                    <div class="col-md-4">
                        <a href="{{ route('about') }}" class="feature-card-link">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-trophy"></i></div>
                                <h4 style="color: var(--ucjg-blue);">Foi et Engagement</h4>
                                <p class="text-muted small mb-0">Engagement actif dans les projets spirituels et sociaux.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Inclure le composant Retour en haut -->
        @include('structure.hauteur')
        
        @include('structure.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>