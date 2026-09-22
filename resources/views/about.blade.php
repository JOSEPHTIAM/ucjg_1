<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>À Propos - UCJG Sodiko-Ville</title>
        
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

        <!-- Barre de Navigation -->
        @include('structure.navbar')

        @include('structure.slider_about_1')
        
        <!-- Contenu Principal (Texte issu de la photo) -->
        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        
                        <!-- 1. CONTEXTE -->
                        <div id="contexte" class="mb-5">
                            <h3 class="fw-bold text-uppercase pb-2 border-bottom border-warning" style="color: var(--ucjg-blue);">
                                1. CONTEXTE
                            </h3>
                            <p class="mt-3 text-justify leading-relaxed">
                                L'Union Chrétienne des Jeunes Gens (UCJG) de Sodiko-Ville a été créée il y a 30 ans avec pour vision d'encadrer spirituellement, moralement et socialement les jeunes de la communauté. Depuis trois décennies, l'UCJG s'est engagée dans l'évangélisation, la formation, l'action sociale et la promotion des valeurs chrétiennes.
                            </p>
                            <p class="text-justify leading-relaxed">
                                La célébration de ce jubilé est une occasion de rendre grâce à Dieu pour sa fidélité, d'honorer les pionniers, de renforcer les liens entre les générations et de projeter l'association vers un avenir encore plus dynamique.
                            </p>
                        </div>

                        <!-- 2. JUSTIFICATION -->
                        <div id="justification" class="mb-5">
                            <h3 class="fw-bold text-uppercase pb-2 border-bottom border-warning" style="color: var(--ucjg-blue);">
                                2. JUSTIFICATION
                            </h3>
                            <p class="mt-3">
                                Trente années d'existence méritent d'être commémorées pour :
                            </p>
                            <ul class="list-group list-group-flush shadow-sm rounded-3">
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                                    <span>Rendre grâce à Dieu pour son accompagnement.</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                                    <span>Honorer les sacrifices des pionniers et anciens responsables.</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                                    <span>Renforcer l'unité et l'appartenance des membres.</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                                    <span>Mobiliser les jeunes et partenaires autour d'une vision commune.</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-3 fs-5"></i>
                                    <span>Donner une visibilité à l'UCJG et à ses réalisations.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- BLOC THÈME (Encadré) -->
                        <div id="theme" class="card border-warning bg-light p-4 rounded-4 shadow-sm text-center my-4">
                            <h4 class="fw-bold text-uppercase mb-3" style="color: var(--ucjg-blue);">THÈME</h4>
                            <blockquote class="blockquote mb-0 fs-5 fw-semibold" style="color: var(--ucjg-blue);">
                                « Servir avec intégrité et humilité. »
                            </blockquote>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        <!-- Inclure le composant Retour en haut -->
        @include('structure.hauteur')
    
        <!-- Pied de Page -->
        @include('structure.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>