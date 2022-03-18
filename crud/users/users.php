<?php
/**
 * User: yousef
 * Date: 23/7/2021
 * Time: 9:27 AM
 */

function getUsers()
{
    
    return json_decode(file_get_contents(__DIR__.'/users.json'),true);
    exit;
}

function getUserById($id)
{
    $users = getUsers();
    
    // return $users;
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }

   }

}

function createUser($data)
{
    $users = getUsers();

    $data['id'] = rand(10000, 20000);
    $users[] = $data;

    putJson($users);

    return $data;
}

function updateUser($data, $id)
{
    $updateuser = [];
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = $updateuser = array_merge($user, $data);
        }
    }

    putJson($users);

    return $updateuser;
}

function deleteUser($id)
{
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            array_splice($users, $i, 1);
        }
    }

    putJson($users);

}

function uploadImage($file, $user)
{   

    if (!is_dir(__DIR__.'/images')) {
        mkdir(__DIR__.'/images');
    }

    // Get the file extension from the filename
    $fileName = $file['picture']['name'];
    // Search for the dot in the filename
    $dotPosition = strpos($fileName, '.');
    // Take the substring from the dot position till the end of the string
    $extension = substr($fileName, $dotPosition + 1);


    move_uploaded_file($file['picture']['tmp_name'], __DIR__."/images/{$user['id']}.$extension");
    $user['extension'] = $extension;
    updateUser($user, $user['id']);   
}

function putJson($users)
{
    file_put_contents(__DIR__.'/users.json', json_encode($users, JSON_PRETTY_PRINT));

}

function validateUser($user, &$errors)
{
    $isvalid = true;


    if (!$user['name']) {
        $errors['name'] = REQUIRED_FILED;
        $isvalid = false;
    } 
    if (!$user['username']) {
        $errors['username'] = REQUIRED_FILED;
        $isvalid = false;
    } elseif (strlen($user['username']) < 6 || strlen($user['username']) > 16) {
        $errors['username'] = 'Username is required and it must be more than 6 and less then 16 character';
        $isvalid = false;
    }
    if (!$user['email']) {
        $errors['email'] = REQUIRED_FILED;
        $isvalid = false;
    } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'This must be a valid email address';
        $isvalid = false;
    }
    if (!$user['phone']) {
        $errors['phone'] = REQUIRED_FILED;
        $isvalid = false;

    }

    if (!$user['website']) {
        $errors['website'] = REQUIRED_FILED;
        $isvalid = false;

    }

    return $isvalid;
}
