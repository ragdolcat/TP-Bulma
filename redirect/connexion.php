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

function connexion($email, $password){

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Email ou mot de passe invalide !"); window.location.href="../connexion/";</script>';
        exit();
    }

    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=bulma;","root","root");
    }
    catch(Exception $e)
    {
        die("Erreur : " . $e->getMessage());
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $check = $bdd->prepare("SELECT * FROM user WHERE email = :email");
    $check->execute(array("email" => $email,));

    $user = $check->fetch();

    if($user['email'] == $email && password_verify($password, $user['password']))
    {
        $_SESSION['email'] = $email;

        header("Location: ../");
    }
    else
    {
        echo '<script>window.alert("email ou mot de passe invalide !" window.location.href="../connexion/";);</script>';
        exit(); 
    }
    


}

connexion($_POST['email'],$_POST['password']);

?>
</html>