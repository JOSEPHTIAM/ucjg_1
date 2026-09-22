<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vidéos UCJG</title>

        <link rel="icon" type="image/png" href="{{ asset('ucjg_sodikoville.jpg') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        @include('structure.navbar')
        @include('structure.slider_video_1')

        <main class="py-5">
            <div class="container mb-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="text-center flex-grow-1">
                        <h2 class="fw-bold" style="color: var(--ucjg-blue);">Nos vidéos d'UCJG</h2>
                        <div style="width: 50px; height: 3px; background-color: var(--ucjg-gold); margin: 8px auto;"></div>
                    </div>

                    @auth
                        <button type="button" class="btn btn-modal-confirm video-create-trigger" data-bs-toggle="modal" data-bs-target="#createVideoModal">
                            <i class="bi bi-camera-video-fill me-1"></i> Créer une vidéo
                        </button>
                    @endauth
                </div>
            </div>

            <div class="container mb-4">
                <div class="filter-scroll-container d-flex flex-nowrap justify-content-start justify-content-md-center gap-2 pb-2">
                    <button type="button" class="btn btn-filter active" data-filter="all">Tous</button>
                </div>
            </div>

            <div class="container mb-4">
                <div class="member-search-wrap">
                    <input
                        id="memberSearch"
                        type="search"
                        class="form-control members-search-input"
                        placeholder="Rechercher par identitée, chemin de vidéo, ID de vidéo, utilisateur..."
                        aria-label="Rechercher une vidéo"
                    >
                </div>
            </div>

            <div class="container">
                <div class="member-card-row" id="memberCards">
                    @forelse ($videos as $video)
                        @php
                            $videoUrl = $video->video_url ?? asset('images/default-video.png');
                            $isOwnVideo = auth()->check() && auth()->id() === $video->user_id;
                            $isAdmin = auth()->check() && auth()->user()->role === 'Administrateur';
                            $canEditVideo = $isOwnVideo || $isAdmin;
                            $canDeleteVideo = $canEditVideo;
                            $searchableText = collect([
                                $video->id_video,
                                $video->video,
                                $video->identite,
                                $video->user_id,
                            ])->filter()->implode(' ');
                        @endphp

                        @php
                            $personFullName = trim(($video->user?->prenom ?? '') . ' ' . ($video->user?->nom ?? ''));
                            $personName = $personFullName !== '' ? $personFullName : 'Utilisateur inconnu';
                        @endphp

                        <article
                            class="member-card member-card--nouveau"
                            data-category="all"
                            data-search="{{ strtolower($searchableText) }}"
                            data-video-id="{{ $video->id_video }}"
                            data-video-identite="{{ e($video->identite) }}"
                            data-video-url="{{ $videoUrl }}"
                            data-video-user-name="{{ e($personName) }}"
                            data-video-user-member="{{ e($video->user?->membre ?? 'Inconnu') }}"
                            data-video-user-id="{{ $video->user_id }}"
                            data-video-created="{{ $video->created_at ? $video->created_at->format('d/m/Y H:i') : '' }}"
                        >
                            <div class="member-card__actions">
                                @if($canDeleteVideo)
                                    <button type="button" class="member-card__icon member-card__icon--danger video-delete-trigger" data-video-id="{{ $video->id_video }}" data-video-identite="{{ e($video->identite) }}" data-bs-toggle="modal" data-bs-target="#deleteVideoModal" aria-label="Supprimer cette vidéo">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                @endif

                                @if($canEditVideo)
                                    <button type="button" class="member-card__icon member-card__icon--nouveau video-edit-trigger" data-video-id="{{ $video->id_video }}" aria-label="Modifier ma vidéo">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                @else
                                    <div class="member-card__icon member-card__icon--nouveau">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                @endif
                            </div>

                            <video class="member-card__image" controls preload="metadata" playsinline>
                                <!--
                                <source src="{{ $videoUrl }}" type="video/mp4">
                                -->
                                <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos HTML5.
                            </video>

                            <div class="member-card__body">
                                <h5 class="member-card__name">{{ $video->identite }}</h5>
                                <p class="member-card__role">{{ $personName }}</p>
                                <button type="button" class="btn btn-member btn-member--nouveau video-detail-btn" data-video-id="{{ $video->id_video }}">Voir plus</button>
                            </div>
                        </article>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="alert alert-light border rounded-4 shadow-sm mb-0">
                                Aucun membre ne correspond à votre recherche.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div id="memberEmptyState" class="member-empty-state" style="display: none;">
                    Aucun membre ne correspond à votre recherche.
                </div>
            </div>
        </main>

        <div class="modal fade member-modal member-modal--default" id="videoDetailModal" tabindex="-1" aria-labelledby="videoDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                    <div class="modal-header border-0 pb-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border border-3 bg-light" style="width: 72px; height: 72px;">
                                <i class="bi bi-camera-video-fill text-primary display-6"></i>
                            </div>
                            <div>
                                <h5 id="videoDetailTitle" class="modal-title mb-0 fw-bold"></h5>
                                <div class="badge rounded-pill mt-2 bg-primary">Vidéo</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body p-4 pt-2">
                        <div class="mb-3">
                            <video id="videoDetailPlayer" class="img-fluid rounded-3 w-100" controls playsinline style="max-height: 320px; background: #000;">
                                <source src="" type="video/mp4">
                            </video>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="detail-field"><span>Identité de la vidéo: </span><strong id="videoDetailIdentity"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>ID de la vidéo: </span><strong id="videoDetailId"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Nom & prénom: </span><strong id="videoDetailUserName"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Membre: </span><strong id="videoDetailUserMember"></strong></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-field"><span>Date: </span><strong id="videoDetailDate"></strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill me-1"></i>Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        @auth
            <div class="modal fade member-modal member-modal--nouveau" id="createVideoModal" tabindex="-1" aria-labelledby="createVideoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                    <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                        <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header border-0 pb-0">
                                <div>
                                    <h5 id="createVideoModalLabel" class="modal-title fw-bold mb-1" style="color: var(--ucjg-blue);">Créer une vidéo</h5>
                                    <small class="text-muted">Enregistrez une vidéo de 5 minutes maximum</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Nom de la vidéo</label>
                                        <input type="text" class="form-control" name="identite" placeholder="Ex: Témoignage d'UCJG" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Vidéo</label>
                                        <input type="file" class="form-control" name="video" accept="video/*" capture="user" required>
                                        <small class="text-muted">Format vidéo accepté : MP4, WEBM, MOV, AVI. Durée maximum : 5 minutes.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="submit" class="btn btn-modal-confirm"><i class="bi bi-check-circle-fill me-1"></i>Confirmer</button>
                                <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill me-1"></i>Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade member-modal member-modal--nouveau" id="editVideoModal" tabindex="-1" aria-labelledby="editVideoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                    <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                        <form id="editVideoForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header border-0 pb-0">
                                <div>
                                    <h5 id="editVideoModalLabel" class="modal-title fw-bold mb-1" style="color: var(--ucjg-blue);">Modifier ma vidéo</h5>
                                    <small class="text-muted">Mettez à jour votre vidéo</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Nom de la vidéo</label>
                                        <input type="text" class="form-control" id="editVideoIdentity" name="identite" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Nouvelle vidéo</label>
                                        <input type="file" class="form-control" name="video" accept="video/*" capture="user">
                                        <small class="text-muted">Laissez vide si vous ne souhaitez pas la modifier.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="submit" class="btn btn-modal-confirm"><i class="bi bi-check-circle-fill me-1"></i>Confirmer</button>
                                <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill me-1"></i>Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endauth

        <div class="modal fade member-modal member-modal--nouveau" id="deleteVideoModal" tabindex="-1" aria-labelledby="deleteVideoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                <div class="modal-content shadow-lg rounded-4 overflow-hidden">
                    <form id="deleteVideoForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header border-0 pb-0">
                            <div>
                                <h5 id="deleteVideoModalLabel" class="modal-title fw-bold mb-1" style="color: var(--ucjg-red);">Supprimer la vidéo</h5>
                                <small class="text-muted">Cette action est irréversible.</small>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body p-4">
                            <p class="mb-0">Voulez-vous vraiment supprimer la vidéo <strong id="deleteVideoName"></strong> ?</p>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="submit" class="btn btn-modal-confirm"><i class="bi bi-check-circle-fill me-1"></i>Confirmer</button>
                            <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill me-1"></i>Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('structure.hauteur')
        @include('structure.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const videoDetailModal = document.getElementById('videoDetailModal');
                const videoDetailTitle = document.getElementById('videoDetailTitle');
                const videoDetailIdentity = document.getElementById('videoDetailIdentity');
                const videoDetailId = document.getElementById('videoDetailId');
                const videoDetailUserName = document.getElementById('videoDetailUserName');
                const videoDetailUserMember = document.getElementById('videoDetailUserMember');
                const videoDetailDate = document.getElementById('videoDetailDate');
                const videoDetailPlayer = document.getElementById('videoDetailPlayer');
                const deleteVideoForm = document.getElementById('deleteVideoForm');
                const deleteVideoName = document.getElementById('deleteVideoName');

                document.querySelectorAll('.video-delete-trigger').forEach(button => {
                    button.addEventListener('click', function () {
                        if (!deleteVideoForm || !deleteVideoName) return;
                        const videoId = this.dataset.videoId;
                        const videoName = this.dataset.videoIdentite || 'cette vidéo';
                        deleteVideoForm.action = '/videos-ucjg/' + videoId;
                        deleteVideoName.textContent = videoName;
                    });
                });

                document.querySelectorAll('.video-detail-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const card = this.closest('.member-card');
                        if (!card || !videoDetailModal) return;

                        const videoUrl = card.dataset.videoUrl || '';
                        const videoIdentite = card.dataset.videoIdentite || 'Vidéo UCJG';
                        const videoId = card.dataset.videoId || '—';
                        const userName = card.dataset.videoUserName || 'Utilisateur inconnu';
                        const userMember = card.dataset.videoUserMember || '—';
                        const createdAt = card.dataset.videoCreated || '—';

                        if (videoDetailTitle) videoDetailTitle.textContent = videoIdentite;
                        if (videoDetailIdentity) videoDetailIdentity.textContent = videoIdentite;
                        if (videoDetailId) videoDetailId.textContent = videoId;
                        if (videoDetailUserName) videoDetailUserName.textContent = userName;
                        if (videoDetailUserMember) videoDetailUserMember.textContent = userMember;
                        if (videoDetailDate) videoDetailDate.textContent = createdAt;
                        if (videoDetailPlayer) {
                            videoDetailPlayer.src = videoUrl;
                            videoDetailPlayer.load();
                        }

                        const modal = bootstrap.Modal.getOrCreateInstance(videoDetailModal);
                        modal.show();
                    });
                });

                document.querySelectorAll('.video-edit-trigger').forEach(button => {
                    button.addEventListener('click', function () {
                        const videoId = this.dataset.videoId;
                        const editModal = document.getElementById('editVideoModal');
                        if (!editModal || !videoId) return;

                        const card = document.querySelector('.member-card[data-video-id="' + videoId + '"]');
                        if (!card) return;

                        const identityInput = document.getElementById('editVideoIdentity');
                        const form = document.getElementById('editVideoForm');

                        if (identityInput) {
                            identityInput.value = card.dataset.videoIdentite || '';
                        }

                        if (form) {
                            form.action = '/videos-ucjg/' + videoId + '/modifier';
                        }

                        const modal = bootstrap.Modal.getOrCreateInstance(editModal);
                        modal.show();
                    });
                });
            });
        </script>
    </body>
</html>
