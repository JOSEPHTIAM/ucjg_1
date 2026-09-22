/**
 * Script JS principal - UCJG Sodiko-Ville
 */

document.addEventListener('DOMContentLoaded', function () {

    // 1. Défilement fluide (Smooth Scroll) pour les liens d'ancrage
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId !== '#' && targetId !== '') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // 2. Ombre dynamique sur la barre de navigation au défilement
    const navbar = document.querySelector('.navbar-custom');
    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 30) {
                navbar.style.boxShadow = '0 6px 20px rgba(0, 0, 0, 0.15)';
                navbar.style.padding = '8px 0';
            } else {
                navbar.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.08)';
                navbar.style.padding = '12px 0';
            }
        });
    }

    // 3. Fermeture automatique du menu mobile après un clic sur un lien
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });
    });

    console.log('Application UCJG Sodiko-Ville chargée avec succès !');
});

document.addEventListener('DOMContentLoaded', function () {
    const backToTopBtn = document.getElementById('backToTop');

    if (backToTopBtn) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 200) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });

        backToTopBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    const filterButtons = document.querySelectorAll('.btn-filter');
    const memberCards = document.querySelectorAll('.member-card');
    const memberSearch = document.getElementById('memberSearch');
    const memberEmptyState = document.getElementById('memberEmptyState');

    if (filterButtons.length && memberCards.length) {
        let selectedFilter = 'all';

        const applyFilters = () => {
            const searchTerm = (memberSearch ? memberSearch.value.trim().toLowerCase() : '');
            let visibleCount = 0;

            memberCards.forEach(card => {
                const category = card.dataset.category || 'all';
                const searchable = (card.dataset.search || '').toLowerCase();
                const matchesCategory = selectedFilter === 'all' || category === selectedFilter;
                const matchesSearch = !searchTerm || searchable.includes(searchTerm);
                const isVisible = matchesCategory && matchesSearch;

                card.style.display = isVisible ? 'flex' : 'none';

                if (isVisible) {
                    visibleCount++;
                }
            });

            if (memberEmptyState) {
                memberEmptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        };

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
                selectedFilter = this.dataset.filter || 'all';
                applyFilters();
            });
        });

        if (memberSearch) {
            memberSearch.addEventListener('input', applyFilters);
        }

        applyFilters();
    }

    const detailModal = document.getElementById('memberDetailModal');
    const detailMemberPhoto = document.getElementById('detailMemberPhoto');
    const detailMemberName = document.getElementById('detailMemberName');
    const detailMemberBadge = document.getElementById('detailMemberBadge');
    const detailRole = document.getElementById('detailRole');
    const detailNom = document.getElementById('detailNom');
    const detailPrenom = document.getElementById('detailPrenom');
    const detailVoix = document.getElementById('detailVoix');
    const detailGenre = document.getElementById('detailGenre');
    const detailPays = document.getElementById('detailPays');
    const detailContact = document.getElementById('detailContact');
    const detailProfession = document.getElementById('detailProfession');
    const detailEmail = document.getElementById('detailEmail');
    const detailAnnee = document.getElementById('detailAnnee');
    const detailReleve = document.getElementById('detailReleve');
    const detailAnecdote = document.getElementById('detailAnecdote');
    const detailSouhait = document.getElementById('detailSouhait');

    const applyMemberModalTheme = (modal, memberCategory) => {
        if (!modal) return;
        modal.classList.remove('member-modal--nouveau', 'member-modal--ancien', 'member-modal--partenaire', 'member-modal--default');
        const normalized = (memberCategory || 'Nouveau').toString().trim().toLowerCase();
        if (normalized === 'nouveau') modal.classList.add('member-modal--nouveau');
        else if (normalized === 'ancien') modal.classList.add('member-modal--ancien');
        else if (normalized === 'partenaire') modal.classList.add('member-modal--partenaire');
        else modal.classList.add('member-modal--default');
    };

    document.querySelectorAll('.member-detail-btn').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.member-card');
            if (!card || !detailModal) return;

            const member = {
                photo: card.dataset.userPhoto || '',
                fullName: `${card.dataset.userPrenom || ''} ${card.dataset.userName || ''}`.trim(),
                nom: card.dataset.userName || '',
                prenom: card.dataset.userPrenom || '',
                membre: card.dataset.userMembre || 'Nouveau',
                role: card.dataset.userRole || '',
                voix: card.dataset.userVoix || '',
                genre: card.dataset.userGenre || '',
                pays: card.dataset.userPays || '',
                contact: card.dataset.userContact || '',
                profession: card.dataset.userProfession || '',
                email: card.dataset.userEmail || '',
                annee: card.dataset.userAnnee || '',
                anecdote: card.dataset.userAnecdote || 'Aucune',
                releve: card.dataset.userReleve || '',
                souhait: card.dataset.userSouhait || '',
            };

            applyMemberModalTheme(detailModal, member.membre);

            if (detailMemberPhoto) detailMemberPhoto.src = member.photo;
            if (detailMemberName) detailMemberName.textContent = member.fullName || member.nom;
            if (detailMemberBadge) {
                detailMemberBadge.textContent = member.membre;
                detailMemberBadge.className = 'badge rounded-pill mt-2';
                if (member.membre === 'Nouveau') detailMemberBadge.classList.add('bg-primary');
                if (member.membre === 'Ancien') detailMemberBadge.classList.add('bg-warning', 'text-dark');
                if (member.membre === 'Partenaire') detailMemberBadge.classList.add('bg-danger');
            }

            if (detailRole) detailRole.textContent = member.role || '—';
            if (detailNom) detailNom.textContent = member.nom || '—';
            if (detailPrenom) detailPrenom.textContent = member.prenom || '—';
            if (detailVoix) detailVoix.textContent = member.voix || '—';
            if (detailGenre) detailGenre.textContent = member.genre || '—';
            if (detailPays) detailPays.textContent = member.pays || '—';
            if (detailContact) detailContact.textContent = member.contact || '—';
            if (detailProfession) detailProfession.textContent = member.profession || '—';
            if (detailEmail) detailEmail.textContent = member.email || '—';
            if (detailAnnee) detailAnnee.textContent = member.annee || '—';
            if (detailReleve) detailReleve.textContent = member.releve || '—';
            if (detailAnecdote) detailAnecdote.textContent = member.anecdote || 'Aucune';
            if (detailSouhait) detailSouhait.textContent = member.souhait || '—';

            const modal = bootstrap.Modal.getOrCreateInstance(detailModal);
            modal.show();
        });
    });

    const deleteUserForm = document.getElementById('deleteUserForm');
    const deleteUserName = document.getElementById('deleteUserName');

    document.querySelectorAll('.member-delete-trigger').forEach(button => {
        button.addEventListener('click', function () {
            if (!deleteUserForm || !deleteUserName) return;
            const userId = this.dataset.userId;
            const userName = this.dataset.userName || 'ce membre';
            deleteUserForm.action = '/membres-ucjg/' + userId;
            deleteUserName.textContent = userName;
        });
    });

    document.querySelectorAll('.member-edit-trigger').forEach(button => {
        button.addEventListener('click', function () {
            const editModal = document.getElementById('editProfileModal');
            if (!editModal) return;

            const form = editModal.querySelector('form');
            const userId = this.dataset.userId || '';
            if (form && userId) {
                form.action = '/membres-ucjg/' + userId + '/modifier';
            }

            const fields = {
                role: this.dataset.userRole || 'Utilisateur',
                nom: this.dataset.userName || '',
                prenom: this.dataset.userPrenom || '',
                membre: this.dataset.userMembre || 'Nouveau',
                voix: this.dataset.userVoix || 'Sopra',
                genre: this.dataset.userGenre || 'Homme',
                indicatif_pays: this.dataset.userPays || '',
                contact: this.dataset.userContact || '',
                profession: this.dataset.userProfession || '',
                email: this.dataset.userEmail || '',
                premiere_annee_ucjg: this.dataset.userAnnee || '',
                anecdote: this.dataset.userAnecdote || 'Aucune',
                releve_assuree: this.dataset.userReleve || 'Oui',
                souhait_30_ans: this.dataset.userSouhait || ''
            };

            if (form) {
                Object.entries(fields).forEach(([name, value]) => {
                    const input = form.querySelector(`[name="${name}"]`);
                    if (input) {
                        if (input.tagName === 'TEXTAREA') {
                            input.value = value || '';
                        } else if (input.tagName === 'SELECT') {
                            input.value = value || input.options[0]?.value || '';
                        } else {
                            input.value = value || '';
                        }
                    }
                });
            }

            applyMemberModalTheme(editModal, fields.membre || editModal.dataset.memberCategory || 'Nouveau');
            const modal = bootstrap.Modal.getOrCreateInstance(editModal);
            modal.show();
        });
    });
});

