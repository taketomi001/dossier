<?php session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: login.html');
    exit; // Termine le script pour éviter d'afficher le contenu de la page protégée
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>interface_admin</title>
    <link rel="stylesheet" href="projet_fede.css">
</head>

<body>
    <h1>espace utilisateur</h1>
    <nav>
        <menu>
            <li><a href="créer_un_compte.html">acceuil</a></li>
            <li>acceuil</li>
            <li><button class="deconnecter" id="deconnecter" name="deconnecter"> se déconnecter</button></li>
        </menu>
    </nav>
    <script src="java.js"></script>


</body>

</html>