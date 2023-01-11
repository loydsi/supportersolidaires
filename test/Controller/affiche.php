<?php
session_start();
$dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');

$sql = "SELECT * FROM dispute INNER JOIN Equipe ON dispute.ID_E = Equipe.ID_E
INNER JOIN Rencontre ON Rencontre.ID_M = dispute.ID_M_Rencontre ORDER BY Rencontre.DATE_M DESC";
$prepare = $dbh->prepare($sql);
$prepare->execute();
$affiche = $prepare->fetchAll(PDO::FETCH_CLASS);

// Ajouter la participation d'un utilisateur au concour
if (isset($_POST['submit'])){

    $mail = $_SESSION['mail'];
    $sql1 = "SELECT ID_U FROM User WHERE User.MAIL_U = '$mail'";
    $prepare = $dbh->prepare($sql1);
    $prepare->execute();
    $idU = $prepare->fetchAll(PDO::FETCH_CLASS);
    $idU = $idU[0]->ID_U;

    
    
    foreach($_POST['submit'] as $key => $value){
        $idM = $key;
    }
    
    $sql2 = "SELECT ID_U FROM participe WHERE participe.ID_U = '$idU' AND participe.ID_M = '$idM'";
    $prepare1 = $dbh->prepare($sql2);
    $prepare1->execute();
    $valeur = $prepare1->fetchAll(PDO::FETCH_CLASS);
    $id = $valeur[0]->ID_U;
    
    if ($id == NULL) {

    $insert = "INSERT INTO participe(ID_U, ID_M) VALUES ('$idU','$idM')";
    $dbh->query($insert);
    header('Location: ../view/concours.php');
    } else {
        
        header('Location: ../view/concours.php');
    }
}


if (isset($_POST['elir'])){
    foreach ($_POST['elir'] as $key => $value){
        $idM = "{$key}";
        $_SESSION['idM'] = $idM;

        // Récupérer le nom et prénom des joueurs des matchs
        $sql = "SELECT NOM_J, PRENOM_J, joue.ID_J FROM joue INNER JOIN Joueur ON joue.ID_J = Joueur.ID_J WHERE joue.ID_M = '$idM' AND Joueur.ID_R = '3'";
        $prepare = $dbh->prepare($sql);
        $prepare->execute();
        $idJ = $prepare->fetchAll(PDO::FETCH_CLASS);
        $_SESSION['idJ'] = $idJ;

        // Récupérer le nom et prénom des gardiens des matchs
        $sql1 = "SELECT NOM_J, PRENOM_J, joue.ID_J FROM joue INNER JOIN Joueur ON joue.ID_J = Joueur.ID_J WHERE joue.ID_M = '$idM' AND Joueur.ID_R = '4'";
        $prepare = $dbh->prepare($sql1);
        $prepare->execute();
        $idG = $prepare->fetchAll(PDO::FETCH_CLASS);
        $_SESSION['idG'] = $idG;
    }

    header('Location: ../view/elir.php');
}

if(isset($_POST['vote'])){
    if(!empty($_POST['joueur']) && !empty($_POST['gardien'])){

        $mail = $_SESSION['mail'];
        $sql1 = "SELECT ID_U FROM User WHERE User.MAIL_U = '$mail'";
        $prepare = $dbh->prepare($sql1);
        $prepare->execute();
        $idU = $prepare->fetchAll(PDO::FETCH_CLASS);
        $idU = $idU[0]->ID_U;
        
        $idM = $_SESSION['idM'];

        $idJoueur = $_SESSION['idJoueur'];
        $idGardien = $_SESSION['idGardien'];

        $sql2 = "INSERT INTO Vote (Vote, ID_U, ID_M, ID_J) VALUES (1, '$idU', '$idM', '$idJoueur')";
        $dbh->query($sql2);

        $sql3 = "INSERT INTO Vote (Vote, ID_U, ID_M, ID_J) VALUES (1, '$idU', '$idM', '$idGardien')";
        $dbh->query($sql3);
        
        header('Location: ../view/elir.php');
    }else {
        header('Location: ../view/elir.php');
    }
}


if (isset($_POST['resultat'])){
    foreach ($_POST['resultat'] as $key => $value){
        $idM = "{$key}";
        $_SESSION['idM'] = $idM;

        // Récupérer le nom et prénom des joueurs des matchs
        $sql = "SELECT NOM_J, PRENOM_J, joue.ID_J FROM joue INNER JOIN Joueur ON joue.ID_J = Joueur.ID_J WHERE joue.ID_M = '$idM' AND Joueur.ID_R = '3'";
        $prepare = $dbh->prepare($sql);
        $prepare->execute();
        $idJ = $prepare->fetchAll(PDO::FETCH_CLASS);
        //$_SESSION['idJ'] = $idJ;

        // Récupérer le nom et prénom des gardiens des matchs
        $sql1 = "SELECT NOM_J, PRENOM_J, joue.ID_J FROM joue INNER JOIN Joueur ON joue.ID_J = Joueur.ID_J WHERE joue.ID_M = '$idM' AND Joueur.ID_R = '4'";
        $prepare = $dbh->prepare($sql1);
        $prepare->execute();
        $idG = $prepare->fetchAll(PDO::FETCH_CLASS);
        //$_SESSION['idG'] = $idG;

        // Afficher le nombre de vote pour chaque joueur du match
        for ($i=0; $i<count($idJ); $i++) {
            $idJoueur = $idJ[$i]->ID_J;
            $sql = "SELECT COUNT(ID_V), NOM_J, PRENOM_J FROM Vote INNER JOIN Joueur ON Vote.ID_J = Joueur.ID_J WHERE Vote.ID_M = '$idM' AND Vote.ID_J = '$idJoueur'";
            $prepare = $dbh->prepare($sql);
            $prepare->execute();
            $nbVJ = $prepare->fetchAll(PDO::FETCH_CLASS);
            $_SESSION['idnbVJ'] = $nbVJ;
        }

        // Afficher le nombre de vote pour chaque gardien du match
        for ($i=0; $i<count($idG); $i++) {
            $idGardien = $idG[$i]->ID_J;
            $sql = "SELECT VOTE, NOM_J, PRENOM_J FROM Vote INNER JOIN Joueur ON Vote.ID_J = Joueur.ID_J WHERE Vote.ID_M = '$idM' AND Vote.ID_J = '$idGardien'";
            $prepare = $dbh->prepare($sql);
            $prepare->execute();
            $nbVG = $prepare->fetchAll(PDO::FETCH_CLASS);
            //var_dump($nbVG);
            echo "<hr>";    
            foreach($nbVG as $value){
                $nombres = array($value);
                print_r($nombres);
                for ($i=0; $i<count($nombres); $i++){
                    $nombre = $nombres[$i]->VOTE;
                    $nom = $nombres[$i]->NOM_J;
                    var_dump($nombre);
                    var_dump($nom);
                }
            }      
            
            //$nbVG = $nbVG[0]->VOTE;
            //var_dump($nbVG);  
            //var_dump($nbVG);
            //$_SESSION['idnbVG'] = $nbVG;

            //var_dump($nbVG);
            //var_dump($_SESSION['idnbVG']);
        }

        //header('Location: ../view/resultat.php');
    }
}

    
 
        
