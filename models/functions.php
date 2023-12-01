<?php
function upload_files($target_file, $fileToUpload)
{
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowedImageTypes = array("jpg", "jpeg", "png", "webp");
    $uploadOk = false;

    if (!in_array($fileType, $allowedImageTypes) && $fileType != "pdf") {
        echo "Le fichier " . $target_file . " n'est pas dans le bon format. Seuls les formats JPG, JPEG, PNG, WEBP ou PDF sont acceptés.";
        $uploadOk = false;
    } else {
        if (move_uploaded_file($fileToUpload, $target_file)) {
            $uploadOk = true;
        } else {
            echo "Le fichier" . htmlspecialchars(basename($target_file)) . " n'a pas pu être téléchargé.";
            $uploadOk = false;
        }
    }
    return $uploadOk;
}
