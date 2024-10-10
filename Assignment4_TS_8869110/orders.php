<?php

// db connection
include('includes/dbConnection.php');

if(!isset($_SESSION['username'])){
  header('Location: login.php');
  // to stop execution of the rest of the page.
  exit();
}

//select query 
$selectQuery = "SELECT * FROM `ts_orders`;";

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
      <h1>All Orders</h1>
    </section>
      <section class = "ts-cart">
      <table class="ordersTable">
        <thead>
          <tr>
          <!-- for table to be accessible, add scope column for headings and scope row in atleast one row. -->
          <th scope = "column">Order Number</th>
          <th scope = "column">Customer Name</th>
          <th scope = "column">Customer Email</th>
          <th scope = "column">Order Amount (CAD)</th>
          <th scope = "column">Order Details</th>
          </tr>
      </thead>
      <tbody>
        <?php
         if($result->num_rows == 0):
          echo 'Sorry, no orders found';
         else:
            while($row = $result->fetch_assoc()):
          ?>
            <tr>
            <td scope = "row"><?php echo $row['id']?></td>
            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
            <td><?php echo $row['email']?></td>
            <td>$<?php echo $row['order_total']?></td>
            <td>
              <a href = "orderDetails.php?id=<?php echo $row['id']?>">Details</a>
            </td>
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