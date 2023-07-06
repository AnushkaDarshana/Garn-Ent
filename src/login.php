<?php
    include '../config/db.php'; // include the connection file here

    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `g_user` WHERE email='$email' and password='$password'";
        $result = mysqli_query($conn, $sql);

        // Mysql_num_row is counting table row
        $count = mysqli_num_rows($result);

        // If result matched $email and $password, table row must be 1 row
        if($count == 1) {
            $row = mysqli_fetch_assoc($result);
            $userType = $row['userType']; // assuming you have userType column in your g_user table

            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['userType'] = $userType;

            // Redirect to specific page based on user type
            if($userType == 'admin') {
                header("location:../public/homepage.php"); // Redirect to admin dashboard
            } elseif ($userType == 'sk') {
                header("location:../public/homepage.php"); // Redirect to store dashboard
            } elseif ($userType == 'pm') {
                header("location:../public/homepage.php"); // Redirect to production dashboard
            } elseif ($userType == 'la') {
                // Default redirect if userType is unknown
                header("location:../public/homepage.php"); 
            }

        } else {
            session_start();
            $_SESSION['loginError'] = "Invalid email or password!";
            header("location:../public/index.php"); // Redirect back to login page
        }
    }
?>
