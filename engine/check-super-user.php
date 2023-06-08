<?php
    function superCheck() {
        if($_SESSION['email'] === 'superadmin@sa.com') {
            return true;
        } else {
            return false;
        }
    }
?>