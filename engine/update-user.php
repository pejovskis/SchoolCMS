<?php
require 'db-conn-users.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Check Form Submit
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $status_level = $_POST['status-level'];
        $profile_image_file = $_FILES['profile-image']['name'];
        $profile_image_tmp = $_FILES['profile-image']['tmp_name'];

        //Check if img was uploaded
        if (!empty($profile_image_tmp)) {
            $profile_image_data = file_get_contents($profile_image_tmp);
        } else {
            $profile_image_data = null;
        }

        //DB 
        $query = "UPDATE user SET first_name=?, last_name=?, email=?, status_level=?, user_photo=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssssss', $firstName, $lastName, $email, $status_level, $profile_image_data, $id);

        try {
            if ($stmt->execute()) {
                if (isset($_FILES['excercise-file']) && $_FILES['excercise-file']['error'] === UPLOAD_ERR_OK) {
                    $profile_image_file_name = $_FILES['profile-image']['name'];
                    $profile_image_file_tmp = $_FILES['profile-image']['tmp_name'];
                    //Read file content
                    $profile_image_file_data = file_get_contents($profile_image_file_tmp);
                    //Update the Image column in DB
                    $update_query = "UPDATE user SET user_photo=? WHERE id=?";
                    $update_stmt = mysqli_prepare($conn, $update_query);
                    mysqli_stmt_bind_param($update_stmt, 'si', $profile_image_file_data, $id);
                    $update_stmt->execute();
                }

                //Redirect Successfull
                echo '<script>alert("User updated successfully!");</script>';
                echo '<script>window.location.href = "../sites/user-overview.php";</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Update failed! ' . $e->getMessage() . '");</script>';
        }
        //Delete User
    } else if (isset($_POST['delete'])) {
        if (isset($_POST['id'])) {
            $userId = $_POST['id'];
            deleteUserContent($userId);
            echo '<script>alert("User deleted successfully!");</script>';
            echo '<script>window.location.href = "../sites/user-overview.php";</script>';
        } else {
            echo '<script>alert("Delete Failed!");</script>';
        }
    }
}

mysqli_close($conn);
