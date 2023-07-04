<?php
    //check super user logged in status function
    function superCheck() {
        if($_SESSION['email'] === 'superadmin@sa.com') {
            return true;
        } else {
            return false;
        }
    }
?>