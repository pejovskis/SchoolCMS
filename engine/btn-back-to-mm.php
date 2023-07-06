<?php

$link = '../../index.php';

//echo out the teacher-m-menu logout button if there is logged user, if not it stays the back btn for guest mode
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
  if($_SESSION['status_level'] === 1) {
    $link = '../sites/student-m-menu.php';  
  } else {
    $link = '../sites/teacher-m-menu.php';
  }
}

echo '<a class="btn bg-danger text-white" href="' . $link . '">back</a>';
?>
