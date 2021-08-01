<?php 
session_start();
require_once "utils.php";

$connection = connection();
$product=null;


    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $res = sqlSelect($connetion, 'SELECT * FROM product WHERE id=? LIMIT 1', 'i', $_POST['id']);
        if($res && $res->num_rows === 1){
            $product = $res->fetch_assoc();
        }

    }
?>