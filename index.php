<?php 
require_once('php/functionsIndex.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <meta charset="UTF-8">
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/demoeshop/css/card.css">
  <link rel="stylesheet" href="/demoeshop/css/sidebar.css">
  <link rel="stylesheet" href="/demoeshop/css/main.css">
  <link rel="stylesheet" href="/demoeshop/css/globals.css">
  <link rel="icon" type="image/png" href="/demoeshop/icons/favicon.ico" />
  <title>Demo e shop example</title>
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
    <?php include('navbar.php'); ?>
    <div class="main-container">
      <div class="sidebar">
        <div class="header">
          Product filter
        </div>
        <div class="filter-group">
          <form method="POST" action="index.php" id="category">
            <div class="filter-group">
              <label for="categories">Categories</label>
              <select name="categories" id="categories" class="input-primary" onchange="this.form.submit();">
                <option value="null" default>All categories</option>
                <?php
                foreach ($categories as $key => $value) {
                  echo "<option value=" . $value . ">$value</option>";
                }
                ?>
              </select>
            </div>

          </form>


        </div>
      </div>
      <div class="list">
        <div class="product-filter">
        </div>
        <?php
        if (count($products) == 0) {
        ?>
          <div class="products none">
            <h1>No products yet! check later!</h1>

          </div>
        <?php
        }
        foreach ($products as $key => $value) {
        ?>
          <div class='no-decoration' onclick="window.location.href='product.php?id=<?php echo $value['id'] ?>'">
            <div class=" <?php
                          if ($value['in_stock'] == 0)
                            echo 'sold-out';
                          else {
                            echo 'product';
                          }
                          ?>">
              <div class="image-container">
                <img src="/demoeshop/uploads/<?php
                                              if (file_exists("uploads/" . $value['picture'])) {
                                                echo $value['picture'];
                                              } else {
                                                echo "placeholder-image.png";
                                              }
                                              ?>" alt="">
                <div class="price-container">
                  <span class="price"><?php echo round($value['price'], 2); ?> &euro; </span>
                  <button <?php
                          if ($value['in_stock'] == 0) {
                          ?> disabled="disabled" <?php
                                          }
                                            ?> class="btn btn-primary above" onclick="AddToCart(<?php echo $value['id'] ?>);event.stopPropagation(); ">Add To Cart</button>
                </div>
              </div>
              <div class="description">
                <div class="model">
                  <span class=""><?php echo $value['model']; ?> </span>
                </div>
                <div class="manufacturer">
                  <span class="">Manufaturer: <?php echo $value['manufacturer']; ?> </span>
                </div>
                <div class="category">
                  <span class=""> <?php echo $value['category']; ?></span>
                </div>
                <div class="instock">
                  <span class="">in stock: <?php
                                            if ($value['in_stock'] >= 1) {
                                              echo "<div class='circle-green'></div>";
                                            } else {
                                              echo " <div class='circle-red'></div>";
                                            } ?> </span>
                </div>
                <div class="about">
                  <h4>
                    Description:
                  </h4>
                  <div class="about-text">
                    <?php echo $value['description']; ?>
                  </div>
                </div>
                <?php
                if ($user['isAdmin'] == true) {
                ?>
                  <div class="admin-area">
                    <a class="btn btn-primary" href="addProduct.php?id=<?php echo $value['id'] ?> "><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger" href="php/DeleteProduct.php?id=<?php echo $value['id'] ?>"><i class="fas fa-trash"></i></a>
                  </div>
                <?php
                }
                ?>

              </div>
            </div>
          </div>

        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <script src="js/functions.js"></script>
</body>

</html>