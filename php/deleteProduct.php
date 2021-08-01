<?php
require_once 'utils.php';
$id = $_GET['id'];
$query = "DELETE FROM product WHERE id=$id";
$con = connection();
$result = $con->query($query);
if($result){
    header("Location: ../index.php");
}
?>