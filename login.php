<?php
session_start();
require_once 'dbh.php';

if (isset($_POST['submit2'])) {
    $global = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $req = $dbh->prepare('SELECT * FROM sessions WHERE email = :email');
        $req->bindValue(':email', strip_tags($_POST['email']), PDO::PARAM_STR);
        if ($req->execute()) {
            if ($req->rowCount() == 1) {
                $utilisateur = $req->fetch();


                if (password_verify($_POST['password'], $utilisateur['PASSWORD'])) {
                    $_SESSION['utilisateur'] = $utilisateur['id'];
                    $valeur_cookie = [
                        'email' => $utilisateur['email'],
                        'hash' => $utilisateur['PASSWORD']
                    ];
                    setcookie('sessions', strip_tags(serialize($valeur_cookie)), (time() + 14400));
                    if ($utilisateur['type'] == 'admin') {
                        header('location: interface_admin.php');
                    } else {
                        header('location: interface_users.php');
                        exit();
                    }
                } else {
                    echo 'Mot de passe incorrect';
                }
            } else {
                echo 'Utilisateur introuvable';
            }
        }
    }
}
