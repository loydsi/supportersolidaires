<?php
$dbh = new PDO('mysql:host=localhost:8889;dbname=supporter2', 'root', 'root');
$sql = $dbh->query("SELECT * FROM Equipe");
$equipes = $sql->fetchAll(PDO::FETCH_CLASS);
//var_dump($equipes);
$role = $dbh->query("SELECT * FROM Role");
$test = $role->fetchAll(PDO::FETCH_CLASS);


// $input = '06/10/2011';
// $date = strtotime($input);
// $newformat = date('Y-m-d', $date);
// echo ($newformat);
if(isset($_POST['submit']))
{
    // $id = $_POST['equipe1'];
    // $id1 = substr($id, -1);
    if(!empty($_POST['equipe1']) && !empty($_POST['equipe2']) && !empty($_POST['date'])&& !empty($_POST['heure']))
    {
        if($_POST['equipe1'] != $_POST['equipe2']) {
            $date = $_POST['date'];
            $heure = $_POST['heure'];
            $equipe1 = $_POST['equipe1'];
            $equipe2 = $_POST['equipe2'];
            
            $sql = "INSERT INTO Rencontre(DATE_M, HEURE_M) VALUES ('$date', '$heure')";
            $dbh->query($sql);

            // Récupérer l'id du match crée
            $sql = "SELECT ID_M FROM Rencontre WHERE Rencontre.DATE_M = '$date' AND Rencontre.HEURE_M = '$heure'";
            $prepare = $dbh->prepare($sql);
            $prepare->execute();
            $match2 = $prepare->fetchAll(PDO::FETCH_CLASS);
            //$match2 = $match2->ID_M;
            $idMatch = $match2['0']->ID_M;
            
            // $sql1 = "INSERT INTO dispute(ID_E, ID_M_RENCONTRE) VALUES ('$equipe1', '$idMatch')";
            // $dbh->query($sql1);
            // $sql2 = "INSERT INTO dispute(ID_E, ID_M_RENCONTRE) VALUES ('$equipe2', '$idMatch')";
            // $dbh->query($sql2);

        }
        
    }
}
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
                    <li><a href="home.html">Accueil</a></li>
                    <li><a href="jeu.html">Jeu concours</a></li>
                    <li><a href="elections.html">Élections</a></li>
                    <li><a href="identification.html">S'identifier</a></li>
                </ul>
            </nav>
        </header>

        <section>
            <form action="../Controller/equipe.php" method="POST">
                <label for="equipe">Ajouter une équipe</label>
                <input type="text" name="equipes" placeholder="Écrire le nom de l'équipe">
                <input type="submit" name="submit" value="Valider">
            </form>

            <form action="admin.php" method="POST">

                <label for="match">Ajouter un match</label>
                <select id="equipe1" name="equipe1" placeholder="Équipe 1">
                <?php foreach($equipes as $equipe): ?>
                        <option value="<?= $equipe->ID_E ?>"><?= $equipe->NOM_E ?></option>
                <?php endforeach; ?>
                </select>

                <select id="equipe2" name="equipe2" placeholder="Équipe 2">
                <?php foreach($equipes as $equipe): ?>
                    <option value="<?= $equipe->ID_E ?>" ><?= $equipe->NOM_E ?></option>

                <?php endforeach; ?>
                </select>
                <input type="date" name="date">
                <input type="time" name="heure">
                <input type="submit" name="submit" value="Valider">
            </form>

            <form>
                <label for="joueurs">Ajouter les joueurs</label>
                <select id="equipe" name="equipe" placeholder="Équipe">
                <?php foreach($equipes as $equipe): ?>
                        <option value="<?= $equipe->ID_E ?>"><?= $equipe->NOM_E ?></option>
                <?php endforeach; ?>
                </select>
                <select id="poste" name="poste" placeholder="Poste">
                <?php foreach($test as $role): ?>
                    <option value="<?= $role->ID_R ?>"><?= $role->NOM_R ?></option>
                <?php endforeach; ?>
                </select>
                <input type="text" name="nom" placeholder="Écrire le nom du joueur">
                <input type="text" name="prenom" placeholder="Écrire le prénom du joueur">
                <input type="submit" name="valider" value="Valider">
            </form>

            <div>
                <a href="./listeEquipes.html">Liste des équipes</a>
                <a href="./listeJoueurs.html">Liste des joueurs</a>
                <a href="./listeParticipants.html">Liste des participants</a>
            </div>

        </section>
        
        <footer>
            <p>2022 &copy; Supporters Solidaires - Tous Droits Réservés - <a href="mailto:t.akpweh@gmail.com" target="_self">Nous contacter</a></p>
        </footer>
        <script src="../js/burger.js"></script>
    </body>
</html>