<?php
session_start();

include "../../db/db.php";

    $sql = 'SELECT * FROM users WHERE id=?';
    $request = $dbConnect->prepare($sql);
    $request->bindParam(1, $_GET['updateid'], PDO::PARAM_INT);
    $request->execute();
    $data = $request->fetch(PDO::FETCH_ASSOC);
    
    if($data){
        $sql = "UPDATE users SET status = 0 WHERE id=?";
        $request = $dbConnect->prepare($sql);
        $request->bindParam(1, $_GET['updateid'], PDO::PARAM_INT);
        $request->execute();
        echo "Le compte a été bloqué.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
    } else {
        echo "Le compte est déjà désactivé.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";

    } 
?>