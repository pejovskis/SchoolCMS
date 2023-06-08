<?php 
    
    require "../connections/db-conn-bmusers.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $statusIn = $_POST['status'];
        $status = 0;

        switch($statusIn) {
            case "admin":
                $status = 1;
                break;
            case "teacher":
                $status = 2;
                break;
            case "student":
                $status = 3;
                break;
        }

        $query = "INSERT INTO users (email, password, status) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $email, $password, $status);

        if(mysqli_stmt_execute($stmt)) {
            echo "SUCCESSFULL";
        } else {
            echo "FAILED";
        }

    }

    mysqli_close($conn);

?>