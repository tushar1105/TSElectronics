<?php
//session start
// session_start(); // now we can access $_SESSION.

// db connection.
include('includes/dbConnection.php');

if(!empty($_POST)){
    // to fix security issues SQL injection.
    // real_escape_string to skip any special charaters that may have been added by the users/hacker.
    $username = $db->real_escape_string($_POST['username']);
    $password = $db->real_escape_string($_POST['password']);

    //outputArray
    $output = [];
    if((!empty($username)) && (!empty($password))){
        //encrypted password to md5.
        $password = md5($password);
        // insert new user as manager here.
        $sqlQuery = "
        INSERT INTO `user_login` (`id`, `username`, `password`, `role`) VALUES (NULL, '$username', '$password', 'manager');
        ";
        $result = $db->query($sqlQuery);
        $output['resultType'] = 'success';
    }else{
        $output['resultType'] = 'failure';
    }
    
    $outputString = json_encode($output);
    echo $outputString;

    $db->close();

}
