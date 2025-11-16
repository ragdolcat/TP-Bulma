<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <title>utilisateur</title>
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
                        <a class='button is-primary' href=''>Connexion</a>
                    </div>";
                }
        ?>


    </nav>
    <div class="app">
        <p class="title is-1"><?php echo $_GET['email']?></p>
        
        <?php
        try
        {
            $bdd = new PDO("mysql:host=localhost;dbname=tp-bulma;","root","");
        }
        catch(Exception $e)
        {
            die("Erreur : " . $e->getMessage());
        }

        $getuser = $bdd->prepare("SELECT ID FROM user WHERE email = :email");
        $getuser->execute(array("email" => $_GET['email']));
        $user = $getuser->fetch();

        if(!$user)
        {
            echo '<script>alert("Utilisateur non trouvé !"); window.location.href="../";</script>';
            exit();
        }
        else if($_GET['email'] == $_SESSION['email'])
        {
            echo '
            <div class="has-background-dark box">
                <form action="../redirect/ajouter_post.php" method="post">
                    <div class="field">
                        <label class="label">Nouveau post</label>
                        <div class="control">
                            <textarea class="textarea" name="content" id="content" placeholder="Écrivez votre publication ici..."></textarea>
                        </div>
                    </div>
                    <div class="control">
                        <input class="button is-primary-dark" type="reset" value="Reinitialiser">
                        <input class="button is-primary" type="submit" value="Publier">
                    </div>
                </form>
            </div>';
        }

        ?>
        <div>
            <p class="title is-3">Liste des publication</p>
            <div class="posts">
                <?php
                try
                {
                    $bdd = new PDO("mysql:host=localhost;dbname=tp-bulma;","root","");
                }
                catch(Exception $e)
                {
                    die("Erreur : " . $e->getMessage());
                }

                $getuser = $bdd->prepare("SELECT ID FROM user WHERE email = :email");
                $getuser->execute(array("email" => $_GET['email']));
                $user = $getuser->fetch();

                $req = $bdd->prepare("SELECT content, DATE FROM post WHERE userID = :ID ORDER BY DATE DESC");
                $req->execute(array("ID" => $user['ID']));
                $donnees = $req->fetch();

                if(!$donnees)
                {
                    echo "<p class='subtitle is-6'>Aucune publication trouvée.</p>";
                }

                while ($donnees)
                {
                    echo "<div class='has-background-dark box'>
                            <p class='subtitle is-6'>Publié le ".$donnees['DATE']."</p>
                            <p>".$donnees['content']."</p>
                          </div>";

                    $donnees = $req->fetch();
                }

                $req->closeCursor();
                ?>
            </div>
        </div>
    </div>
</body>
</html>