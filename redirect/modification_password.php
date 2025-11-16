<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <title>Redirection</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/style.css">
</head>
<?php

session_start();

function ModificationPassword($old, $new){
    if ($old == $new) {
        echo '<script>alert("Le nouveau mot de passe doit être différent de l\'ancien !"); window.location.href="../settings/";</script>';
        exit();
    }

    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=tp-bulma;","root","");
    }
    catch(Exception $e)
    {
        die("Erreur : " . $e->getMessage());
    }

    $check = $bdd->prepare("SELECT * FROM user WHERE email = :email");
    $check->execute(array("email" => $_SESSION['email'],));

    $user = $check->fetch();

    if(password_verify($old, $user['password']))
    {
        $hashed = password_hash($new, PASSWORD_DEFAULT);

        $req = $bdd->prepare("UPDATE user SET password = :password WHERE email = :email");
        $req->execute(array("password" => $hashed, "email" => $_SESSION['email']));

        echo '<script>alert("Mot de passe modifié avec succès !"); window.location.href="../";</script>';
        exit();
    }
    else
    {
        echo '<script>alert("Ancien mot de passe incorrect !"); window.location.href="../settings/";</script>';
        exit();
    }
}

if(isset($_POST['old']) && isset($_POST['new']))
{
    ModificationPassword($_POST['old'],$_POST['new']);
}
else
{
    header("Location: ../settings/");
    exit();
}


?>
</html>