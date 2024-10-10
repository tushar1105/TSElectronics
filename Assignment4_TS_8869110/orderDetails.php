<?php
  
  // INSERT INTO `aw_orders` (`id`, `name`, `email`, `phone`, `postcode`, `lunch`, `tickets`, `campus`, `cost_of_ticket`, `tax`, `total_cost`, `created_at`) VALUES (NULL, 'Tushar', 'tsharma@abc.com', '382-885-3642', 'N2L 3E9', 'Yes', '1', 'Waterloo', '20', '2.6', '22.6', current_timestamp());
  // db connection
  include('includes/dbConnection.php');

  if(!isset($_SESSION['username'])){
    header('Location: login.php');
    // to stop execution of the rest of the page.
    exit();
  }


  if(!empty($_GET)){
    $id = $_GET['id'];
    $sqlQuery = "SELECT * FROM `ts_orders` WHERE `id` = $id";
    $result = $db->query($sqlQuery);
    if($result->num_rows == 0):
        $output = "Sorry, no orders found";
    else:
        $orderSummary = "<h1>Order Summary</h1>";
        //user info
        while($row = $result->fetch_assoc()):
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $phone = $row['phone'];
            $postcode = $row['postcode'];
            $province = $row['province_name'];
            $email = $row['email'];
            $cardNumber = $row['card_number'];
            $cardExpiryMonth = $row['card_expiry_month'];
            $cardExpiryYear = $row['card_expiry_year'];
            $totalCartValue = $row['sub_total'];
            $provinceCode = $row['province_code'];
            $tax = $row['tax'];
            $taxPercentage = $tax * 100;
            $totalPrice = $row['order_total'];

            $personalInfo = "        
        <h3>Personal Information</h3>
        <p>Name : $firstName $lastName
        <br>Phone : $phone
        <br>Postcode : $postcode
        <br>Province/Territory : $province
        <br>Email : $email
        <br>Credit Card Number : $cardNumber
        <br>Expiry month and year : $cardExpiryMonth / $cardExpiryYear
        </p>";
        endwhile;
    endif;

    //order info
    $orderQuery = "SELECT * FROM `ts_order_details` WHERE `order_id` = $id";
    $result = $db->query($orderQuery);
    if($result->num_rows == 0):
        $output = "Sorry, no orders found";
    else:
        //order info
        $orderItemsString = '';
        while($row = $result->fetch_assoc()):
            $orderItemsString .= "<tr>";
            $orderItemsString .= "<td>" . htmlspecialchars($row['item_name']) . "</td>";
            $orderItemsString .= "<td>$" . htmlspecialchars($row['unit_price']) . "</td>";
            $orderItemsString .= "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            $orderItemsString .= "<td>$" . htmlspecialchars($row['total_price']) . "</td>";
            $orderItemsString .= "</tr>";
        endwhile;
    endif;

            $orderInfo = "
        <h3>Ordered items</h3>
            <table>
                <thead>
                    <th> Item Name </th>
                    <th> Price/Unit (CAD)</th>
                    <th> Quantity Ordered </th>
                    <th> Total Price (Price * Quantity) (CAD)</th>
                </thead>
                <tbody>
                $orderItemsString
                </tbody>
            </table>
            <p>
            Subtotal (CAD): $$totalCartValue<br><br>
            Tax (as per Province $provinceCode): $taxPercentage%<br><br>
            Order Total (in CAD after tax) : $$totalPrice<br><br>
            </p>
            ";   
   }

?>
<!DOCTYPE html>
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
        <section class = "ts-step-head" id = "orderSummary">
          <h1>Order Summary</h1>
        </section>
        <section class = "order-summary" id = 'order-summary-section'>
            <section class="ts-info-summary" id = "ts-personal-final">
            <?php 
                echo $personalInfo;
             ?>
            </section>
            <section class="ts-cart-summary" id = "ts-order-final">
            <?php 
                echo $orderInfo;
             ?>
            </section>
        </section>
        
    </main>
    <?php include('includes/footer.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="slicknav/jquery.slicknav.min.js"></script>
    <script src="js/slicknav.js"></script>
    <script src="js/index.js"></script>
</body>
</html>