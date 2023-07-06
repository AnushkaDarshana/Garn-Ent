<?php
    session_start();

    if(isset($_SESSION['loggedin'])) {
        unset($_SESSION['loggedin']); 
        unset($_SESSION['email']); 
        unset($_SESSION['userType']);
    }

    session_destroy();
    header("location:../public/index.php"); // Redirect back to login page
    exit();
?>
