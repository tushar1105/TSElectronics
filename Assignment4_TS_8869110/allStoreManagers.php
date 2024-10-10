<?php

// db connection
include('includes/dbConnection.php');

if(!isset($_SESSION['username'])){
  header('Location: login.php');
  // to stop execution of the rest of the page.
  exit();
}

//select query 
$selectQuery = "SELECT * FROM `user_login` WHERE `role` = 'Manager' ;";

//execute query.
$result = $db->query($selectQuery);
//print_r($result);

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
      <h1 id = "userInfo"></h1>
    </section>
    <section class = "ts-step-head">
      <h1>All Store Managers</h1>
    </section>
      <section class = "ts-cart">
      <table class="ordersTable">
        <thead>
          <tr>
          <!-- for table to be accessible, add scope column for headings and scope row in atleast one row. -->
          <th scope = "column">Username</th>
          <th scope = "column">Role</th>
          </tr>
      </thead>
      <tbody>
        <?php
         if($result->num_rows == 0):
          echo 'Sorry, no users found';
         else:
            while($row = $result->fetch_assoc()):
          ?>
            <tr>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['role']?></td>
          </tr>
          <?php
          endwhile;
         endif;
        ?>
      </tbody>
    </table>
  </section>
    
    </main>
    <?php include('includes/footer.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="slicknav/jquery.slicknav.min.js"></script>
    <script src="js/slicknav.js"></script>
    <script src="js/orders.js"></script>
</body>
</html>