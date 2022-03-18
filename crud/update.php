<?php

    require __DIR__ . '/users/users.php';
    require 'partials/header.php';
    define("REQUIRED_FILED", 'this field is required');


    if (!isset($_GET['id'])) {
        include "partials/not_found.php";
        exit;
    }
    $userId = $_GET['id'];

    $user = getUserById($userId);
    

    
    $errors = [
        'name' => '',
        'username' => '',
        'email' => '',
        'phone' => '',
        'website' => '',
    ];
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $user = array_merge($user, $_POST);

        $isvalid = validateUser($user, $errors);

        
        if($isvalid){
            $user = updateUser($_POST, $userId);
            
            isset($_FILES) ? uploadImage($_FILES, $user) : '' ;

            header('location:index.php');
            
        }

    }

?>

<?php  include '_form.php'; ?>
