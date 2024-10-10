<?php
//session start
//session_start(); // now we can access $_SESSION.

// db connection.
include('includes/dbConnection.php');

if(!empty($_POST)){

    //  print_r($_POST);
    // Step: 1 -> fetch data from form.
    $phoneCaseQuantity = $_POST['phoneCaseQuantity'];
    $screenProtectorQuantity = $_POST['screenProtectorQuantity'];
    $headPhonesQuantity = $_POST['headPhonesQuantity'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $postcode = $_POST['postcode'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $cardNumber = $_POST['cardNumber'];
    $cardExpiryMonth = $_POST['cardExpiryMonth'];
    $cardExpiryYear = $_POST['cardExpiryYear'];

    //



    // per unit costs of items 
    $phoneCaseUnitPrice = 5;
    $screenProtectorUnitPrice = 7;
    $headPhonesUnitPrice = 20;    

    //    initial cart value.
        $totalCartValue = 0;
       // total cost per item -> unit price * quantity ordered.
        $phoneCaseTotalPrice = $phoneCaseUnitPrice * $phoneCaseQuantity;
        $screenProtectorTotalPrice = $screenProtectorUnitPrice * $screenProtectorQuantity;
        $headPhonesTotalPrice = $headPhonesUnitPrice * $headPhonesQuantity;

        // current cart value.
        $totalCartValue = $phoneCaseTotalPrice + $screenProtectorTotalPrice + $headPhonesTotalPrice;   

    $output = [];
    if(($totalCartValue == 0) && ((empty($firstName)) || (empty($lastName)) || (empty($phone)) || (empty($postcode)) || (empty($province)) || (empty($email)) || (empty($cardNumber)) || (empty($cardExpiryMonth)) || (empty($cardExpiryYear)))){
        $output['formMessage'] = "Error! Fields marked with (*) are mandatory.";
        $output['cartMessage'] = "Your cart is empty.";
        $output['resultType'] = "Failure";
    }elseif(($totalCartValue > 0) && ((empty($firstName)) || (empty($lastName)) || (empty($phone)) || (empty($postcode)) || (empty($province)) || (empty($email)) || (empty($cardNumber)) || (empty($cardExpiryMonth)) || (empty($cardExpiryYear)))){
        $output['formMessage'] = "Error! Fields marked with (*) are mandatory.";
        $output['cartMessage'] = "Your current cart value is: $$totalCartValue.";
        $output['resultType'] = "Failure";
    }
    else{
      // generate receipt.
      $cartMessage = "Your current cart value is: $$totalCartValue.";
      $formMessage = "Thankyou for your order! View order summary below."; 

      // final ordered items array: quanitity > 0.
     $order_Items = [];   
     // pushing ordered items as objects into the final ordered items array.
    if($phoneCaseTotalPrice > 0){
        $item1 = ["name" => "iPhone Case", "unitPrice" => $phoneCaseUnitPrice,"quantity" => $phoneCaseQuantity,"totalPrice" => $phoneCaseTotalPrice];
        array_push($order_Items,$item1);
    }
    if($screenProtectorTotalPrice > 0){
        $item2 = ["name" => "Screen Protector", "unitPrice" => $screenProtectorUnitPrice,"quantity" => $screenProtectorQuantity,"totalPrice" => $screenProtectorTotalPrice];
        array_push($order_Items,$item2);
    }
    if($headPhonesTotalPrice > 0){
        $item3 = ["name" => "Headphones", "unitPrice" => $headPhonesUnitPrice,"quantity" => $headPhonesQuantity,"totalPrice" => $headPhonesTotalPrice];
        array_push($order_Items,$item3);
    }
       
      // calculate tax based on province.
      // array to store province wise tax rates as objects with keys and values.
    $provinceWiseTaxRate = [];
    // objects representing tax rates for each province.
    // source : https://www.retailcouncil.org/resources/quick-facts/sales-tax-rates-by-province/
    $alberta = ["province" => "AB", "rate" => 0.05 ,"name" => "Alberta"];
    $britishColumbia = ["province" => "BC", "rate" => 0.12,"name" => "British Columbia"];
    $manitoba = ["province" => "MB", "rate" => 0.12,"name" => "Manitoba"];
    $newBrunswick = ["province" => "NB", "rate" => 0.15,"name" => "New Brunswick"];
    $nfl = ["province" => "NL", "rate" => 0.15,"name" => "Newfoundland and Labrador"];
    $northWestTerr = ["province" => "NT", "rate" => 0.05,"name" => "Northwest Territories"];
    $novaScotia = ["province" => "NS", "rate" => 0.15,"name" => "Nova Scotia"];
    $nunavut = ["province" => "NU", "rate" => 0.05,"name" => "Nunavut"];
    $ontario = ["province" => "ON", "rate" => 0.13,"name" => "Ontario"];
    $pei = ["province" => "PE", "rate" => 0.15,"name" => "Prince Edward Island"];
    $quebec = ["province" => "QC", "rate" => 0.149,"name" => "Quebec"];
    $saskatchewan = ["province" => "SK", "rate" => 0.11,"name" => "Saskatchewan"];
    $yukon = ["province" => "YT", "rate" => 0.05,"name" => "Yukon"];
    array_push($provinceWiseTaxRate,$alberta,$britishColumbia,$manitoba,$newBrunswick,$nfl,$northWestTerr,
    $novaScotia,$nunavut,$ontario,$pei,$quebec,$saskatchewan,$yukon);
    // tax value to be applied.
    $taxValue = 0;
    $provinceName = '';
    foreach ($provinceWiseTaxRate as $p) {
        if ($p["province"] == $province) {
            $taxValue = $p["rate"];
            $provinceName = $p["name"];
            break;
        }
    }
    // final order amount calculation.
    $taxPercentage = $taxValue * 100;
    // tax added = subtotal * tax value per province.
    $tax_added = $totalCartValue * $taxValue;
    // total price = subtotal + tax added.
    $totalPrice = $totalCartValue + $tax_added;

    // final user and order details -- Receipt.
        
    // output receipt.
    $output['name'] = "$firstName $lastName";
    $output['phone'] = $phone;
    $output['postcode'] = $postcode;
    $output['email'] = $email;
    $output['provinceName'] = $provinceName;
    $output['provinceCode'] = $province;
    $output['cardNumber'] = $cardNumber;
    $output['cardExpiryMonthYear'] = "$cardExpiryMonth/ $cardExpiryYear";
    $output['orderedItems'] = $order_Items;
    $output['totalCartValue'] = $totalCartValue;
    $output['taxPercentage'] = $taxPercentage;
    $output['totalPrice'] = $totalPrice;
    $output['formMessage'] = $formMessage;
    $output['cartMessage'] = $cartMessage;
    $output['resultType'] = "Success";

        // insert into orders table 
        $sqlQuery = "INSERT INTO `ts_orders` (`first_name`, `last_name`, `phone`, `postcode`, `province_code`, `province_name`, `email`, `card_number`, `card_expiry_month`, `card_expiry_year`, `sub_total`, `tax`, `order_total`, `id`, `created_on`) 
        VALUES ('$firstName', '$lastName', '$phone', '$postcode', '$province', '$provinceName', '$email', '$cardNumber', '$cardExpiryMonth', '$cardExpiryYear', '$totalCartValue', '$taxValue', '$totalPrice', NULL, current_timestamp())
        ";

        $db->query($sqlQuery);
        $last_id = $db->insert_id;
        // inserting the ordered items into ts_order_details table using this id from the ts_orders as the reference.
        foreach ($order_Items as $item) {
            $sqlQueryInsert = "INSERT INTO `ts_order_details` (`id`,`item_name`, `unit_price`, `total_price`, `quantity`, `order_id`) VALUES (NULL, '{$item['name']}', '{$item['unitPrice']}', '{$item['totalPrice']}', '{$item['quantity']}', '$last_id')";
            $db->query($sqlQueryInsert);
        }
        
        $db->close();

    }
    $outputString = json_encode($output);
    echo $outputString;
  }