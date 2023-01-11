<?php
session_start();
$dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');

$sql = "SELECT * FROM Equipe";
$prepare = $dbh->prepare($sql);
$prepare->execute();
$listeE = $prepare->fetchAll(PDO::FETCH_CLASS);



if (isset($_POST['effacer'])){
    foreach ($_POST['effacer'] as $key => $value){
        $idE = "{$key}";
        $sql = "DELETE FROM Equipe WHERE Equipe.ID_E = '$idE'";
        $dbh->query($sql);
        header('Location: ../view/listeEquipe.php');
    }
    
}

if (isset($_POST['modifier'])){
    foreach ($_POST['modifier'] as $key => $value){
        $idE = "{$key}";
        $_SESSION['idE'] = $idE;     
        header('Location: ../view/modifierE.php');
    }
}


if (isset($_POST['valider'])){
    if (!empty($_POST['nom'])){
        var_dump($_SESSION['idE']);

        $nouveauNom =htmlspecialchars($_POST['nom']);
        var_dump($nouveauNom);
        //$sql = "UPDATE"
    }
    else {
        echo "Veuillez entrer un nom ";
    }
}

if (isset($_POST['valider'])){
    if (!empty($_POST['nom'])){
        //var_dump($_SESSION['idE']);
        $idE = $_SESSION['idE'];
        $nouveauNom =htmlspecialchars($_POST['nom']);
        //var_dump($nouveauNom);
        $sql = "UPDATE Equipe SET Equipe.Nom_E = '$nouveauNom' WHERE Equipe.ID_E = '$idE'";
        $dbh->query($sql);
        header('Location: ../view/listeEquipe.php');
    }
    else {
        echo "Veuillez entrer un nom ";
    }
}
?>