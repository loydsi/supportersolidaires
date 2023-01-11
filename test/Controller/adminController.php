<?php
session_start();
$dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');
//$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
//$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

// Récupérer l'id et le nom de chaque équipe crée par l'utilisateur
$query = $dbh->query("SELECT * FROM Equipe");
$test = $query->fetchAll(PDO::FETCH_CLASS);

// Récupérer l'id et le nom des rôles des joueurs
$role = $dbh->query("SELECT * FROM Role ");
$test2 = $role->fetchAll(PDO::FETCH_CLASS);

// Requêtes SQL pour l'ajout des matchs
if (isset($_POST['submit'])){
if (!empty($_POST['equipe1']) && !empty($_POST['equipe2']) && !empty($_POST['date']) && !empty($_POST['heure'])){
    if ($_POST['equipe1'] != $_POST['equipe2']){
        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $equipe1 = $_POST['equipe1'];
        $equipe2 = $_POST['equipe2'];

        // Insérer la date et l'heure du match
        $sql = "INSERT INTO Rencontre(DATE_M, HEURE_M) VALUES ('$date', '$heure')";
        $dbh->query($sql);

        // Récupérer l'id du match crée
        $sql1 = "SELECT ID_M FROM Rencontre WHERE Rencontre.DATE_M = '$date' AND Rencontre.HEURE_M = '$heure'";
        $match = $dbh->prepare($sql1);
        $match->execute();
        $match2 = $match->fetchAll(PDO::FETCH_CLASS);
        $idMatch = $match2['0']->ID_M;

        
        // Insérer l'id des deux équipes dans la table 'dispute'
        // echo $equipe1 . ' et ' . $equipe2 . ' jouent le match n°' .$idMatch;
        $sql2 = "INSERT INTO dispute(ID_E, ID_M_RENCONTRE) VALUES ('$equipe1', '$idMatch')";
        $dbh->query($sql2);
        // 
        $sql3 = "INSERT INTO dispute(ID_E, ID_M_RENCONTRE) VALUES ('$equipe2', '$idMatch')";
        $dbh->query($sql3);


        // Récupérer l'ID_J et l'ID_M
        $sql4 = "SELECT ID_J FROM Joueur WHERE Joueur.ID_E = '$equipe1' OR Joueur.ID_E = '$equipe2'";

        $recup = $dbh->prepare($sql4);
        $recup->execute();
        $rec = $recup->fetchAll(PDO::FETCH_CLASS);
        
        
        for ($i=0; $i<count($rec); $i++){
            $idJ = $rec[$i]->ID_J;
            $insert = "INSERT INTO joue (ID_J, ID_M) VALUES ('$idJ', '$idMatch') ";
            $dbh->query($insert);
            
        }
        header('Location: ../view/admin.php');
     }
}
}

// Requêtes SQL pour l'ajout des joueurs
if (isset($_POST['valider'])){
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['equipe']) && !empty($_POST['poste'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $idEquipe = $_POST['equipe'];
    $idRole = $_POST['poste'];
    $sql = "INSERT INTO Joueur(NOM_J, PRENOM_J, ID_R, ID_E) VALUES ('$nom', '$prenom', '$idRole', '$idEquipe')";
    $dbh->query($sql);
    header('Location: ../view/admin.php');

}
}

?>