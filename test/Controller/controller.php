<?php 


if (isset($_POST["submit"])){
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["mail"]) && !empty($_POST["password"]) && !empty($_POST["password2"] && !empty($_POST['role']))){
        $nom = valid_donnees($_POST["nom"]);
        $role = valid_donnees($_POST['role']);
        $prenom = valid_donnees($_POST["prenom"]);
        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $password2 = password_hash($_POST["password2"], PASSWORD_DEFAULT);
        
        $dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');
        //$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        

        $sql = "SELECT MAIL_U FROM User WHERE User.MAIL_U = '$mail'";
        $prepare = $dbh->prepare($sql);
        $prepare->execute();
        $valeur = $prepare->fetchAll(PDO::FETCH_CLASS);
        $idV = $valeur['0']->MAIL_U;
        

        if ($idV == NULL) {
            $sql = "INSERT INTO User(NOM_U, PRENOM_U, MAIL_U, MDP_U) VALUES ('$nom','$prenom','$mail','$password')";
            $dbh->query($sql); 

            // Récupérer l'id_u
            $recup = "SELECT ID_U FROM User WHERE User.NOM_U = '$nom'";
            $prepare = $dbh->prepare($recup);
            $prepare->execute();
            $valeur = $prepare->fetchAll(PDO::FETCH_CLASS);
            $idU = $valeur['0']->ID_U;
            // var_dump($idU);

            // Insérer dans la table possède l'id_u et l'id_r qui vaut '1' 
            $sql2 = "INSERT INTO possede(ID_U, ID_R) VALUES ('$idU', '1')";
            $dbh->query($sql2);

            //require "../view/concours.php";
            header('Location: ../view/home.php');

        }
        else {
            //require "../view/identification.php";
            header('Location: ../view/identification.php');

            echo "Mail déjà utilisé";
        }
    }

}

if (isset($_POST["submit2"])){
    if (!empty($_POST["mail"]) && !empty($_POST["password"])){
        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
        $password = valid_donnees($_POST["password"]);
        

        $dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');

        $sql = "SELECT MAIL_U, MDP_U FROM User WHERE User.MAIL_U = '$mail'";
        $prepare = $dbh->prepare($sql);
        $prepare->execute();
        $valeur = $prepare->fetchAll(PDO::FETCH_CLASS);
        $verifMail = $valeur['0']->MAIL_U;
        $verifPassword = $valeur['0']->MDP_U;

        

        if ($verifMail == $mail && password_verify($password, $verifPassword)){
            session_start();
            $_SESSION['mail'] = $mail;
            
            

            //require "../view/home.php";
            header('Location: ../view/home.php');

        }
        else {
            //require "../view/identification.php";
            header('Location: ../view/identification.php');

            echo "Identifiant ou Mot de passe incorrects";
        }
    }
}

function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

?>