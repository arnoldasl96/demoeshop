<?php
require_once 'utils.php';
$con = connection();
$id= $_POST['id'];
$result = $con->query("SELECT * From product WHERE id=$id");
$product = $result->fetch_assoc();
$validationErrors = [];
$targetDir = "../uploads/";
$fileName = null;

if (empty($_FILES["picture"]["tmp_name"])) {
    $fileName = $product['picture'];
} else {
    $fileName = rand(1, 9999) * rand(1, 9999) . basename($_FILES["picture"]["name"]);
    unlink($targetDir . $product['picture']);
}
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (!isset($_POST['model']) || strlen($_POST['model']) > 100 || strlen($_POST['model']) < 0) {
    $validationErrors[] = 1;
}
if (!isset($_POST['manufacturer']) || strlen($_POST['manufacturer']) > 100 || strlen($_POST['manufacturer']) < 0) {
    $validationErrors[] = 2;
}
if (!isset($_POST['category']) || strlen($_POST['category']) > 100 || strlen($_POST['category']) < 0) {
    $validationErrors[] = 3;
}
if (!isset($_POST['instock']) || $_POST['instock'] < 1) {
    $validationErrors[] = 4;
}
if (!isset($_POST['price']) || $_POST['price'] < 0) {
    $validationErrors[] = 5;
}
if (!isset($_POST['description']) || strlen($_POST['description']) < 0) {
    $validationErrors[] = 6;
}
if (count($validationErrors) === 0) {
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

    if (in_array($fileType, $allowTypes)) {
        if(move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)){
           if (sqlUpdate(
            $con,
            "UPDATE product SET model=?, manufacturer=?, picture=?, price=?, category=?, description=?, in_stock=? WHERE `id`=?",'sssissii',
            $_POST['model'],
            $_POST['manufacturer'],
            $fileName,
            $_POST['price'],
            $_POST['category'],
            $_POST['description'],
            $_POST['instock'],
            $id
        )) {
            $validationErrors[] = 0;
        } 
        }
         else {
            $validationErrors[] = 7;
        }
    } else {
        $validationErrors[] = 9;
    }
}
echo json_encode($validationErrors);
