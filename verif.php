<?php
require_once 'dbh.php';

function verifConnect()
{
    // Je passe $dbh en global pour pouvoir faire des requêtes
    global $dbh;
    $sql = 'SELECT * FROM sessions WHERE 1';
    // Je vérifie si j'ai une session
    if (!empty($_SESSION['sessions'])) {
        // Je rajoute la condition sur l'ID
        $sql .= ' AND id = ' . intval($_SESSION['sessions']);
    } else if (!empty($_COOKIE['utilisateur'])) {
        // Je déserialize mon cookie
        $info_cookie = unserialize($_COOKIE['sessions']);
        $sql .= ' AND mail = "' . $info_cookie['email'] . '" AND PASSWORD = "' . $info_cookie['hash'] . '"';
    }
    // J'execute ma requête avec query
    $req = $dbh->query($sql);
    // Je vérifie que j'ai bien un utilisateur
    if ($req->rowCount() == 1) {
        // Je met dans un tableau les infos de l'utilisateur avec fetch
        $info = $req->fetch();
        // Je vais relancer une session et un cookie
        $_SESSION['sessions'] = $info['id'];
        $cookie = [
            'email' => $info['email'],
            'hash' => $info['PASSWORD']
        ];
        setcookie('sessions', serialize($cookie), (time() + 14400));
        // Je retourne les infos sur l'utilisateur
        return $info;
    } else {
        // Je retourne faux
        return false;
    }
};

function verifAdmin()
{
    $utilisateur = verifConnect();
    // Je vérifie si l'utilisateur est connecté et si il est admin
    if($utilisateur && $utilisateur['Statut'] == 'admin'){
        return $utilisateur;
    }
    else
    {
        return false;
    }
}
