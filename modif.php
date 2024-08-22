<?php
require_once 'dbh.php';
require_once 'fonction.php';

$utilisateur = verifConnect();
if($utilisateur)
        {
            // Je vérifie si j'ai un paramètre GET['id']
            if(!empty($_GET['id']))
            {echo 'coucou';
                // Je recupère les informations sur le fichier
                $verif = $dbh->query('SELECT * FROM sessions WHERE id = '.intval($_GET['id']));
                // Je vais vérifier si le fichier existe
                if($verif->rowCount() == 1)
                {
                    $infos = $verif->fetch();
                    // Je vérifie si le fichier appartient à l'utilisateur
                    if($infos['id'] == $utilisateur['id'])
                    {
                        // Pour supprimer un fichier sur le serveur avec unlink
                        // unlink('fichiers/'.$utilisateur['ID'].'/'.$infos['Nom_Fichier']);
                        // Pour supprimer la ligne du fichier dans la base de donnée
                        $del = $dbh->query('DELETE FROM sessions WHERE id = '.intval($infos['id']));
                        if($del){
                            echo 'Fichier supprimé';
                        }
                        else
                        {
                            echo 'Impossible de supprimer le fichier';
                        }
                    }
                    else
                    {
                        echo 'Le fichier ne vous appartient pas !!';
                    }

                }
            }
        }

