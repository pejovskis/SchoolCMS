<?php 

    session_start();

    require '../connections/db-connection-homeApp.php';

    if(isset($_POST["account"]) && isset($_POST["password"])) {

        $account = $_POST["account"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $query = "INSERT INTO users(account, password) VALUES(?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $account, $password);

        if(mysqli_stmt_execute($stmt)) {
            echo "<h3>Succeeded</h3>";
        } else {
            echo "<h3>Failed</h3>";
        }
        

    }

    mysqli_close($conn);

?>