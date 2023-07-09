<?php
session_start();
require '../engine/functions.php';
redirectCheckUserLogIn();
$exerciseId = $_GET['id'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEM Edit User</title>
    <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>

    <div class="div-bg">
        <div class="div-menu">
            <div class="div-title">
                <p> Edit User Id:<?php echo $row['id']; ?> </p>
            </div>
            <div class="div-buttons">
                <form method="POST" action="update-user.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="div-elements">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <label for="first-name" type="text">First Name:</label>
                            <input type="text" name="first-name" value="<?php echo $row['first_name']; ?>">
                            <label for="last-name">Last Name</label>
                            <input type="text" name="last-name" value="<?php echo $row['last_name']; ?>">
                            <label for="email">Email</label>
                            <input name="email" type="email" value="<?php echo $row['email']; ?>">
                            <label for="status-level">Status-Level</label>
                            <input name="status-level" type="text" value="<?php echo $row['status_level']; ?>">
                            <div>
                                <label for="profile-image">User Photo (.jpeg)</label>
                                <input class="file-input-field" name="profile-image" type="file" accept="image/jpeg">
                            </div>
                        </div>
                        <div class="div-cancon">
                            <a class="btn-cancel" href="../sites/user-overview.php"> cancel </a>
                            <button name="submit" type="submit" value="update" class="btn-confirm">save</button>
                            <?php btnDeleteUser(); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>