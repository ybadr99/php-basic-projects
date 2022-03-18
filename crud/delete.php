<?php

        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';
include 'partials/header.php';
require __DIR__ . '/users/users.php';


if (!isset($_POST['id'])) {
    include "partials/not_found.php";
    exit;
}


$userId = $_POST['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    deleteUser($userId);
    
    header("Location: index.php");

}

