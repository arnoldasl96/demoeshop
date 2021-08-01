<?php
require_once 'php/utils.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit;
}

$user = [];
$categories = [];
$products = [];
$manufacturers = [];
$connetion = connection();
if ($connetion) {
  $res = sqlSelect($connetion, 'SELECT * FROM users WHERE id=? LIMIT 1', 'i', $_SESSION['userID']);
  if ($res && $res->num_rows === 1) {
    $user = $res->fetch_assoc();
  } else {
    exit;
  }
} else {
  exit;
}

if ($connetion) {
  $query = 'SELECT DISTINCT category FROM product';
  $category = mysqli_query($connetion, $query);
  while ($rows = mysqli_fetch_assoc($category)) {
    $categories[] = $rows['category'];
  }
}

if (!isset($_POST['categories'])) {
  if ($connetion) {
    $query = 'SELECT * FROM product ORDER BY in_stock DESC';

    $category = mysqli_query($connetion, $query);
    while ($rows = mysqli_fetch_assoc($category)) {
      $products[] = $rows;
    }
  }
} else {
  if ($connetion) {
    $cat =$_POST['categories'];
    $query = "SELECT * FROM product WHERE category= $cat";
    $res = sqlSelect($connetion, 'SELECT * FROM product WHERE category=?', 's', $cat);
    while ($rows = $res->fetch_assoc()) {
      $products[] = $rows;
    }
  }
}

?>