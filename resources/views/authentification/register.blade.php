<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription - UCJG Sodiko-Ville</title>
        
        <link rel="icon" type="image/png" href="{{ asset('ucjg_sodikoville.jpg') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- Libraryintl-tel-input pour la validation des numéros et drapeaux -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    
    <body class="bg-light d-flex flex-column min-vh-100">

        <!-- Navigation -->
        @include('structure.navbar')

        @include('structure.slider_inscription')
        
        <main class="py-5 my-auto">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4 p-md-5">
                                
                                <!-- Header de la carte -->
                                <div class="text-center mb-4">
                                    <img src="{{ asset('ucjg_sodikoville.jpg') }}" alt="Logo UCJG" class="rounded-circle shadow-sm mb-2" style="width: 150px; height: 150px; object-fit: cover;">
                                    <div style="width: 40px; height: 3px; background-color: var(--ucjg-gold); margin: 0 auto;"></div>
                                </div>

                                <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data" id="registerForm">
                                    @csrf

                                    <div class="row g-3">
                                        <!-- Photo -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Photo *</label>
                                            <input type="file" name="photo" class="form-control" accept="image/*" required>
                                        </div>

                                        <!-- Rôle -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Rôle *</label>
                                            <select name="role" class="form-select" required>
                                                <option value="Utilisateur" selected>Utilisateur</option>
                                                <option value="Administrateur">Administrateur</option>
                                            </select>
                                        </div>

                                        <!-- Nom(s) -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nom(s) *</label>
                                            <input type="text" name="nom" class="form-control" required>
                                        </div>

                                        <!-- Prénom(s) (OPTIONNEL) -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Prénom(s) <span class="text-muted small">(Optionnel)</span></label>
                                            <input type="text" name="prenom" class="form-control">
                                        </div>

                                        <!-- Membre -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Membre *</label>
                                            <select name="membre" class="form-select" required>
                                                <option value="Nouveau">Nouveau</option>
                                                <option value="Ancien">Ancien</option>
                                            </select>
                                        </div>

                                        <!-- Voix -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Voix *</label>
                                            <select name="voix" class="form-select" required>
                                                <option value="Sopra">Sopra</option>
                                                <option value="Alto">Alto</option>
                                                <option value="Ténor">Ténor</option>
                                                <option value="Baryton">Baryton</option>
                                                <option value="Bass">Bass</option>
                                            </select>
                                        </div>

                                        <!-- Genre -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Genre *</label>
                                            <select name="genre" class="form-select" required>
                                                <option value="Homme">Homme</option>
                                                <option value="Femme">Femme</option>
                                                <option value="Non-genré">Non-genré</option>
                                            </select>
                                        </div>

                                        <!-- Contact avec drapeaux -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold d-block">Contact *</label>
                                            <input type="tel" id="phone" class="form-control w-100" required>
                                            <input type="hidden" name="indicatif_pays" id="indicatif_pays">
                                            <input type="hidden" name="contact" id="contact_num">
                                        </div>

                                        <!-- Profession -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Profession *</label>
                                            <input type="text" name="profession" class="form-control" required>
                                        </div>

                                        <!-- Mail -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Adresse E-mail *</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>

                                        <!-- Mot de passe (min 4 caractères) -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Mot de passe (Min 4 caractères) *</label>
                                            <input type="password" name="password" class="form-control" minlength="4" required>
                                        </div>

                                        <!-- Première année UCJG -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Votre première année à l'UCJG *</label>
                                            <select name="premiere_annee_ucjg" class="form-select" required>
                                                @php
                                                    $year = date('Y');
                                                @endphp
                                                @for ($i = $year; $i >= 1990; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <!-- Relève après votre départ -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Pensez-vous que la relève a été assurée ? *</label>
                                            <select name="releve_assuree" class="form-select" required>
                                                <option value="Oui">Oui</option>
                                                <option value="Non">Non</option>
                                            </select>
                                        </div>

                                        <!-- Anecdote -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Votre anecdote</label>
                                            <textarea name="anecdote" class="form-control" rows="2" placeholder="Aucune"></textarea>
                                        </div>

                                        <!-- Souhait 30 ans -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Que souhaitez-vous de plus à ce mouvement en cette célébration des 30 ans ? *</label>
                                            <textarea name="souhait_30_ans" class="form-control" rows="4" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Boutons d'action -->
                                    <div class="row g-2 mt-4">
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-ucjg-blue w-100 fw-semibold"><i class="bi bi-check-circle-fill me-1"></i>Confirmer</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="reset" class="btn btn-ucjg-gold w-100 fw-semibold"><i class="bi bi-eraser-fill me-1"></i>Effacer</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" onclick="history.back()" class="btn btn-ucjg-red w-100 fw-semibold"><i class="bi bi-arrow-left-circle-fill me-1"></i>Retour</button>
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
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        
        <script>
            const phoneInput = document.querySelector("#phone");
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "cm", // Cameroun par défaut
                preferredCountries: ["cm", "fr", "us", "gb"],
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
            });

            document.querySelector("#registerForm").addEventListener("submit", function(e) {
                if (!iti.isValidNumber()) {
                    e.preventDefault();
                    alert("Le numéro de téléphone ne correspond pas au pays sélectionné. Le champ va être réinitialisé.");
                    phoneInput.value = "";
                } else {
                    document.querySelector("#indicatif_pays").value = "+" + iti.getSelectedCountryData().dialCode;
                    document.querySelector("#contact_num").value = iti.getNumber();
                }
            });
        </script>
    </body>
</html>