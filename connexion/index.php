<?php session_start();

if(isset($_SESSION['email']))
{
    header("Location: ../");
    exit();
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <title>Connexion</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/style.css">
</head>

<!-- Content -->
<body>
    <nav class="navbar has-background-primary" role="navigation" aria-label="main navigation">
        <div class="navbar-start">
            <a class="button is-primary" href="../">Accueil</a>
        </div>
        <?php
                if(isset($_SESSION['email']))
                {
                    echo "
                    <div class='navbar-end'>
                        <a class='button is-primary has-background-primary' href=''>".$_SESSION['email']."</a>
                        <a class='button is-primary' href='../redirect/deconnection.php'>Deconnection</a>
                    </div>";
                }
                else
                {
                    echo"
                    <div class='navbar-end'>
                        <a class='button is-primary' href='../inscription/'>Inscription</a>
                        <a class='button is-primary has-background-primary-35' href=''>Connexion</a>
                    </div>";
                }
        ?>


    </nav>
    <div class="app">
        <p class="title is-1">Connexion</p>

        <div class="form">
            <form action="../redirect/connexion.php" method="post">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" id="email" placeholder="e.x. exemple@gmail.com">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Mot de passe</label>
                    <div class="control">
                        <input class="input" type="Password" name="password" id="password" placeholder="e.x Po2'1dz*8y#">
                    </div>
                </div>

                <div class="field">
                    
                    <div class="control">
                        <input class="button is-primary-dark" type="reset" value="Reinitialiser">
                        <input class="button is-primary" type="submit" value="Envoyer">
                    </div>
                </div>
            </form>            
        </div>
    </div>
</body>
</html>