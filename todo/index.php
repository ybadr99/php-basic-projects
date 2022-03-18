<?php
    
    $todos = [];
        
    $json = file_get_contents('todo.json');
    $todos = json_decode($json, true);

    // var_dump ($todos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
</head>
<body>
    <form action="todo.php" method="post">
        <input type="text" name="newtodo" >
        <button>submit</button>
    </form>
    <br><br>


    <?php if (isset($todos)) :  foreach ($todos as $todoName => $todo) :   ?>

    <div>
        <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : ''  ?>>
        <?php echo $todoName; ?>

        <form action="delete.php" method="POST" style="display:inline">
            <input name="todoName" type="hidden"  value="<?php echo $todoName; ?>">
            <button>Delete</button>
        </form>
        <hr>

    </div>

    <?php endforeach; endif; ?>




</body>
</html>