<?php
include 'partials/header.php';
require __DIR__ . '/users/users.php';

define("REQUIRED_FILED", 'this field is required');

$user = [
    'id' => '',
    'name' => '',
    'username' => '',
    'email' => '',
    'phone' => '',
    'website' => '',
];

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

        $user = createUser($_POST);
        isset($_FILES) ? uploadImage($_FILES, $user) : '';
    
        header('location:index.php');
    }



}


?>

<?php include '_form.php' ?>

