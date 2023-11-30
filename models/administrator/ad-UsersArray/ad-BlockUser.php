<?php
session_start();

$id = $_GET['updateid'];
include "../../db/db.php";

    $sql = 'SELECT * FROM users WHERE id=?';
    $request = $db_connect->prepare($sql);
    $request->bindParam(1, $id, PDO::PARAM_INT);
    $request->execute();
    $data = $request->fetch(PDO::FETCH_ASSOC); //récupère l'id de l'utilisateur ciblé 
    
    if($data){
        $sql = "UPDATE users SET statuts = 0 WHERE id=?";
        $request = $db_connect->prepare($sql);
        $request->bindParam(1, $id, PDO::PARAM_INT);
        $request->execute();
        echo "Le compte a été bloqué.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
    } else {
        echo "Le compte est déjà désactivé.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";

    } 

  /*  if ($user[':s'] == 0) {
        echo "Le compte est déjà désactivé.";
    } else {
        $sql = 'UPDATE users SET statuts = 0 WHERE id=:id';
        $result = $db_connect->prepare($sql);
        
    //  $result->bindParam(':s', $user[':s']);
        $result->bindParam(':id', $id);
        
        if ($result->execute()) {
            echo "Le compte a été bloqué.";
        } else {
            echo "Erreur lors du blocage du compte : " . $result->errorInfo()[2];
        }

        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
    } */

?>