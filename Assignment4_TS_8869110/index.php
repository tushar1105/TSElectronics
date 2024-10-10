<?php include('includes/dbConnection.php');
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
    <form id="orderForm" method="Post" action="">   
    <section class = "ts-step-head">
            <h1>Step - 1 : Add Products to cart. </h1>
        </section>
        <section class = "user-cart">
            <section class = "ts-cart">
                <table id='itemsTable'>
                    <thead>
                        <th> S.no </th>
                        <th> Item Picture </th>
                        <th> Name </th>
                        <th> Price/Unit (CAD) </th>
                        <th> Quantity </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td><img src = 'images/phone_case.jpg' width = '200' height = '100' alt = 'phone_case'></td>
                            <td>iPhone Case</td>
                            <td>$5</td>
                            <td><label for = "phoneCaseQuantity">Quantity</label><br><input type="text" id = "phoneCaseQuantity" name="phoneCaseQuantity" placeholder = "0"
                            <?php 
          if(isset($phoneCaseQuantity)){
            echo "value = $phoneCaseQuantity";
          }else{
            echo "value = 0";
          }
          ?>
          >
        <br />
        <span class = "errors">
          <?php 
            if(isset($phoneCaseQuantityError)){
              echo $phoneCaseQuantityError . "<br>";
              }
          ?>
        </span>
                        </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td><img src = 'images/screen_protector.jpg' width = '200' height = '100' alt = 'screen_protector'></td>
                            <td>Screen Protector</td>
                            <td>$7</td>
                            <td><label for = "screenProtectorQuantity">Quantity</label><br><input type="text" id = "screenProtectorQuantity" name="screenProtectorQuantity" placeholder = "0"
                            <?php 
          if(isset($screenProtectorQuantity)){
            echo "value = $screenProtectorQuantity";
          }else{
            echo "value = 0";
          }
          ?>
          ><br />
                            <span class = "errors">
          <?php 
            if(isset($screenProtectorQuantityError)){
              echo $screenProtectorQuantityError . "<br>";
              }
          ?>
        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td><img src = 'images/headphones.jpg' width = '200' height = '100' alt = 'headphones'></td>
                            <td>Headphones</td>
                            <td>$20</td>
                            <td><label for = "headPhonesQuantity">Quantity</label><br><input type="text" id = "headPhonesQuantity" name="headPhonesQuantity" placeholder = "0"
                            <?php 
          if(isset($headPhonesQuantity)){
            echo "value = $headPhonesQuantity";
          }else{
            echo "value = 0";
          }
          ?>
          ><br />
                            <span class = "errors">
          <?php 
            if(isset($headPhonesQuantityError)){
              echo $headPhonesQuantityError . "<br>";
              }
          ?>
        </span>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class = "ts-cart-status">
                <p id="cartErrorCheck" class = "error">Your cart is empty.
                </p>
            </section>
        </section>
        <section class = "ts-step-head" id = "personalInfoHead">
            <h1>Step - 2 : Enter Personal Information. </h1>
        </section>
        <span class = "errors">
          Note: Fields marked with (*) are mandatory.
        </span><br><br>
        <section class="user-info">
            <section class="ts-info" id="personalInfo">
                    
                        <label for="firstName">First Name<span class = "errors">*</span></label>
                        <input id="firstName" placeholder="First Name" class="textInput" type="text" name="firstName"><br />
            
                        <label for="lastName">Last Name<span class = "errors">*</span></label>
                        <input id="lastName" placeholder="Last Name" class="textInput" type="text" name="lastName"><br />

                        <label for="phone">Phone<span class = "errors">*</span></label>
                        <input id="phone" placeholder="123-123-1234" class="textInput" type="phone" name="phone"><br />
                        <span class = "errors">

                        <label for="postcode">Post Code<span class = "errors">*</span></label>
                        <input id="postcode" placeholder="X9X 9X9" class="textInput" type="postcode" name="postcode"><br />
                        
                        <label for="province">Province/Territory<span class = "errors">*</span></label>
                        <select name="province" id="province" class="textInput">
                        <option value="0">----- Select -----</option>
            <option value="AB">Alberta</option>
            <option value="BC">British Columbia</option>
            <option value="MB">Manitoba</option>
            <option value="NB">New Brunswick</option>
            <option value="NL">Newfoundland and Labrador</option>
            <option value="NT">Northwest Territories</option>
            <option value="NS">Nova Scotia</option>
            <option value="NU">Nunavut</option>
            <option value="ON">Ontario</option>
            <option value="PE">Prince Edward Island</option>
            <option value="QC">Quebec</option>
            <option value="SK">Saskatchewan</option>
            <option value="YT">Yukon</option>
                        </select><br />

                        <label for="email">Email<span class = "errors">*</span></label>
                        <input id="email" placeholder="email@domain.com" class="textInput" type="email" name="email"><br />
                        
                        <label for="cardNumber">Credit Card Number<span class = "errors">*</span></label>
                        <input id="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx" class="textInput" type="text" name="cardNumber"><br />
            
                        <label for="cardExpiryMonth">Expiry Month<span class = "errors">*</span></label>
                        <input id="cardExpiryMonth" placeholder="MMM" class="textInput" type="text" name="cardExpiryMonth"
                        ><br />
                       
            
                        <label for="cardExpiryYear">Expiry Year<span class = "errors">*</span></label>
                        <input id="cardExpiryYear" placeholder="yyyy" class="textInput" type="text" name="cardExpiryYear"
                       ><br />
                        

                        <br /><br />
                        <input type="submit" value="Place Order" id = "submitButton" class = 'submit-btn'>
            </section>
        </section>
        <section class="ts-error">
            <p id="errors" class = "errors">
            </p>
        </section>
        </form>
        <section class = "ts-step-head" id = "orderSummary" style = "display:none">
          <h1>Order Summary</h1>
        </section>
        <section class = "order-summary" id = "order-summary-section" style = "display:none">
            <section class="ts-info-summary" id = "ts-personal-final">
              <p id = "ts-personal"></p>
            </section>
            <section class="ts-cart-summary" id = "ts-order-final">
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