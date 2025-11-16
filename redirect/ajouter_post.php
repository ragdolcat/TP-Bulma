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

function ajouterPost($content, $userID)
{   
    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=tp-bulma;","root","");
    }
    catch(Exception $e)
    {
        die("Erreur : " . $e->getMessage());
    }

    $insert = $bdd->prepare("INSERT INTO post(content, userID, DATE) VALUES(:content, :userID, NOW())");
    $insert->execute(array(
        "content" => $content,
        "userID" => $userID,
    ));

    echo '<script>window.alert("Post ajouté avec succès."); window.location.href="../user/user.php?email='.$_SESSION['email'].'";</script>';
    exit();

}

if(isset($_POST['content']) && isset($_SESSION['email']))
{
    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=tp-bulma;","root","");
    }
    catch(Exception $e)
    {
        die("Erreur : " . $e->getMessage());
    }

    $getuser = $bdd->prepare("SELECT ID FROM user WHERE email = :email");
    $getuser->execute(array("email" => $_SESSION['email']));
    $user = $getuser->fetch();

    ajouterPost($_POST['content'], $user['ID']);
}
else
{
    if(!isset($_POST['content']))
    {
        echo '<script>alert("Le contenu du post ne peut pas être vide !"); window.location.href="../user/user.php?email='.$_SESSION['email'].'";</script>';
        exit();
    }
    else
    {
        header("Location: ../inscription/");
        exit();
    }
}


?>
</html>