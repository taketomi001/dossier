<?php
require_once 'dbh.php';

if (isset($_POST['submit1'])) { 
    // Vérifie si le formulaire a été soumis

    // Vérifie si les champs ne sont pas vides
    if (!empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2'])) { 
        // Les champs ne sont pas vides

        // Vérifie si les mots de passe correspondent
        if ($_POST['password1'] === $_POST['password2']) { 
            // Ici, vous pouvez procéder à l'inscription de l'utilisateur
            $email = strip_tags($_POST['email']);
            $verif = $dbh->prepare('SELECT id FROM sessions WHERE email = :email');
            $verif->bindValue(':email', $email, PDO::PARAM_STR);
            $verif->execute();

            // Si il y a 1 résultat ou plus
            if ($verif->rowCount() >= 1) { 
                echo 'Compte déjà existant.';
            } else { 
                $motdepasse = password_hash($_POST['password1'], PASSWORD_DEFAULT);

                // Je prépare ma requête SQL en utilisant des paramètres nommés
                $req = $dbh->prepare('INSERT INTO sessions (email, PASSWORD) VALUES (:email, :PASSWORD)');
                
                // Je remplace mes paramètres nommés par les données utilisateurs
                $req->bindValue(':email', $email, PDO::PARAM_STR);
                $req->bindValue(':PASSWORD', $motdepasse, PDO::PARAM_STR);

                if ($req->execute()) { 
                    header('Location: login.html');
                    // exit(); // Ajout d'un exit après redirection
                } else { 
                    echo 'Erreur de redirection.';
                }
            }
        } else { 
            echo 'Les mots de passe ne correspondent pas.';
        }
    } else { 
        // Au moins un champ est vide
        echo 'Veuillez remplir tous les champs.';
    }
}

if(isset($_POST['connecter'])){header('Location: login.html');}
?>
