<?php
//session_start();
include_once('../Controller/adminController.php');
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
            <form action="../Controller/equipe.php" method="POST">
                <label for="equipe">Ajouter une équipe</label>
                <input type="text" name="equipes" placeholder="Écrire le nom de l'équipe">
                <input type="submit" name="submit" value="Valider">
            </form>

            <form action="../Controller/adminController.php" method="POST">
                <label for="joueurs">Ajouter les joueurs</label>
                <select id="equipe" name="equipe" placeholder="Équipe">
                <?php foreach ($test as $donnees): ?>
                    <option value="<?= $donnees->ID_E?>"><?php echo $donnees->NOM_E ?>
                <?php  endforeach; ?>
                </select>
                <select id="poste" name="poste" placeholder="Poste">
                <?php foreach ($test2 as $donnee): ?>
                    <option value="<?= $donnee->ID_R?>"><?php echo $donnee->NOM_R ?>
                <?php  endforeach; ?>
                </select>
                <input type="text" name="nom" placeholder="Écrire le nom du joueur">
                <input type="text" name="prenom" placeholder="Écrire le prénom du joueur">
                <input type="submit" name="valider" value="Valider">
            </form>
            
            <form action="../Controller/adminController.php" method="POST">
                <label for="match">Ajouter un match</label>
                <select id="equipe1" name="equipe1" placeholder="Équipe 1">
                <?php foreach ($test as $donnees): ?>
                    <option value="<?= $donnees->ID_E?>"><?php echo $donnees->NOM_E ?></option>
                <?php endforeach; ?>
                </select>
                <select id="equipe2" name="equipe2" placeholder="Équipe 2">
                <?php foreach ($test as $donnees): ?>
                    <option value="<?= $donnees->ID_E?>"><?php echo $donnees->NOM_E ?></option>
                <?php endforeach; ?>
                </select>
                <input type="date" name="date">
                <input type="time" name="heure">
                <input type="submit" name="submit" value="Valider">
            </form>

            <div>
                <a href="listeEquipe.php">Liste des équipes</a>
                <a href="listeJoueur.php">Liste des joueurs</a>
            </div>

        </section>
        
        <footer>
            <p>2022 &copy; Supporters Solidaires - Tous Droits Réservés - <a href="mailto:t.akpweh@gmail.com" target="_self">Nous contacter</a></p>
        </footer>
        <script src="../js/burger.js"></script>
    </body>
</html>