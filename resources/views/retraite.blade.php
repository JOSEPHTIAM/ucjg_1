<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Programme de la Retraite Spirituelle 2026 - UCJG</title>
        
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
        
        <!-- En-tête de la page -->
        @include('structure.slider_retraite_1')         

        <!-- Structure Générale -->
        <section class="py-4 bg-light border-bottom">
            <div class="container">
                <div class="row g-3 text-center">
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded-3 shadow-sm border-start border-4 border-warning">
                            <i class="bi bi-clock-history text-warning fs-3 mb-2 d-block"></i>
                            <h6 class="fw-bold text-uppercase mb-1" style="color: var(--ucjg-blue);">Durée du Jeûne</h6>
                            <p class="mb-0 text-muted small">5 jours (du Lundi au Vendredi)</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded-3 shadow-sm border-start border-4 border-warning">
                            <i class="bi bi-geo-alt-fill text-warning fs-3 mb-2 d-block"></i>
                            <h6 class="fw-bold text-uppercase mb-1" style="color: var(--ucjg-blue);">Rencontre Quotidienne</h6>
                            <p class="mb-0 text-muted small">Une seule rencontre à 18h00 chaque jour</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded-3 shadow-sm border-start border-4 border-warning">
                            <i class="bi bi-people-fill text-warning fs-3 mb-2 d-block"></i>
                            <h6 class="fw-bold text-uppercase mb-1" style="color: var(--ucjg-blue);">Sixième Jour (Samedi)</h6>
                            <p class="mb-0 text-muted small">Journée d'activité pour célébrer la fin du jeûne et renforcer les liens</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programme Quotidien (Lundi à Samedi) -->
        @include('structure.slider_retraite_2') 

        <main class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="color: var(--ucjg-blue);">Planning Quotidien</h2>
                    <div style="width: 50px; height: 3px; background-color: var(--ucjg-gold); margin: 8px auto;"></div>
                </div>

                <div class="row justify-content-center g-4">

                    <!-- LUNDI -->
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header text-white p-3 d-flex justify-content-between align-items-center" style="background-color: var(--ucjg-blue);">
                                <h5 class="fw-bold mb-0"><i class="bi bi-calendar-day me-2"></i> Lundi 21 Septembre 2026</h5>
                                <span class="badge bg-warning text-dark">Jour 1</span>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-warning mb-1">Se consacrer à Dieu pour mieux le servir</h5>
                                <p class="mb-1 fw-semibold">Thème du jour : <span class="text-muted">L’appel au service (Romains 12 : 1-2)</span></p>
                                <p class="small text-muted mb-3"><i class="bi bi-bullseye me-1"></i> <strong>Objectif :</strong> Commencer la retraite dans la repentance, la consécration et la recherche de la présence de Dieu.</p>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>06h00 - 18h00 :</strong> Jeûne et méditation personnelle</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h00 - 18h30 :</strong> Louange, adoration et introduction au thème</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h30 - 19h30 :</strong> Enseignement du thème — <em>Intervenants : HERMINE + FRANCIS</em></li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>19h30 - 20h00 :</strong> Sujets de prière + Prière de clôture</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- MARDI -->
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header text-white p-3 d-flex justify-content-between align-items-center" style="background-color: var(--ucjg-blue);">
                                <h5 class="fw-bold mb-0"><i class="bi bi-calendar-day me-2"></i> Mardi 22 Septembre 2026</h5>
                                <span class="badge bg-warning text-dark">Jour 2</span>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-warning mb-1">Servir quand personne ne regarde</h5>
                                <p class="mb-1 fw-semibold">Thème du jour : <span class="text-muted">L’intégrité du serviteur (Proverbes 11 : 3, Psaume 15)</span></p>
                                <p class="small text-muted mb-3"><i class="bi bi-bullseye me-1"></i> <strong>Objectif :</strong> Être un témoignage vivant du Christ.</p>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>06h00 - 18h00 :</strong> Jeûne et méditation personnelle</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h00 - 18h30 :</strong> Louange, adoration et introduction au thème</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h30 - 19h30 :</strong> Enseignement du thème — <em>Intervenants : JONATHAN + ELIE</em></li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>19h30 - 20h00 :</strong> Sujets de prière + Prière de clôture</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- MERCREDI -->
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header text-white p-3 d-flex justify-content-between align-items-center" style="background-color: var(--ucjg-blue);">
                                <h5 class="fw-bold mb-0"><i class="bi bi-calendar-day me-2"></i> Mercredi 23 Septembre 2026</h5>
                                <span class="badge bg-warning text-dark">Jour 3</span>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-warning mb-1">Le tablier avant le trône</h5>
                                <p class="mb-1 fw-semibold">Thème du jour : <span class="text-muted">Le modèle de Jésus (Jean 13 : 1-7)</span></p>
                                <p class="small text-muted mb-3"><i class="bi bi-bullseye me-1"></i> <strong>Objectif :</strong> Comprendre que le véritable leadership s’exprime par le service, l’amour et l’humilité.</p>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>06h00 - 18h00 :</strong> Jeûne et méditation personnelle</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h00 - 18h30 :</strong> Louange, adoration</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h30 - 19h30 :</strong> Exhortation — <em>Intervenants : NOÉ + RAÏSSA</em></li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>19h30 - 20h00 :</strong> Jeux bibliques + Prière de clôture</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- JEUDI -->
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header text-white p-3 d-flex justify-content-between align-items-center" style="background-color: var(--ucjg-blue);">
                                <h5 class="fw-bold mb-0"><i class="bi bi-calendar-day me-2"></i> Jeudi 24 Septembre 2026</h5>
                                <span class="badge bg-warning text-dark">Jour 4</span>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-warning mb-1">Quand servir devient une compétition, servir même quand on est fatigué</h5>
                                <p class="mb-1 fw-semibold">Thème du jour : <span class="text-muted">Persévérer dans la fidélité, combattre l’orgueil et la comparaison (Galates 6 : 9, 1 Corinthiens 15 : 58, Philippiens 2 : 3-11)</span></p>
                                <p class="small text-muted mb-3"><i class="bi bi-bullseye me-1"></i> <strong>Objectif :</strong> Développer un esprit désintéressé et rester engagé jusqu’au bout.</p>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>06h00 - 18h00 :</strong> Jeûne et méditation personnelle</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h00 - 18h30 :</strong> Louange, adoration</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h30 - 19h30 :</strong> Enseignement — <em>Intervenants : PASTEUR + NICAISE</em></li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>19h30 - 20h00 :</strong> Sujets de prière + Prière de clôture</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- VENDREDI -->
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header text-white p-3 d-flex justify-content-between align-items-center" style="background-color: var(--ucjg-blue);">
                                <h5 class="fw-bold mb-0"><i class="bi bi-calendar-day me-2"></i> Vendredi 25 Septembre 2026</h5>
                                <span class="badge bg-warning text-dark">Jour 5</span>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-warning mb-1">Débat autour du thème principal</h5>
                                <p class="mb-1 fw-semibold">Méditation : <span class="text-muted">Marc 10 : 45</span></p>
                                <p class="small text-muted mb-3"><i class="bi bi-bullseye me-1"></i> <strong>Objectif :</strong> Connaître le pour et le contre et savoir se décider seul en âme et conscience.</p>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>06h00 - 18h00 :</strong> Jeûne et méditation personnelle</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h00 - 18h30 :</strong> Louange, adoration</li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>18h30 - 19h30 :</strong> Débat sur le thème — <em>Intervenants : FLORINE + HERMAN</em></li>
                                    <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i><strong>19h30 - 20h00 :</strong> Sujets de prière + Prière de clôture</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- SAMEDI (ACTIVITÉS FINALES) -->
                    <div class="col-lg-10">
                        <div class="card border-warning shadow-sm rounded-4 bg-light overflow-hidden">
                            <div class="card-header text-dark p-3 bg-warning d-flex justify-content-between align-items-center fw-bold">
                                <span><i class="bi bi-star-fill me-2"></i> Samedi 26 Septembre 2026 — Journée de Clôture</span>
                                <span class="badge bg-dark text-white">Célébration</span>
                            </div>
                            <div class="card-body p-4 text-center">
                                <h5 class="fw-bold" style="color: var(--ucjg-blue);">Journée d'Activité et Fraternité</h5>
                                <p class="mb-0">Célébration de la fin du jeûne et renforcement des liens fraternels du mouvement.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <!-- Inclure le composant Retour en haut -->
        @include('structure.hauteur')
        
        @include('structure.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>