$('#orderForm').on('submit', function(e){
    e.preventDefault();
    // fetch values. 
  var phoneCaseQuantity = $("#phoneCaseQuantity").val();
  var screenProtectorQuantity = $("#screenProtectorQuantity").val();
  var headPhonesQuantity = $("#headPhonesQuantity").val();
  var firstName = $("#firstName").val();
  var lastName = $("#lastName").val();
  var phone = $("#phone").val();
  var postcode = $("#postcode").val();
  var province = $("#province").val();
  var email = $("#email").val();
  var cardNumber = $("#cardNumber").val();
  var cardExpiryMonth = $("#cardExpiryMonth").val();
  var cardExpiryYear = $("#cardExpiryYear").val();


    $.ajax({
      type: 'POST',
      url: 'orderProcess.php',
      data: {
        phoneCaseQuantity : phoneCaseQuantity,
        screenProtectorQuantity : screenProtectorQuantity,
        headPhonesQuantity : headPhonesQuantity,
        firstName : firstName,
        lastName : lastName,
        phone : phone,
        postcode : postcode,
        province : province,
        email : email,
        cardNumber : cardNumber,
        cardExpiryMonth : cardExpiryMonth,
        cardExpiryYear : cardExpiryYear
      },
      success: function(output){
          var outputObj = JSON.parse(output);
          if(outputObj['resultType'] == 'Success'){
             //console.log(outputObj);
             $('#errors').html(`${outputObj['formMessage']}`);
             $('#cartErrorCheck').html(`${outputObj['cartMessage']}`);
             $('#orderSummary').show();
             $('#order-summary-section').show();
            // set personal info
             $('#ts-personal').html(`
             <h3>Personal Information</h3>
             <p>Customer Name: ${outputObj['name']}<br>
             Phone: ${outputObj['phone']}<br>
             Email: ${outputObj['email']}<br>
             Postcode: ${outputObj['postcode']}<br>
             Province: ${outputObj['provinceName']}<br>
             Card Number: ${outputObj['cardNumber']}<br>
             Card Expiry Month/Year: ${outputObj['cardExpiryMonthYear']}<br>
             <p/>
             `);
             // set order info
             //fetch ordered items as rows.
            var finalItems = "";
            var itemArray = outputObj['orderedItems'];
            for(var i = 0; i<itemArray.length; i++){
              finalItems += `<tr>
              <td>${i+1}</td>
              <td>${itemArray[i].name}</td>
              <td>$${itemArray[i].unitPrice}</td>
              <td>${itemArray[i].quantity}</td>
              <td>$${itemArray[i].totalPrice}</td>
              </tr>`;
            }

             $('#ts-order-final').html(`
             <h3>Ordered items</h3>
             <table>
              <thead>
                <th>S.no</th>
                <th>Item name</th>
                <th>Price/Unit (CAD)</th>
                <th>Quantity Ordered</th>
                <th>Total Price (Price * Quantity) (CAD)</th>
              </thead>
              <tbody>${finalItems}</tbody>
            </table>
            <br>
            <p>
            Subtotal (CAD): $${outputObj['totalCartValue']}<br><br>
            Tax (as per Province ${outputObj['provinceCode']}): ${outputObj['taxPercentage']}%<br><br>
            Order Total (in CAD after tax) : $${outputObj['totalPrice']}<br><br>
            </p>
             `);
          }else{
            $('#errors').html(`${outputObj['formMessage']}`);
            $('#cartErrorCheck').html(`${outputObj['cartMessage']}`);
            $('#orderSummary').hide();
            $('#order-summary-section').hide();
            $('#ts-personal').html('');
            $('#ts-order-final').html('');
          }
      }
    });
  });