document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const skeleton = document.getElementById("skeleton");
        const content = document.getElementById("content");

        if (skeleton) {
            skeleton.style.display = "none"; // Cache complètement le squelette
        }
        if (content) {
            content.classList.remove("hidden"); // Affiche le contenu principal
        }
    }, 2000); // 2 secondes
});
