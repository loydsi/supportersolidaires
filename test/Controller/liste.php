<?php
// Récupérer la liste des participants

if (isset($_POST['liste'])){

    foreach ($_POST['liste'] as $key => $value){
        $idM = "{$key}";
    }
    $dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');
    $sql3 = "SELECT NOM_U, PRENOM_U FROM participe INNER JOIN User ON participe.ID_U = User.ID_U WHERE participe.ID_M = '$idM'";
    $prepare = $dbh->prepare($sql3);
    $prepare->execute();
    $liste = $prepare->fetchAll(PDO::FETCH_CLASS);

    session_start();
    $_SESSION['liste'] = $liste;
    

    header('Location: ../view/liste.php');
}