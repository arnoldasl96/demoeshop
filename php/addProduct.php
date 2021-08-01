<?php
require_once 'utils.php';
$validationErrors = [];
$targetDir = "../uploads/";
$fileName=null;
if(empty($_FILES["picture"]["tmp_name"])){
    $fileName ="placeholder-image.png";
}
else{
    $fileName = rand(1,9999)*rand(1,9999) . basename($_FILES["picture"]["name"]);
}

$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (!isset($_POST['model']) || strlen($_POST['model']) > 100) {
    $validationErrors[] = 1;
}
if (!isset($_POST['manufacturer']) || strlen($_POST['manufacturer']) > 100) {
    $validationErrors[] = 2;
}
if (!isset($_POST['category']) || strlen($_POST['category']) > 100) {
    $validationErrors[] = 3;
}
if (!isset($_POST['instock']) || $_POST['instock'] < 1) {
    $validationErrors[] = 4;
}
if (!isset($_POST['price']) || $_POST['price'] < 0) {
    $validationErrors[] = 5;
}
if (!isset($_POST['description']) || $_POST['description'] < 0) {
    $validationErrors[] = 6;
}

if (count($validationErrors) == 0) {
    $con = connection();
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if(empty($_FILES["picture"]["tmp_name"])){
            $insert = SQLInsert(
                $con,
                "INSERT INTO product VALUES (null,?,?,?,?,0,?,?,?)",
                'sssissi',
                $_POST['model'],
                $_POST['manufacturer'],
                $fileName,
                $_POST['price'],
                $_POST['category'],
                $_POST['description'],
                $_POST['instock'],
            );
            if ($insert !== -1) {
                $validationErrors[] = 0;
            } else {
                $validationErrors[] = 7;
            }
        }
        else{
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
                $insert = SQLInsert(
                    $con,
                    "INSERT INTO product VALUES (null,?,?,?,?,0,?,?,?)",
                    'sssissi',
                    $_POST['model'],
                    $_POST['manufacturer'],
                    $fileName,
                    $_POST['price'],
                    $_POST['category'],
                    $_POST['description'],
                    $_POST['instock'],
                );
                if ($insert !== -1) {
                    $validationErrors[] = 0;
                } else {
                    $validationErrors[] = 7;
                }
            }
            else{
                $validationErrors[] = 8;
            }
        }
       
    }
    else{
        $validationErrors[] = 9;

    }
}
echo json_encode($validationErrors);
