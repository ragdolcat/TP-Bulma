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

function AccountDeletion()
{


    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=tp-bulma;","root","");
    }
    catch(Exception $e)
    {
        die("Erreur : " . $e->getMessage());
    }

    $delete = $bdd->prepare("DELETE FROM user WHERE email = :email");
    $delete->execute(array("email" => $_SESSION['email']));

    session_destroy();

    echo '<script>window.alert("utilisateur suprimmé."); window.location.href="../";</script>';
    exit();
}

if(isset($_SESSION['email']))
{
    AccountDeletion();
}
else
{
    header("Location: ../inscription/");
    exit();
}

?>
</html>