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

function Deconnection(){
    session_destroy();

    header("Location: ../");
    exit();
}

Deconnection();

?>
</html>