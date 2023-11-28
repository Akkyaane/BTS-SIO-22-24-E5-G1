<?php

session_start();
include "../../db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
} else {
    function upload_file($target_file, $fileToUpload):int {
        if(isset($_POST["submit"])) {
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowedImageTypes = array("jpg", "jpeg", "png", "pdf", "webp");
    
            if(!in_array($fileType, $allowedImageTypes)) {
                echo "Le fichier ".htmlspecialchars(basename($target_file))." n'est pas au format PDF, PNG, JPEG ou JPG. Veuillez recommencer.";
                $uploadOk = 0;
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
            if (file_exists($target_file)) {
                echo "Un ou plusieurs fichiers ont déjà été transmis. Veuillez recommencer.";
                $uploadOk = 0;
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
            if ($target_file > 1500000) {
                echo "Le fichier ".htmlspecialchars(basename($target_file))." est trop lourd. Veuillez recommencer.";
                $uploadOk = 0;
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
            if (move_uploaded_file($fileToUpload, $target_file)) {
                $uploadOk = 1;
            } else {
                echo "Le fichier ".htmlspecialchars(basename($target_file))." n'a pas été soumis.";
                $uploadOk = 0;
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
            return $uploadOk;
        }
    }
    $target_dir = "../../../content/uploads/";
    if (isset($_POST['submit'])) {
        // $db_connect->exec('SET FOREIGN_KEY_CHECKS = 0');
        $sql = 'SELECT MAX(id) AS max_id FROM expensesheets';
        $request = $db_connect->prepare($sql);
        $request->execute();
        $result = $request->fetch();
        $expense_sheets_maxId = $result['max_id'];
        if ($expense_sheets_maxId == NULL) {
            $expense_sheets_maxId = 1;
        }
        else {
            $expense_sheets_maxId++;
        }

        $sql = 'SELECT MAX(id) AS max_id FROM receipts';
        $request = $db_connect->prepare($sql);
        $request->execute();
        $result = $request->fetch();
        $receipts_maxId = $result['max_id'];
        if ($receipts_maxId == NULL) {
            $receipts_maxId = 1;
        }
        else {
            $receipts_maxId++;
        }

        $expenseSheet = [];
        $receipts = [];
        $expenseSheet = [':ui' => $_SESSION['id'], ':ri' => $receipts_maxId, ':sd' => $_POST['start_date'], ':ed' => $_POST['end_date'], ':rd' => $_POST['request_date'], ':nn' => $_POST['nights_number']];
        if (!empty($_POST['transport_category'])) {
            $expenseSheet[':tc'] = $_POST['transport_category'];
            if ($expenseSheet[':tc'] != 4) {
                if (!empty($_POST['transport_expense'])) {
                    $expenseSheet[':te'] = $_POST['transport_expense'];
                    $expenseSheet[':ke'] = NULL;
                    if (!empty($_FILES['transport_expense_file']['name'])) {
                        $receipts[':tef'] = $target_dir.$_SESSION['id'].'_'.$expense_sheets_maxId.'_transport_expense_'.$_FILES['transport_expense_file']['name'];                
                    } else {
                        echo "Vous avez sélectionné un mode de transport mais n'avez pas fourni de justificatif. Veuillez recommencer.";
                        echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
                    }
                } else {
                    echo "Vous avez sélectionné un mode de transport mais n'avez pas saisi de montant. Veuillez recommencer.";
                    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
                }
            } else {
                if (!empty($_POST['kilometers_number'])) {
                    $expenseSheet[':te'] = NULL;
                    $receipts[':tef'] = NULL;
                    $expenseSheet[':ke'] = $_POST['kilometers_number'];
                } else {
                    echo "Vous avez sélectionné le mode de transport 'voiture' mais n'avez saisi aucune valeur dans le champ 'Nombres total de kilomètres'. Veuillez recommencer.";
                    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
                }
            }
        } else {
            $expenseSheet[':tc'] = NULL;
        }
        if (!empty($_POST['accommodation_expense'])) {
            $expenseSheet[':ae'] = $_POST['accommodation_expense'];
            if (!empty($_FILES['accommodation_expense_file']['name'])) {
                $receipts[':aef'] = $target_dir.$_SESSION['id'].'_'.$expense_sheets_maxId.'_accommodation_expense_'.$_FILES['accommodation_expense_file']['name'];
            } else {
                echo "Vous avez saisi un montant concernant les frais d'hébergement mais n'avez pas fourni de justificatif. Veuillez recommencer.";
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
        } else {
            $expenseSheet[':ae'] = NULL;
            $receipts[':aef'] = NULL;
        }
        if (!empty($_POST['food_expense'])) {
            $expenseSheet[':fe'] = $_POST['food_expense'];
            if (!empty($_FILES['food_expense_file']['name'])) {
                $receipts[':fef'] = $target_dir.$_SESSION['id'].'_'.$expense_sheets_maxId.'_food_expense_'.$_FILES['food_expense_file']['name'];
            } else {
                echo "Vous avez saisi un montant concernant les frais d'alimentation mais n'avez pas fourni de justificatif. Veuillez recommencer.";
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
        } else {
            $expenseSheet[':fe'] = NULL;
            $receipts[':fef'] = NULL;
        }
        if (!empty($_POST['other_expense'])) {
            $expenseSheet[':oe'] = $_POST['other_expense'];
            if (!empty($_FILES['other_expense_file']['name'])) {
                $receipts[':oef'] = $target_dir.$_SESSION['id'].'_'.$expense_sheets_maxId.'_other_expense_'.$_FILES['other_expense_file']['name'];
            } else {
                echo "Vous avez saisi un montant concernant d'autres frais mais n'avez pas fourni de justificatif. Veuillez recommencer.";
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
            if (!empty($_POST['message'])) {
                $expenseSheet[':m'] = $_POST['message'];
            } else {
                echo "Vous avez saisi une valeur pour le champ 'Autres' mais pas de message. Veuillez recommencer.";
                echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
                die;
            }
        } else {
            $expenseSheet[':oe'] = NULL;
            $expenseSheet[':m'] = NULL;
            $receipts[':oef'] = NULL;
        }

        if (!empty($receipts[':tef'])) {
            $fileToUpload = $_FILES['transport_expense_file']['tmp_name'];
            upload_file($receipts[':tef'], $fileToUpload);
            if (upload_file($receipts[':tef'], $fileToUpload) == 0) {
                $uploadOk = 0;
            }
            else {
                $uploadOk = 1;
            }
        }
        if (!empty($receipts[':aef'])) {
            $fileToUpload = $_FILES['accommodation_expense_file']['tmp_name'];
            upload_file($receipts[':aef'], $fileToUpload);
            if (upload_file($receipts[':aef'], $fileToUpload) == 0) {
                $uploadOk = 0;
            }
            else {
                $uploadOk = 1;
            }
        }
        if (!empty($receipts[':fef'])) {
            $fileToUpload = $_FILES['food_expense_file']['tmp_name'];
            upload_file($receipts[':fef'], $fileToUpload);
            if (upload_file($receipts[':fef'], $fileToUpload) == 0) {
                $uploadOk = 0;
            }
            else {
                $uploadOk = 1;
            }
        }
        if (!empty($receipts[':oef'])) {
            $fileToUpload = $_FILES['other_expense_file']['tmp_name'];
            upload_file($receipts[':oef'], $fileToUpload);
            if (upload_file($receipts[':oef'], $fileToUpload) == 0) {
                $uploadOk = 0;
            }
            else {
                $uploadOk = 1;
            }
        }

        if (empty($expenseSheet[':ke']) && empty($expenseSheet[':te']) && empty($expenseSheet[':ae']) && empty($expenseSheet[':fe']) && empty($expenseSheet[':oe'])) {
            echo "Aucun montant n'a été saisi. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
        } else if ($uploadOk == 0) {
            echo "Un problème est survenu dans le téléchargement des fichiers. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
        } else {
            $sql = 'INSERT INTO expenseSheets (user_id, receipts_id, start_date, end_date, request_date, transport_category, kilometers_number, transport_expense, nights_number, accommodation_expense, food_expense, other_expense, message) VALUES (:ui, :ri, :sd, :ed, :rd, :tc, :ke, :te, :nn, :ae, :fe, :oe, :m)';
            $request = $db_connect->prepare($sql);
            $request->execute($expenseSheet);

            $sql = 'INSERT INTO receipts (transport_expense, accommodation_expense, food_expense, other_expense) VALUES (:tef, :aef, :fef, :oef)';
            $request = $db_connect->prepare($sql);
            $request->execute($receipts);
            echo "Fiche de frais soumis";
            echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
    }
}

?>