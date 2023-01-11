<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr-FR">

    <head>
        <meta charset="UTF-8">
        <title>Supporters Solidaires</title>
        <link rel="stylesheet" href="../css/style.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    </head>
        
    <body>
        <header>
            <h1>Supporters Solidaires</h1>
            
            <nav>
                <div class="icons">
                    <i class="fa-solid fa-burger"></i>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <ul>
                    <li><a href="home.php">Accueil</a></li>
                    <?php if (isset($_SESSION['mail']) && $_SESSION['mail'] == "loyd@mail.fr"){?>
                    <li><a href="participe.php">Listes participants</a></li>
                    <li><a href="resultatVote.php">Résultats vote</a></li>
                    <li><a href="admin.php">Mon compte</a></li>
                    <li><a href="../Controller/deconnexion.php">Deconnexion</a></li>
                    

                    <?php }elseif (isset($_SESSION['mail'])){?>
                    
                    <li><a href="concours.php">Concours</a></li>
                    <li><a href="elections.php">Élections</a></li>
                    <li><a href="monCompte.php">Mon compte</a></li>
                    <li><a href="../Controller/deconnexion.php">Deconnexion</a></li>

                    <?php }else {?>

                    <li><a href="jeu.php">Jeu</a></li>
                    <li><a href="vote.php">Vote</a></li>
                    <li><a href="identification.php">S'identifier</a></li>
                    <?php }?>

                
                </ul>
            </nav>
        </header>

        <section>
            <fieldset>
                <legend>INSCRIPTION</legend>
                    <form action="../Controller/controller.php" method="POST" id="myForm">
                        <p>
                            <label for="nom">Votre nom :</label>
                            <input type="text" id="nom" name="nom" size="30" placeholder="Écrivez ici" required>
                            <span id="errorName"></span>
                        </p>
    
                        <p>
                            <label for="prenom">Votre prénom :</label>
                            <input type="text" id="prenom" name="prenom" size="30" required autofocus>
                            <span id="errorPrenom"></span>
                        </p>

                        <p>
                            <label for="email">Votre email :</label>
                            <input type="email" id="mail" name="mail" required>
                            <span id="errorMail"></span>
                        </p>
    
                        <p>
                            <label for="password">Votre mot de passe :</label>
                            <input type="password" id="password" name="password" size="30">
                            <span id="errorPassword"></span>
                        </p>

                        <p>
                            <label for="confmdp">Confirmation mot de passe :</label>
                            <input type="password" id="password2" name="password2" size="30" onkeyup="checkPass(); return false">
                            <span id="errorPassword2"></span>
                        </p>
                        <input type="hidden" name="role" value="3">
    
                        <p>
                            <input type="submit" name="submit" value="S'inscrire">
                            <input type="reset" value="Effacer">
                        </p>
    
                    </form>
            </fieldset>

            <fieldset>
                <legend>CONNEXION</legend>
                    <form action="../Controller/controller.php" method="POST" id="Form">
                        <p>
                            <label for="email">Votre email :</label>
                            <input type="email" id="mail2" name="mail" required>
                            <span id="errorMail2"></span>
                        </p>
    
                        <p>
                            <label for="mdp">Votre mot de passe :</label>
                            <input type="password" id="password3" name="password" size="30">
                            <span id="errorPassword3"></span>
                        </p>
    
                        <p>
                            <input type="submit" name="submit2" value="Se connecter">
                        </p>
    
                    </form>
            </fieldset>

        </section>

        <footer>
            <p>2022 &copy; Supporters Solidaires - Tous Droits Réservés - <a href="mailto:t.akpweh@gmail.com" target="_self">Nous contacter</a></p>
        </footer>

        <script src="../js/script.js"></script>
        <script src="../js/burger.js"></script>
    </body>
</html>
