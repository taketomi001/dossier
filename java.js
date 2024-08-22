let button = document.getElementById("deconnecter");
// Sélectionner tous les liens dans la liste
const liens = document.querySelectorAll("li a");
const liste = document.querySelector("menu");
let tdb = document.getElementById("tdb");
let utilisateurs = document.getElementById("utilisateurs");
let message = document.getElementById('message');

// Parcourir chaque lien et enlever la text-decoration
liens.forEach((lien) => {
  lien.style.textDecoration = "none"; // ou lien.style.textDecoration = '';
  liste.style.listStyleType = "none"; // ou lien.style.textDecoration = '';
});
button.addEventListener("click", () => {
  fetch("deconnection.php", {
    method: "GET", // ou 'POST' selon votre besoin
    credentials: "include", // Inclure les cookies de session si nécessaire
  })
    .then((response) => {
      if (response.redirected) {
        // Si le serveur redirige, vous pouvez gérer la redirection ici
        window.location.href = response.url; // Redirige vers la nouvelle URL
      } else {
        // Gérer d'autres réponses si nécessaire
        console.log("Déconnexion réussie");
      }
    })
    .catch((error) => {
      console.error("Erreur lors de la déconnexion:", error);
    });
});

