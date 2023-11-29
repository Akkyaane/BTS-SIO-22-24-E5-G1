<?php

function upload_files($target_file, $fileToUpload) {
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowedImageTypes = array("jpg", "jpeg", "png");
            $uploadOk = false;

            if(!in_array($fileType, $allowedImageTypes) && $fileType != "pdf" && $fileType != "webp") {
                echo "Le fichier ".$target_file." n'est pas au format JPG, JPEG, PNG, WEBP ou PDF.";
                $uploadOk = false;
            }
            else {
                if (move_uploaded_file($fileToUpload, $target_file)) {
                    $uploadOk = true;
                } else {
                    echo "Le fichier".htmlspecialchars(basename($target_file))." n'a pas été téléchargé.";
                    $uploadOk = false;
                }
            }
            return $uploadOk;
        }

?>