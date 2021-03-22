<?php
    include('../db.php');
    session_start();
    $error = '';
    if (isset($_POST['submit'])) 
    {
        if(empty($_POST["username"]) && empty($_POST["password"]))  
        {  
           echo '<script>alert("Both Fields are required")</script>';  
        }  
        else  
        {  
           $username = mysqli_real_escape_string($con, $_POST["username"]);  
           $password = mysqli_real_escape_string($con, $_POST["password"]);  
           $password = md5($password);  
           $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";  
           $result = mysqli_query($con, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                $_SESSION['login_user'] = $username;  
                header("location:../dashboard/index.php");  
           }  
           else  
           {  
                echo '<script>alert("Incorrect User Details")</script>';  
           }  
        }  
    }
?>