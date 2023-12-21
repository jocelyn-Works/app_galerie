
(function () {
    const userIcon = document.getElementById('userIcon');
    const userMenu = document.querySelector('.user-menu');
    const VISIBLE = 'visible';
    const HIDDEN = 'hidden';

    // Fonction pour basculer la visibilité
    function toggleVisibility() {
        userMenu.style.visibility = (userMenu.style.visibility === VISIBLE) ? HIDDEN : VISIBLE;
    }

    // Afficher ou masquer userMenu au clic sur userIcon
    userIcon.addEventListener('click', toggleVisibility);

    // Masquer userMenu au clic en dehors
    document.addEventListener('click', (event) => {
        const isClickedInsideUserMenu = userMenu.contains(event.target);
        const isClickedOnUserIcon = event.target === userIcon;

        if (!isClickedInsideUserMenu && !isClickedOnUserIcon) {
            userMenu.style.visibility = HIDDEN;
        }
    });
})();