<?php
    require 'users/users.php';
    
    $users = getUsers();
    
    require 'partials/header.php';

?>


<div class="container mt-3">
    <p>
        <a class="btn btn-success" href="create.php">Create new User</a>
    </p>

    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Website</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php if (isset($users)) :   foreach ($users as $key => $user) : ?>
            <tr>

                <td>
                    <?php if (isset($user['extension'])): ?>
                        <img style="width: 60px" src="<?php echo "users/images/${user['id']}.${user['extension']}" ?>" alt="">
                    <?php endif; ?>
                </td>

                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['phone'] ?></td>
                <td>
                    <a target="_blank" href="http://">
                        <?php echo $user['website'] ?>
                    </a>
                </td>
                <td style="display:flex">
                    <a href="view.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-info mr-1">View</a>
                    <a href="update.php?id=<?php echo $user['id']; ?>"
                       class="btn btn-sm btn-outline-secondary">Update</a>
                    <form method="POST" action="delete.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button class="btn btn-sm btn-outline-danger ml-1">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; endif;?>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php' ?>

