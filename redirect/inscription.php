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



function Inscription($email, $password, $confirm){

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $password != $confirm) {
        echo '<script>alert("Email ou mot de passe invalide !"); window.location.href="../inscription/";</script>';
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

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $check = $bdd->prepare("SELECT email FROM user WHERE email = :email");
    $check->execute(array("email" => $email));

    if($check->fetch())
    {
        echo '<script>window.alert("Cette Utilisateur existe déjà !"); window.location.href="../connexion/";</script>';
        exit();
    }
    
    $req = $bdd->prepare("INSERT INTO user (email,password) VALUES (:email,:password)");
    $req->execute(array("email" => $email, "password" => $hashed));

    $_SESSION['email'] = $email;

    $req->closeCursor();
    
    header("Location: ../");
}
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm']))
{
    Inscription($_POST['email'],$_POST['password'],$_POST['confirm']);
}
else
{
    header("Location: ../inscription/");
    exit();
}

?>
</html>