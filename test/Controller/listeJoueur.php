<?php
session_start();
$dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');

$sql = "SELECT * FROM Joueur";
$prepare = $dbh->prepare($sql);
$prepare->execute();
$listeJ = $prepare->fetchAll(PDO::FETCH_CLASS);



if (isset($_POST['effacer'])){
    foreach ($_POST['effacer'] as $key => $value){
        $idJ = "{$key}";
        $sql = "DELETE FROM Joueur WHERE Joueur.ID_J = '$idJ'";
        $dbh->query($sql);
        header('Location: ../view/listeJoueur.php');
    }
    
}

if (isset($_POST['modifier'])){

    foreach ($_POST['modifier'] as $key => $value){
        $idJ = "{$key}";
        $_SESSION['idJo'] = $idJ;   
        header('Location: ../view/modifierJ.php');
    }
}


// if (isset($_POST['valider'])){
//     if (!empty($_POST['nom']) && !empty($_POST['prenom'])){
//         var_dump($_SESSION['idJ']);

//         $nouveauNom =htmlspecialchars($_POST['nom']);
//         $nouveauPrenom =htmlspecialchars($_POST['prenom']);
//         var_dump($nouveauNom);
//         var_dump($nouveauPrenom);
//         //$sql = "UPDATE"
//     }
//     else {
//         echo "Veuillez entrer un nom et un prénom ";
//     }
// }

if (isset($_POST['valider'])){
    if (!empty($_POST['nom']) && !empty($_POST['prenom'])){
        //var_dump($_SESSION['idE']);
        $idJ = $_SESSION['idJo'];
        $nouveauNom =htmlspecialchars($_POST['nom']);
        $nouveauPrenom =htmlspecialchars($_POST['prenom']);
        //var_dump($nouveauNom);
        $sql = "UPDATE Joueur SET Joueur.NOM_J = '$nouveauNom', Joueur.PRENOM_J = '$nouveauPrenom' WHERE Joueur.ID_J = '$idJ'";
        $dbh->query($sql);
        header('Location: ../view/listeJoueur.php');
    }
    else {
        echo "Veuillez entrer un nom ";
    }
}
?>