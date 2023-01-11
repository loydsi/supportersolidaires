<?php
//session_start();
include_once ('../Controller/affiche.php');
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
            
            
        <form action="../Controller/affiche.php" method="POST" class="bordure">
                        <table class="participe">
                            <?php for($i=0; $i<count($affiche)-1; $i++) : ?>
                            <?php if ($affiche[$i]->DATE_M == $affiche[$i+1]->DATE_M){ ?>
                            
                            <tr>
                                
                                <td><?php $date = $affiche[$i]->DATE_M;?>
                                    <?php echo $date; ?>
                                </td>
                                <td>
                                    <?php $heure = $affiche[$i]->HEURE_M;?>
                                    <?php echo $heure; ?>
                                    
                                </td>
                                <td >
                                    <?php if ($affiche[$i]->DATE_M == $affiche[$i+1]->DATE_M){
                                    echo $affiche[$i]->NOM_E . " / " . $affiche[$i+1]->NOM_E;
                                    }?>
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    <?php $idM =$affiche[$i]->ID_M_Rencontre  ?>
                                    <input type="submit" name="submit[<?= $idM ?>]" value="Je participe">
                                </td>
                                <?php }?>
                            </tr>
                            
                            <?php endfor; ?>
                        </table>
                </form>
        </section>

        <footer>
            <p>2022 &copy; Supporters Solidaires - Tous Droits Réservés - <a href="mailto:t.akpweh@gmail.com" target="_self">Nous contacter</a></p>
        </footer>
        <script src="../js/burger.js"></script>
    </body>
</html>
