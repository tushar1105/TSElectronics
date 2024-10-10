<?php
session_start();
$response = array(
    'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
    'role' => isset($_SESSION['role']) ? $_SESSION['role'] : null
);
echo json_encode($response);
