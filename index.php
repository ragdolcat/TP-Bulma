<?php session_start();?>
<head>
    <!-- Meta -->
    <title>Accueil</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" href="./style/style.css">
</head>

<!-- Content -->
<body>
    <nav class="navbar has-background-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-start">
        <a class="button is-primary has-background-primary-35">Accueil</a>
    </div>

    <?php
            if(isset($_SESSION['email']))
            {
                echo "
                <div class='navbar-end'>
                    <a class='button is-primary has-background-primary' href='./settings/'>".$_SESSION['email']."</a>
                    <a class='button is-primary' href='./redirect/deconnection.php'>Deconnection</a>
                </div>";
            }
            else
            {
                echo"
                <div class='navbar-end'>
                    <a class='button is-primary has-background-primary' href='./inscription/'>Inscription</a>
                    <a class='button is-primary' href='./connexion/'>Connexion</a>
                </div>";
            }
        ?>
    </nav>
    <div class="app">
        <p class="title is-1">Bienvenue !</p>
        <div class="userList">
            <?php 
            try
            {
                $bdd = new PDO("mysql:host=localhost;dbname=tp-bulma;","root","");
            }
            catch(Exception $e)
            {
                die("Erreur : " . $e->getMessage());
            }

            $req = $bdd->prepare("SELECT email FROM user");
            $req->execute();

            if(isset($_SESSION['email']))
            {
                while ($donnees = $req->fetch())
                {
                    echo "<a href='./user/".$donnees['email']."' class='subtitle'>".$donnees['email']."</a> </br>";
                }
            }
            else
            {
                while ($donnees = $req->fetch())
                {
                    echo "<a class='subtitle'>".$donnees['email']."</a> </br>";
                }
            }
            
            $req->closeCursor();

            ?>
        </div>
    </div>

</body>
</html>