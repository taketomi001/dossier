<?php
// Pour la connection à la base de donnée
$dsn = 'mysql:dbname=projet_fede;host=localhost';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);
?>