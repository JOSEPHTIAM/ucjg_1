<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Membres & Unité de la Jeunesse - UCJG</title>
        
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

        <!-- Navigation -->
        @include('structure.navbar')

        @include('structure.slider_membre_1')
        
        <!-- Contenu Principal -->
        <main class="py-5">
            <div class="container mb-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="text-center flex-grow-1">
                        <h2 class="fw-bold" style="color: var(--ucjg-blue);">Nos membres d'UCJG</h2>
                        <div style="width: 50px; height: 3px; background-color: var(--ucjg-gold); margin: 8px auto;"></div>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'Administrateur')
                            <button type="button" class="btn btn-modal-confirm" data-bs-toggle="modal" data-bs-target="#createMemberModal">
                                <i class="bi bi-person-plus-fill me-1"></i> Créer un membre
                            </button>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="container mb-4">
                <div class="filter-scroll-container d-flex flex-nowrap justify-content-start justify-content-md-center gap-2 pb-2">
                    <button type="button" class="btn btn-filter active" data-filter="all">Tous</button>
                    <button type="button" class="btn btn-filter" data-filter="Nouveau">Nouveaux</button>
                    <button type="button" class="btn btn-filter" data-filter="Ancien">Anciens</button>
                    <button type="button" class="btn btn-filter" data-filter="Partenaire">Partenaires</button>
                </div>
            </div>

            <div class="container mb-4">
                <div class="member-search-wrap">
                    <input
                        id="memberSearch"
                        type="search"
                        class="form-control members-search-input"
                        placeholder="Rechercher par nom, prénom, email, profession, voix, pays, anecdote..."
                        aria-label="Rechercher un membre"
                    >
                </div>
            </div>

            <div class="container">
                <div class="member-card-row" id="memberCards">
                    @forelse ($users as $user)
                        @php
                            $memberCategory = $user->membre ?? 'Nouveau';
                            $memberClass = strtolower(str_replace(' ', '-', $memberCategory));
                            $photoUrl = $user->photo ? asset('storage/' . $user->photo) : asset('images/default.svg');
                            $searchableText = collect([
                                $user->id,
                                $user->role,
                                $user->nom,
                                $user->prenom,
                                $user->membre,
                                $user->voix,
                                $user->genre,
                                $user->indicatif_pays,
                                $user->contact,
                                $user->profession,
                                $user->email,
                                $user->premiere_annee_ucjg,
                                $user->anecdote,
                                $user->releve_assuree,
                                $user->souhait_30_ans,
                            ])->filter()->implode(' ');
                            $isOwnProfile = auth()->check() && auth()->id() === $user->id;
                            $isAdmin = auth()->check() && auth()->user()->role === 'Administrateur';
                            $canEditUser = $isOwnProfile || $isAdmin;
                            $canDeleteUser = $isAdmin && !$isOwnProfile;
                        @endphp

                        <article
                            class="member-card member-card--{{ $memberClass }}"
                            data-category="{{ $memberCategory }}"
                            data-search="{{ strtolower($searchableText) }}"
                            data-user-id="{{ $user->id }}"
                            data-user-name="{{ e($user->nom) }}"
                            data-user-prenom="{{ e($user->prenom ?: '') }}"
                            data-user-membre="{{ e($user->membre) }}"
                            data-user-role="{{ e($user->role) }}"
                            data-user-voix="{{ e($user->voix) }}"
                            data-user-genre="{{ e($user->genre) }}"
                            data-user-pays="{{ e($user->indicatif_pays) }}"
                            data-user-contact="{{ e($user->contact) }}"
                            data-user-profession="{{ e($user->profession) }}"
                            data-user-email="{{ e($user->email) }}"
                            data-user-annee="{{ e($user->premiere_annee_ucjg) }}"
                            data-user-anecdote="{{ e($user->anecdote ?? 'Aucune') }}"
                            data-user-releve="{{ e($user->releve_assuree) }}"
                            data-user-souhait="{{ e($user->souhait_30_ans) }}"
                            data-user-photo="{{ $photoUrl }}"
                        >
                            <div class="member-card__actions">
                                @if($canDeleteUser)
                                    <button type="button" class="member-card__icon member-card__icon--danger member-delete-trigger" data-user-id="{{ $user->id }}" data-user-name="{{ e($user->prenom ? $user->prenom . ' ' . $user->nom : $user->nom) }}" data-bs-toggle="modal" data-bs-target="#deleteUserModal" aria-label="Supprimer ce profil">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                @endif

                                @if($canEditUser)
                                    <button type="button" class="member-card__icon member-card__icon--{{ $memberClass }} member-edit-trigger" data-user-id="{{ $user->id }}" data-user-name="{{ e($user->nom) }}" data-user-prenom="{{ e($user->prenom ?: '') }}" data-user-membre="{{ e($user->membre) }}" data-user-role="{{ e($user->role) }}" data-user-voix="{{ e($user->voix) }}" data-user-genre="{{ e($user->genre) }}" data-user-pays="{{ e($user->indicatif_pays) }}" data-user-contact="{{ e($user->contact) }}" data-user-profession="{{ e($user->profession) }}" data-user-email="{{ e($user->email) }}" data-user-annee="{{ e($user->premiere_annee_ucjg) }}" data-user-anecdote="{{ e($user->anecdote ?? 'Aucune') }}" data-user-releve="{{ e($user->releve_assuree) }}" data-user-souhait="{{ e($user->souhait_30_ans) }}" aria-label="Modifier le profil">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                @else
                                    <div class="member-card__icon member-card__icon--{{ $memberClass }}">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                @endif
                            </div>

                            <!--
                            <img src="{{ $photoUrl }}" alt="{{ $user->prenom ?? $user->nom }}" class="member-card__image">
                            -->
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->prenom ?? $user->nom }}" class="member-card__image">
                            
                            <div class="member-card__body">
                                <h5 class="member-card__name">{{ $user->prenom ?: $user->nom }}</h5>
                                <p class="member-card__role">{{ $user->membre }}</p>
                                <button type="button" class="btn btn-member btn-member--{{ $memberClass }} member-detail-btn" data-user-id="{{ $user->id }}">Voir plus</button>
                            </div>
                        </article>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="alert alert-light border rounded-4 shadow-sm mb-0">
                                Aucun membre enregistré pour le moment.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div id="memberEmptyState" class="member-empty-state" style="display: none;">
                    Aucun membre ne correspond à votre recherche.
                </div>
            </div>
        </main>

        <div class="modal fade member-modal member-modal--default" id="memberDetailModal" tabindex="-1" aria-labelledby="memberDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                    <div class="modal-header border-0 pb-0">
                        <div class="member-detail-header d-flex align-items-center gap-3 w-100">
                            <div class="member-detail-photo-wrap">
                                <img id="detailMemberPhoto" src="" alt="Photo du membre" class="member-detail-photo">
                            </div>
                            
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body p-4 pt-2">
                        <div class="row g-3">
                            <div class="member-detail-meta">
                                <div class="detail-field">
                                    <span>Membre: </span>
                                    <div id="detailMemberBadge" class="badge rounded-pill mt-2"></div>
                                </div>                                
                            </div>
                            
                            <div class="col-md-6">
                                <div class="detail-field"><span>Rôle: </span><strong id="detailRole"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Nom: </span><strong id="detailNom"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Prénom: </span><strong id="detailPrenom"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Voix: </span><strong id="detailVoix"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Genre: </span><strong id="detailGenre"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Pays: </span><strong id="detailPays"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Contact: </span><strong id="detailContact"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Profession: </span><strong id="detailProfession"></strong></div>
                            </div>
                            <div class="col-12">
                                <div class="detail-field"><span>Email: </span><strong id="detailEmail"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Première année UCJG: </span><strong id="detailAnnee"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Relevé assuré: </span><strong id="detailReleve"></strong></div>
                            </div>
                            <div class="col-12">
                                <div class="detail-field"><span>Anecdote: </span><strong id="detailAnecdote"></strong></div>
                            </div>
                            <div class="col-12">
                                <div class="detail-field"><span>Souhait 30 ans: </span><strong id="detailSouhait"></strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-arrow-left-circle-fill me-1"></i>Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        @auth
            <div class="modal fade member-modal member-modal--{{ strtolower(str_replace(' ', '-', auth()->user()->membre ?? 'Nouveau')) }}" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" data-member-category="{{ auth()->user()->membre ?? 'Nouveau' }}">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                    <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                        <form action="{{ route('member.update', auth()->user()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header border-0 pb-0">
                                <div>
                                    <h5 id="editProfileModalLabel" class="modal-title fw-bold mb-1" style="color: var(--ucjg-blue);">Modifier mon profil</h5>
                                    <small class="text-muted">Mettez à jour vos informations personnelles</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Photo</label>
                                        <input type="file" class="form-control" name="photo" accept="image/*">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Rôle</label>
                                        <select class="form-select" name="role" required>
                                            <option value="Utilisateur" {{ auth()->user()->role === 'Utilisateur' ? 'selected' : '' }}>Utilisateur</option>
                                            <option value="Administrateur" {{ auth()->user()->role === 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Nom</label>
                                        <input type="text" class="form-control" name="nom" value="{{ auth()->user()->nom }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Prénom</label>
                                        <input type="text" class="form-control" name="prenom" value="{{ auth()->user()->prenom }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Statut</label>
                                        <select class="form-select" name="membre" required>
                                            <option value="Ancien" {{ auth()->user()->membre === 'Ancien' ? 'selected' : '' }}>Ancien</option>
                                            <option value="Nouveau" {{ auth()->user()->membre === 'Nouveau' ? 'selected' : '' }}>Nouveau</option>
                                            <option value="Partenaire" {{ auth()->user()->membre === 'Partenaire' ? 'selected' : '' }}>Partenaire</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Voix</label>
                                        <select class="form-select" name="voix" required>
                                            <option value="Sopra" {{ auth()->user()->voix === 'Sopra' ? 'selected' : '' }}>Sopra</option>
                                            <option value="Alto" {{ auth()->user()->voix === 'Alto' ? 'selected' : '' }}>Alto</option>
                                            <option value="Ténor" {{ auth()->user()->voix === 'Ténor' ? 'selected' : '' }}>Ténor</option>
                                            <option value="Baryton" {{ auth()->user()->voix === 'Baryton' ? 'selected' : '' }}>Baryton</option>
                                            <option value="Bass" {{ auth()->user()->voix === 'Bass' ? 'selected' : '' }}>Bass</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Genre</label>
                                        <select class="form-select" name="genre" required>
                                            <option value="Homme" {{ auth()->user()->genre === 'Homme' ? 'selected' : '' }}>Homme</option>
                                            <option value="Femme" {{ auth()->user()->genre === 'Femme' ? 'selected' : '' }}>Femme</option>
                                            <option value="Non-genré" {{ auth()->user()->genre === 'Non-genré' ? 'selected' : '' }}>Non-genré</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Indicatif pays</label>
                                        <input type="text" class="form-control" name="indicatif_pays" value="{{ auth()->user()->indicatif_pays }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Contact</label>
                                        <input type="text" class="form-control" name="contact" value="{{ auth()->user()->contact }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Profession</label>
                                        <input type="text" class="form-control" name="profession" value="{{ auth()->user()->profession }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Première année UCJG</label>
                                        <input type="number" class="form-control" name="premiere_annee_ucjg" value="{{ auth()->user()->premiere_annee_ucjg }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Relevé assuré</label>
                                        <select class="form-select" name="releve_assuree" required>
                                            <option value="Oui" {{ auth()->user()->releve_assuree === 'Oui' ? 'selected' : '' }}>Oui</option>
                                            <option value="Non" {{ auth()->user()->releve_assuree === 'Non' ? 'selected' : '' }}>Non</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Anecdote</label>
                                        <textarea class="form-control" rows="3" name="anecdote">{{ auth()->user()->anecdote }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Souhait 30 ans</label>
                                        <textarea class="form-control" rows="3" name="souhait_30_ans" required>{{ auth()->user()->souhait_30_ans }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="submit" class="btn btn-modal-confirm"><i class="bi bi-check-circle-fill me-1"></i>Confirmer</button>
                                <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-arrow-left-circle-fill me-1"></i>Fermer</button>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endauth

        @auth
            @if(auth()->user()->role === 'Administrateur')
                <div class="modal fade member-modal member-modal--default" id="createMemberModal" tabindex="-1" aria-labelledby="createMemberModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                        <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                            <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header border-0 pb-0">
                                    <div>
                                        <h5 id="createMemberModalLabel" class="modal-title fw-bold mb-1" style="color: var(--ucjg-blue);">Créer un membre</h5>
                                        <small class="text-muted">Créer un profil utilisateur ou administrateur</small>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Photo *</label>
                                            <input type="file" name="photo" class="form-control" accept="image/*" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Rôle *</label>
                                            <select name="role" class="form-select" required>
                                                <option value="Utilisateur" selected>Utilisateur</option>
                                                <option value="Administrateur">Administrateur</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nom(s) *</label>
                                            <input type="text" name="nom" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Prénom(s) <span class="text-muted small">(Optionnel)</span></label>
                                            <input type="text" name="prenom" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Membre *</label>
                                            <select name="membre" class="form-select" required>
                                                <option value="Nouveau">Nouveau</option>
                                                <option value="Ancien">Ancien</option>
                                                <option value="Partenaire">Partenaire</option>
                                            </select>
                                        </div>

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

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Genre *</label>
                                            <select name="genre" class="form-select" required>
                                                <option value="Homme">Homme</option>
                                                <option value="Femme">Femme</option>
                                                <option value="Non-genré">Non-genré</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Indicatif pays *</label>
                                            <input type="text" name="indicatif_pays" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Contact *</label>
                                            <input type="text" name="contact" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Profession *</label>
                                            <input type="text" name="profession" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Adresse E-mail *</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Mot de passe (Min 4 caractères) *</label>
                                            <input type="password" name="password" class="form-control" minlength="4" required>
                                        </div>

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

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Pensez-vous que la relève a été assurée ? *</label>
                                            <select name="releve_assuree" class="form-select" required>
                                                <option value="Oui">Oui</option>
                                                <option value="Non">Non</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Votre anecdote</label>
                                            <textarea name="anecdote" class="form-control" rows="2" placeholder="Aucune"></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Que souhaitez-vous de plus à ce mouvement en cette célébration des 30 ans ? *</label>
                                            <textarea name="souhait_30_ans" class="form-control" rows="4" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="submit" class="btn btn-modal-confirm"><i class="bi bi-check-circle-fill me-1"></i>Confirmer</button>
                                    <button type="reset" class="btn btn-ucjg-gold"><i class="bi bi-eraser-fill me-1"></i>Effacer</button>
                                    <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-arrow-left-circle-fill me-1"></i>Retour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endauth

        <div class="modal fade member-modal member-modal--default" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header border-0 pb-0">
                            <div>
                                <h5 id="deleteUserModalLabel" class="modal-title fw-bold mb-1" style="color: var(--ucjg-red);">Supprimer le profil</h5>
                                <small class="text-muted">Cette action est irréversible.</small>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body p-4">
                            <p class="mb-0">Voulez-vous vraiment supprimer le profil de <strong id="deleteUserName"></strong> ?</p>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="submit" class="btn btn-modal-confirm"><i class="bi bi-check-circle-fill me-1"></i>Confirmer</button>
                            <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill me-1"></i>Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Composant Retour en haut -->
        @include('structure.hauteur')

        <!-- Pied de Page -->
        @include('structure.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>