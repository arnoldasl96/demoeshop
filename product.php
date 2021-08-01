<?php
require_once 'php/utils.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
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
    <link rel="stylesheet" href="/demoeshop/css/product.css">
    <link rel="stylesheet" href="/demoeshop/css/main.css">
    <link rel="stylesheet" href="/demoeshop/css/globals.css">
    <link rel="icon" type="image/png" href="/demoeshop/icons/favicon.ico" />
    <title><?php echo $product['model']; ?></title>
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
        <div class="product-container">
            <div class="product">
            <div class="model">
                <span class=""><?php echo $product['model']; ?> </span>
            </div>
                <div class="image-container">
                    <img src="/demoeshop/uploads/<?php
                                                    if (file_exists("uploads/" . $product['picture'])) {
                                                        echo $product['picture'];
                                                    } else {
                                                        echo "placeholder-image.png";
                                                    }
                                                    ?>" alt="">
                    <div class="price-container">
                        <span class="price"><?php echo round($product['price'], 2); ?> &euro; </span>
                        <button class="btn btn-primary">Add To Cart</button>
                    </div>
                </div>
                <div class="description">

                    <div class="manufacturer">
                        <span class="">Manufaturer: <?php echo $product['manufacturer']; ?> </span>
                    </div>
                    <div class="category">
                        <span class=""> Category: <?php echo $product['category']; ?></span>
                    </div>
                    <div class="instock">
                        <span class="">in stock: <?php
                                                    if ($product['in_stock'] >= 1) {
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
                            <?php echo $product['description']; ?>
                        </div>
                    </div>
                    <?php
                    if ($user['isAdmin'] == true) {
                    ?>
                        <div class="admin-area">
                            <a class="btn btn-primary" href="addProduct.php?id=<?php echo $product['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger" href="php/DeleteProduct.php?id=<?php echo $product['id'] ?>"><i class="fas fa-trash"></i></a>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            </a>
        </div>
    </div>
</body>

</html>