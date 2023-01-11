<?php 


if (isset($_POST["submit"])){
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["mail"]) && !empty($_POST["password"]) && !empty($_POST["password2"])){
        $nom = valid_donnees($_POST["nom"]);
        $prenom = valid_donnees($_POST["prenom"]);
        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
        $password = valid_donnees($_POST["password"]);
        $password2 = valid_donnees($_POST["password2"]);  

        require "../view/jeu.html";
        var_dump ($_POST);
    }
}

if (isset($_POST["submit2"])){
    if (!empty($_POST["mail"]) && !empty($_POST["password"])){
        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
        $password = valid_donnees($_POST["password"]);

        require "../view/jeu.html";
        var_dump ($_POST);
    }
}

function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

?>