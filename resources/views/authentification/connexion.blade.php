<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion - UCJG Sodiko-Ville</title>
        
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

    
    <body class="bg-light d-flex flex-column min-vh-100">

        <!-- Navigation -->
        @include('structure.navbar')

        @include('structure.slider_connexion')

        <!-- Formulaire de Connexion -->
        <main class="py-5 my-auto">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-5">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4 p-sm-5">
                                
                                <!-- Header de la carte -->
                                <div class="text-center mb-4">
                                    <img src="{{ asset('ucjg_sodikoville.jpg') }}" alt="Logo UCJG" class="rounded-circle shadow-sm mb-2" style="width: 150px; height: 150px; object-fit: cover;">
                                    <div style="width: 40px; height: 3px; background-color: var(--ucjg-gold); margin: 0 auto;"></div>
                                </div>

                                <form id="loginForm" action="#" method="POST">
                                    @csrf

                                    <!-- Champ E-mail -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold" style="color: var(--ucjg-blue);">Adresse E-mail</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope-fill text-muted"></i></span>
                                            <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" placeholder="votre.email@exemple.com" required>
                                        </div>
                                    </div>

                                    <!-- Champ Mot de passe avec Icône de Visibilité -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-semibold" style="color: var(--ucjg-blue);">Mot de passe</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock-fill text-muted"></i></span>
                                            <input type="password" class="form-control border-start-0 border-end-0 ps-0" id="password" name="password" placeholder="••••••••" required>
                                            <button class="btn btn-outline-secondary bg-white border-start-0" type="button" id="togglePassword">
                                                <i class="bi bi-eye-slash-fill" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Liens horizontaux : Mot de passe oublié & Nouveau mot de passe -->
                                    <div class="d-flex justify-content-between align-items-center mb-4 small">
                                        <a href="#" class="text-decoration-none fw-medium text-muted hover-gold">
                                            <i class="bi bi-question-circle me-1"></i>Mot de passe oublié ?
                                        </a>
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-medium text-muted hover-gold">
                                            <i class="bi bi-key-fill me-1"></i>Nouveau mot de passe
                                        </a>
                                    </div>

                                    <!-- Boutons horizontaux : Retour, Effacer, Confirmer -->
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-ucjg-blue w-100 fw-semibold px-1">
                                                <i class="bi bi-check-circle-fill me-1"></i>Confirmer
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button type="reset" class="btn btn-ucjg-gold w-100 fw-semibold px-1">
                                                <i class="bi bi-eraser-fill me-1"></i>Effacer
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" onclick="history.back()" class="btn btn-ucjg-red w-100 fw-semibold px-1">
                                                <i class="bi bi-arrow-left-circle-fill me-1"></i>Retour
                                            </button> 
                                        </div>                                                                                
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Composant Retour en haut -->
        @include('structure.hauteur')

        <!-- Pied de Page -->
        @include('structure.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        
        <!-- Script d'affichage / masquage du mot de passe -->
        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('bi-eye-slash-fill');
                    toggleIcon.classList.add('bi-eye-fill');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('bi-eye-fill');
                    toggleIcon.classList.add('bi-eye-slash-fill');
                }
            });
        </script>
    </body>
</html>