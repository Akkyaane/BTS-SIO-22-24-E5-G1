<?php

session_start();
include "../../db/db.php";
include "../../../controllers/functions.php";

$id = $_GET['updateid'];
if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
} else {
    $target_dir = "../../../content/uploads/";
    if (isset($_POST['submit'])) {
        $db_connect->exec('SET FOREIGN_KEY_CHECKS = 0');
        $sql = 'SELECT MAX(id) AS max_id FROM receipts';
        $request = $db_connect->prepare($sql);
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        $receiptsId = $data['max_id'];
        if ($receiptsId == NULL) {
            $receiptsId = 1;
        } else {
            $receiptsId++;
        }
        $expenseSheet = [];
        $receipts = [];
        $expenseSheet = [':ui' => $_SESSION['id'], ':ri' => $receiptsId, ':sd' => $_POST['start_date'], ':ed' => $_POST['end_date'], ':rd' => $_POST['request_date']];
        if (!empty($_POST['transport_category'])) {
            $expenseSheet[':tc'] = $_POST['transport_category'];
            if ($expenseSheet[':tc'] != 4) {
                if (!empty($_POST['transport_expense'])) {
                    $expenseSheet[':te'] = $_POST['transport_expense'];
                    $expenseSheet[':kn'] = NULL;
                    if (!empty($_FILES['transport_expense_file']['name'])) {
                        $receipts[':tef'] = $target_dir . 'transport_expense_' . $receiptsId . '_' . uniqid() . basename($_FILES["transport_expense_file"]["name"]);
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
                    $expenseSheet[':kn'] = $_POST['kilometers_number'];
                } else {
                    echo "Vous avez sélectionné le mode de transport 'voiture' mais n'avez saisi aucun nombre de kilomètres'. Veuillez recommencer.";
                    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
                }
            }
        } else {
            $expenseSheet[':tc'] = NULL;
        }
        if (!empty($_POST['accommodation_expense'])) {
            $expenseSheet[':ae'] = $_POST['accommodation_expense'];
            if (!empty($_POST['nights_number'])) {
                $expenseSheet[':nn'] = $_POST['nights_number'];
            } else {
                echo "Vous avez saisi un montant concernant les frais d'hébergement mais n'avez saisi aucun nombre de nuitées. Veuillez recommencer.";
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
            if (!empty($_FILES['accommodation_expense_file']['name'])) {
                $receipts[':aef'] = $target_dir . 'accommodation_expense_' . $receiptsId . '_' . uniqid() . basename($_FILES["accommodation_expense_file"]["name"]);
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
                $receipts[':fef'] = $target_dir . 'food_expense_' . $receiptsId . '_' . uniqid() . basename($_FILES["food_expense_file"]["name"]);
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
                $receipts[':oef'] = $target_dir . 'other_expense_' . $receiptsId . '_' . uniqid() . basename($_FILES["other_expense_file"]["name"]);
            } else {
                echo "Vous avez saisi un montant concernant des frais autres mais n'avez pas fourni de justificatif. Veuillez recommencer.";
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
            }
            if (!empty($_POST['message'])) {
                $expenseSheet[':m'] = $_POST['message'];
            } else {
                echo "Vous avez saisi un montant concernant des frais autres mais pas de message. Veuillez recommencer.";
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
            if (upload_files($receipts[':tef'], $fileToUpload) == false) {
                $uploadOk = false;
            } else {
                $uploadOk = true;
            }
        }
        if (!empty($receipts[':aef'])) {
            $fileToUpload = $_FILES['accommodation_expense_file']['tmp_name'];
            if (upload_files($receipts[':aef'], $fileToUpload) == false) {
                $uploadOk = false;
            } else {
                $uploadOk = true;
            }
        }
        if (!empty($receipts[':fef'])) {
            $fileToUpload = $_FILES['food_expense_file']['tmp_name'];
            if (upload_files($receipts[':fef'], $fileToUpload) == false) {
                $uploadOk = false;
            } else {
                $uploadOk = true;
            }
        }
        if (!empty($receipts[':oef'])) {
            $fileToUpload = $_FILES['other_expense_file']['tmp_name'];
            upload_files($receipts[':oef'], $fileToUpload);
            if (upload_files($receipts[':oef'], $fileToUpload) == false) {
                $uploadOk = false;
            } else {
                $uploadOk = true;
            }
        }
        if (empty($expenseSheet[':kn']) && empty($expenseSheet[':te']) && empty($expenseSheet[':nn']) && empty($expenseSheet[':ae']) && empty($expenseSheet[':fe']) && empty($expenseSheet[':oe'])) {
            echo "Aucun montant n'a été saisi. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
        } else if ($uploadOk == false) {
            echo "Un problème est survenu lors du téléchargement des fichiers. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
        } else {
            $sql = 'UPDATE expenseSheets SET user_id=:ui, receipts_id=:ri, start_date=:sd, end_date=:ed, request_date=:rd, transport_category=:tc, kilometers_number=:kn, transport_expense=:te, nights_number=:nn, accommodation_expense=:ae, food_expense=:fe, other_expense=:oe, message=:m WHERE id=:id';
            $request = $db_connect->prepare($sql);
            $request->bindParam(':ui', $expenseSheet[':ui']);
            $request->bindParam(':ri', $expenseSheet[':ri']);
            $request->bindParam(':sd', $expenseSheet[':sd']);
            $request->bindParam(':ed', $expenseSheet[':ed']);
            $request->bindParam(':rd', $expenseSheet[':rd']);
            $request->bindParam(':tc', $expenseSheet[':tc']);
            $request->bindParam(':kn', $expenseSheet[':kn']);
            $request->bindParam(':te', $expenseSheet[':te']);
            $request->bindParam(':nn', $expenseSheet[':nn']);
            $request->bindParam(':ae', $expenseSheet[':ae']);
            $request->bindParam(':fe', $expenseSheet[':fe']);
            $request->bindParam(':oe', $expenseSheet[':oe']);
            $request->bindParam(':m', $expenseSheet[':m']);
            $request->bindParam(':id', $id);
            $request->execute();
            $sql = 'INSERT INTO receipts (transport_expense, accommodation_expense, food_expense, other_expense) VALUES (:tef, :aef, :fef, :oef)';
            $request = $db_connect->prepare($sql);
            $request->execute($receipts);
            $db_connect->exec('SET FOREIGN_KEY_CHECKS = 1');
            echo "La fiche de frais a été modifiée.";
            echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
    }
}

?>