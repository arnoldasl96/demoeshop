<?php
require_once 'php/utils.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit;
}
else{
  $connetion = connection();
  if($connetion) {
    $res = sqlSelect($connetion, 'SELECT * FROM users WHERE id=? LIMIT 1', 'i', $_SESSION['userID']);
    if($res && $res->num_rows === 1) {
      $user = $res->fetch_assoc();
      if(!$user['isAdmin']){
        header('Location: index.php');
      }
    }
    else {
      exit;
    }
  }

}

$product = null;
if ($_GET['id']) {
  $id = $_GET['id'];
  $query = "SELECT * FROM product Where id=$id";
  $con = connection();
  $result = $con->query($query);
  if ($result) {
    $product = $result->fetch_array();
  } else {
    header("Location: index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <meta charset="UTF-8">
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/demoeshop/css/main.css">
  <link rel="stylesheet" href="/demoeshop/css/globals.css">
  <link rel="stylesheet" href="/demoeshop/css/forms.css">
  <link rel="icon" type="image/png" href="/demoeshop/icons/favicon.ico" />
  <?php
  if ($_GET['id']) {
  ?><title>Edit Product</title>
  <?php

  } else {
  ?><title>Add Product</title>
  <?php
  }
  ?>

</head>

<body>
  <header>
    <div class="text">
      <a href="mailto:arnoldas.lakacauskas@gmail.com"><i class="far fa-envelope"></i>arnoldas.lakacauskas@gmail.com</a>
      <a href="tel:+37062845788"><i class="fas fa-phone"></i>+37062845788</a>
      <a href="https://www.linkedin.com/in/arnoldaslakacauskas/"><i class="fab fa-linkedin"></i>Linkedin</a>
      <a href="https://www.facebook.com/arnoldas.lakacauskas"><i class="fab fa-facebook-square"></i>Facebook</a>

    </div>
  </header>
  <div class="main" id="app">
    <?php
    include 'navbar.php';
    ?>
    <div class="container">
      <div class="form-container">
        <form id="addProduct" enctype="multipart/form-data">
          <?php
          echo $product;
          if ($product) {
          ?>
            <h1>Edit Product</h1>
            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
          <?php
          } else {
          ?>
            <h1>Add New Product</h1>
          <?php
          }
          ?>
          <div class="errors" id="errors"></div>
          <div class="from-group">
            <label for="model">Model</label>
            <input type="text" class="input-primary" name="model" required placeholder="Model" onkeydown="if(event.key === 'Enter'){event.preventDefault();addProduct();}" <?php
                                                                                                                                                                            if ($product) {
                                                                                                                                                                              echo "value='" . $product['model'] . "'";
                                                                                                                                                                            }
                                                                                                                                                                            ?> />
          </div>
          <div class="from-group">
            <label for="category">Category</label>
            <input type="select" class="input-primary" name="category" required placeholder="Category" onkeydown="if(event.key === 'Enter'){event.preventDefault();addProduct();}" <?php
                                                                                                                                                                                    if ($product) {
                                                                                                                                                                                      echo "value='" . $product['category'] . "'";
                                                                                                                                                                                    }
                                                                                                                                                                                    ?> />
          </div>
          <div class="from-group">
            <label for="manufacturer">manufacturer</label>
            <input type="text" class="input-primary" name="manufacturer" required placeholder="Manufacturer" onkeydown="if(event.key === 'Enter'){event.preventDefault();addProduct();}" <?php
                                                                                                                                                                                          if ($product) {
                                                                                                                                                                                            echo "value='" . $product['manufacturer'] . "'";
                                                                                                                                                                                          }
                                                                                                                                                                                          ?> />
          </div>
          <div class="from-group">
            <label for="price">price</label>
            <input type="number" step='0.01' class="input-primary" name="price" required placeholder="199.99" onkeydown="if(event.key === 'Enter'){event.preventDefault();addProduct();}" <?php
                                                                                                                                                                                          if ($product) {
                                                                                                                                                                                            echo "value='" . $product['price'] . "'";
                                                                                                                                                                                          }
                                                                                                                                                                                          ?> />
          </div>
          <div class="from-group">
            <label for="description">description</label>
            <textarea rows="4" class="input-primary" cols="50" name="description" required placeholder="Description...." onkeydown="if(event.key === 'Enter'){event.preventDefault();addProduct();}"> <?php
                                                                                                                                                                                                      if ($product) {
                                                                                                                                                                                                        echo $product['description'];
                                                                                                                                                                                                      }
                                                                                                                                                                                                      ?></textarea>
          </div>
          <div class="from-group">
            <label for="instock">in stock</label>
            <input type="number" step="1" min="1" class="input-primary" name="instock" required placeholder="e.g.100" onkeydown="if(event.key === 'Enter'){event.preventDefault();addProduct();}" <?php
                                                                                                                                                                                                  if ($product) {
                                                                                                                                                                                                    echo "value='" . $product['in_stock'] . "'";
                                                                                                                                                                                                  }
                                                                                                                                                                                                  ?> />
          </div>
          <div class="from-group">
            <label for="picture">upload Picture</label>
            <input type="file" class="input-primary" name="picture" <?php
                                                                    if ($product) {
                                                                      echo "value='" . $product['picture'] . "'";
                                                                    }
                                                                    ?> />
          </div>
          <div class="from-group">
            <?php
            if ($product) {
            ?>
              <input type="button" class="btn btn-secondary" value="Update" onclick="UpdateProduct();" />
            <?php
            } else { ?><input type="button" class="btn btn-secondary" value="Add" onclick="addProduct();" />
            <?php
            }
            ?>

          </div>
        </form>
      </div>

    </div>

  </div>

  <script src="js/functions.js"></script>
</body>

</html>