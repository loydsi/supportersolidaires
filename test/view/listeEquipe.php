<?php
//session_start();
include_once('../Controller/listeEquipe.php');
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
            <form action="../Controller/listeEquipe.php" method="POST">
            <table class="participe">                                
                <?php for($i=0; $i<count($listeE); $i++) { ?>
                <tr>
                    <td><?php 
                            $nomE = $listeE[$i]->NOM_E;
                            echo $nomE . "<br>";
                        ?>
                    </td>
                    <td><?php $idE = $listeE[$i]->ID_E?>
                        <input type="submit" name="effacer[<?php echo $idE ?>]" value="Effacer">
                        <input type="submit" name="modifier[<?php echo $idE ?>]" value="Modifier">
                    </td>
                </tr>
                <?php } ?>
            </table>
            </form>
        </section>
        
        <footer>
            <p>2022 &copy; Supporters Solidaires - Tous Droits Réservés - <a href="mailto:t.akpweh@gmail.com" target="_self">Nous contacter</a></p>
        </footer>
        <script src="../js/burger.js"></script>
    </body>
</html>