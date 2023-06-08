<?php
// Set the default link
$link = '../../index.php';

// Check if the user is logged in and is an admin
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
  $link = '../sites/teacher-m-menu.php';
}

echo '<a class="btn bg-danger text-white" href="' . $link . '">back</a>';
?>
