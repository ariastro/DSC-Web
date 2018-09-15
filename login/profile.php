<?php
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $first_name.' '.$last_name ?></title>
  <?php include 'css/css.html'; ?>
  <link rel="shortcut icon" type="image/png" href="../img/DSC.png"/>
</head>

<body>
  <div class="form">

          <h1>Welcome</h1>
          
          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>

    </div>
    
<script src='js/jquery-3.3.1.min.js'></script>
<script src="js/index.js"></script>
<?php
if ($email == "admin") {
  ?>
  <meta http-equiv="refresh" content="2; url=../home.php" />
  <?php
}
?>
</body>
</html>
