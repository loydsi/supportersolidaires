<?php
include_once('../Controller/affiche.php');
//include_once('../Controller/election.php');
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
            <h2> Votez pour le joueur et le gardien de 
                <?php $idM = $_SESSION['idM'];

                for($i=0; $i<count($affiche); $i++) {
                    if ($affiche[$i]->ID_M == $idM){
                        echo $affiche[$i]->NOM_E . "  ";
                    }
                } ?>

                <input type="button" value="Retour" onclick="history.go(-1)">
            </h2>

            <div class="global">
                <div class="groupe">
                    <h2>Liste des joueurs</h2>
                        <form action="../Controller/affiche.php" method="POST" id="form">
                        <?php 
                        $idJ = $_SESSION['idJ'];
                        for ($i=0; $i<count($idJ); $i++) { ?>
                        
                        
                            <li> 
                                <?php $idJoueur =  $idJ[$i]->ID_J ?>
                                <?php $_SESSION['idJoueur']= $idJoueur ?>
                                
                                <input type="radio" id="joueur1" name="joueur"/>
                                
                                <label for="joueur" value="<?= $idJoueur ?>">
                                    <?php $nom = $idJ[$i]->NOM_J; $prenom = $idJ[$i]->PRENOM_J;
                                    echo $nom . " " .$prenom ;?>
                                </label>
                            </li>
                        <?php }?>
                </div>

                <div class="groupe">
                        <h2>Liste des gardiens</h2>
                    
                        <?php 
                        $idG = $_SESSION['idG'];
                        for ($i=0; $i<count($idG); $i++) { ?>
                            <li>
                                <?php $idGardien =  $idG[$i]->ID_J ?>
                                <?php $_SESSION['idGardien']= $idGardien ?>
                                <input type="radio" id="gardien1" name="gardien"/>
                                
                                <label for="gardien">
                                    <?php $nom = $idG[$i]->NOM_J; $prenom = $idG[$i]->PRENOM_J;
                                    echo $nom . " " .$prenom ;?>
                                </label>
                            </li>
                        <?php }?>
                        
                                <input type="submit" name="vote" value="Voter" onclick="checkPassVote()"/>
                        
                        </form>
                </div>
            </div>


        </section>

        <footer>
            <p>2022 &copy; Supporters Solidaires - Tous Droits Réservés - <a href="mailto:t.akpweh@gmail.com" target="_self">Nous contacter</a></p>
        </footer>

        <script src="../js/script.js"></script>
        <script src="../js/burger.js"></script>
    </body>
</html>