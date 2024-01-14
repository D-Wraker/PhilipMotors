<?php
 session_start(); // start session
 session_destroy(); // destroy the session
 header("location:login_page.php"); // redirect to login page
?>
