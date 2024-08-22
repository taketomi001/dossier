<?php
function verifConnect()
{
    // Je passe $dbh en global pour pouvoir faire des requêtes
    global $dbh;
    $sql = 'SELECT * FROM sessions WHERE 1';
    // Je vérifie si j'ai une session
    if(!empty($_SESSION['sessions']))
    {
        // Je rajoute la condition sur l'ID
        $sql.= ' AND ID = '.intval($_SESSION['sessions']);
    }
    else if(!empty($_COOKIE['sessions']))
    {
        // Je déserialize mon cookie
        $info_cookie = unserialize($_COOKIE['sessions']);
        $sql.= ' AND email = "'.$info_cookie['email'].'" AND PASSWORD = "'.$info_cookie['hash'].'"';
    }
    // J'execute ma requête avec query
    $req = $dbh->query($sql);
    // Je vérifie que j'ai bien un utilisateur
    if($req->rowCount() == 1){
        // Je met dans un tableau les infos de l'utilisateur avec fetch
        $info = $req->fetch();
        // Je vais relancer une session et un cookie
        $_SESSION['sessions'] = $info['id'];
        $cookie = [
            'email' => $info['email'],
            'hash' => $info['PASSWORD']
        ];
        setcookie('utilisateur',serialize($cookie),(time()+86400));
        // Je retourne les infos sur l'utilisateur
        return $info;
    }else{
        // Je retourne faux
        return false;
    }
}
?>