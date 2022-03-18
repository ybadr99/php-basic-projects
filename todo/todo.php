<?php




    $newtodo = $_POST['newtodo'] ?? '';

    if($newtodo){



        $json = file_get_contents('todo.json');
        $jsonArray = json_decode($json, true);

        $jsonArray[$newtodo]  = ['completed'=>false];   

        // var_dump($jsonArray);
        file_put_contents('todo.json',json_encode($jsonArray, JSON_PRETTY_PRINT));

        header('location:index.php');
        
    }











