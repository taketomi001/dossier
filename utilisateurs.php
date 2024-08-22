<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>interface_admin</title>
    <link rel="stylesheet" href="projet_fede.css">
</head>

<body>
    <nav>
        <menu name="menu">
            <li id="tdb"><a href="#">tableau de bord</a></li>
            <li id="utilisateurs"><a href="utilisateurs.php">utilisateurs</a></li>
            <li><button class="deconnecter" id="deconnecter" name="deconnecter"> se déconnecter</button></li>
        </menu>
    </nav>
    <h1>espace administrateur</h1>
    <?php
    require_once 'dbh.php';
    // require_once 'verif.php';


    $req = $dbh->query('SELECT id, type, email FROM sessions');
    if ($req->rowCount() >= 1) { ?>

        <table>
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Action</th>
                    <th></th>
                    <th>Supprimer</th>
                </tr>
            <?php
            foreach ($req->fetchAll() as $donnees) {
                echo '<form action="utilisateurs.php" method="POST">';
                echo '<tr>';
                echo '<td>' . $donnees['id'] . '</td>';
                echo '<td>' . $donnees['type'] . '</td>';
                echo '<td>' . $donnees['email'] . '</td>';
                echo '<td><button type="submit" id="modifier" name="modifier' . $donnees['id'] . '">modifier</button></td>';
                echo '<td>' . '/' . '</td>';
                echo '<td>';
                echo '<button type="submit" id="supprimer" name="supprimer' . $donnees['id'] . '">supprimer</button></td>';



                if ($_SERVER["REQUEST_METHOD"] === "POST") {

                    // var_dump($_POST['supprimer' . $donnees['id']]);
                    // var_dump($_POST);
                    if(isset($_POST['supprimer'.$donnees['id']])){ echo 'coucou';
                        $req = $dbh->prepare('DELETE FROM sessions WHERE (`id` = :id);');
                        $req->bindValue(':id',$donnees['id']);
                        $req->execute();
                        header('Location : utilisateurs.php');
                        }
                }
                // var_dump($_SERVER);

              
                echo '</tr>';
                echo '</tbody>';
            }

            // echo '<button type="submit" id="save">save</button>';
            echo '</form>';
            echo '</table>';
        }




            ?>







            <script src="java.js"></script>


</body>

</html>