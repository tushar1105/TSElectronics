$('#userForm').on('submit', function(e){
    e.preventDefault();
    // fetch values.
    var username = $("#username").val();
    var password = $("#password").val();
    
    $.ajax({
      type: 'POST',
      url: 'createStoreManagerProcess.php',
      data: {
        username: username,
        password: password
      },
      success: function(output){
          var outputObj = JSON.parse(output);
          if(outputObj['resultType'] == 'success'){
            $('#errors').html(`User created successfully.`);
          }else{
            $('#errors').html(`Error! Username or Password cannot be empty.`);
          }
      }
    });
  });