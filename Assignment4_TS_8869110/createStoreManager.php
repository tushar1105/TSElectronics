<?php include('includes/dbConnection.php');
if(!isset($_SESSION['username'])){
  header('Location: login.php');
  // to stop execution of the rest of the page.
  exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TS</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="slicknav/slicknav.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('includes/header.php'); ?>
<?php include('includes/menu.php'); ?>
    <main>
    <section class = "ts-step-head">
            <h1>Create new Store Manager</h1>
    </section>
    <form id = "userForm" name="userForm" method="Post" action="">
      <label>Username</label>
      <input id="username" type="text" name="username"><br />

      <label>Password</label>
      <input id="password" type="password" name="password"><br />


      <br /><br />

      <input type="submit" class = "submit-btn" value="Create Store Manager">
      <p id="errors"></p>
    </form>
    
        
    </main>
    <?php include('includes/footer.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="slicknav/jquery.slicknav.min.js"></script>
    <script src="js/slicknav.js"></script>
    <script src="js/createStoreManager.js"></script>
</body>
</html>