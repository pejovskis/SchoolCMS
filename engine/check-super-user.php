<?php
    //check super user logged in status function
    function superCheck() {
        if($_SESSION['status_level'] === 9) {
            return true;
        } else {
            return false;
        }
    }
?>