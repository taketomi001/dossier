<?php
session_start();


$_SESSION['utilisateur'] = [];
$_SESSION['password'] = '';
session_destroy();
// Je supprime le cookie
setcookie('sessions','',(time()-14400));
// Je redirige l'utilisateur
header('location:login.html');
exit; 

?>