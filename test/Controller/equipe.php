<?php

$equipe = $_POST['equipes'];

if (isset($_POST['submit'])){
    if (!empty($_POST['equipes'])){
        $dbh = new PDO('mysql:host=localhost:8889;dbname=supporter', 'root', 'root');
        $sql = "INSERT INTO Equipe(NOM_E) VALUES ('$equipe')";
        $dbh->query($sql);
        header('Location: ../view/admin.php');
    }
}

?>