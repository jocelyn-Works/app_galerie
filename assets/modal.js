// Fonction pour afficher le modal après un délai de 5 secondes
function showModalWithDelay() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    document.body.classList.add("modal-open");
}

// Fonction pour fermer le modal
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    document.body.classList.remove("modal-open");
}

// Afficher le modal après 5 secondes
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(showModalWithDelay, 6000);
});

// Fermer le modal en cliquant n'importe où sur la page
window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        closeModal();
    }
};

// Fermer le modal si l'utilisateur clique sur le bouton de fermeture
var closeBtn = document.getElementById("closeBtn");
closeBtn.onclick = closeModal;