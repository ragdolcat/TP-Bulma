<?php session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../inscription/");
    exit();
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <title>Mon Compte</title>
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
                        <a class='button is-primary has-background-primary has-background-primary-35' href=''>".$_SESSION['email']."</a>
                        <a class='button is-primary' href='../redirect/deconnection.php'>Deconnection</a>
                    </div>";
                }
                else
                {
                    echo"
                    <div class='navbar-end'>
                        <a class='button is-primary' href='../inscription/'>Inscription</a>
                        <a class='button is-primary' href=''>Connexion</a>
                    </div>";
                }
        ?>


    </nav>
    <div class="app">
        <p class="title is-1"><?php echo $_SESSION['email']?></p>

        <p class="subtitle">Page de modification du compte</p>
        
        <div class="has-background-dark box">
            <div class="form">
                <form action="../redirect/modification_password.php" method="post">
                    <div class="field">
                        <label class="label">Ancien mot de passe</label>
                        <div class="control">
                            <input class="input" type="Password" name="old" id="old" placeholder="e.x. Po2'1dz*8y#">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nouveau mot de passe</label>
                        <div class="control">
                            <input class="input" type="Password" name="new" id="new" placeholder="e.x lE2-$8eW0d*d_y%">
                        </div>
                    </div>

                    <div class="field">
                        
                        <div class="control">
                            <input class="button is-primary-dark" type="reset" value="Reinitialiser">
                            <input class="button is-primary" type="submit" value="Envoyer">
                        </div>
                    </div>
                </form>       
                
                <button class="button is-danger" onclick="window.location.href='../redirect/deletion_account.php'">Supprimer mon compte</button>
            </div>
        </div>       
    </div>
</body>
</html>