<?php
  session_start();
  require_once 'php/utils.php';
  $cartcount=0;
  $user = [];
  if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']==true){
    $connetion = connection();
    if($connetion) {
      $res = sqlSelect($connetion, 'SELECT * FROM users WHERE id=? LIMIT 1', 'i', $_SESSION['userID']);
      if($res && $res->num_rows === 1) {
        $user = $res->fetch_assoc();
      }
      else {
        exit;
      }
    }
  }
  if(isset($_SESSION['Products'])){
    $cartcount =count($_SESSION['Products']);
  }
  else{
    $cartcount = 0;
  }
?>
<head>
  
<link rel="stylesheet" href="/demoeshop/css/navbar.css">
</head>
<div class="nav-bar">
      <div class="branding"><a href="/demoeshop"><img src="/demoeshop/icons/balticode.png"></a></div>
        <ul  class="nav-list">
          <li class="nav-item"><a href="/demoeshop">Home</a></li>
          <li class="nav-item"><a href="/demoeshop/about.php">About Creator</a></li>
        </ul>
          <ul  class="side">
            <li class="nav-side"><a href="#"><i class="fas fa-shopping-cart"></i><span class='badge' id='counter'><?php echo $cartcount?> </span></a></li>
            <?php
              if($user['isAdmin']==true){
                ?>
                <li class="nav-side"><button class="btn btn-primary"  onclick="location.href='addProduct.php'">Add Product</button></li>
                <?php
              }
              if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']==true){
                echo "<li class='nav-side'>Hello, ".$user['firstname']."</li>";
                ?>
                <li class="nav-side"><button class="btn btn-primary"  onclick="location.href='php/logout.php'">logout</button></li>
                <?php
              }
              else{
                ?>
                <li class="nav-side"><button class="btn btn-primary"  onclick="location.href='login.php'">Login</button></li>
                <li class="nav-side"><button class="btn btn-primary"  onclick="location.href='register.php'" >Register</button></li>
                <?php
              }
            ?>
          </ul>
    </div>