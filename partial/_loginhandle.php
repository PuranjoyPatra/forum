<?php
 if ($_SERVER['REQUEST_METHOD']=="POST") {
    include "_dbconnect.php";
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpass'];
    $sql="SELECT * FROM `users` WHERE user_email='$email'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if ($num==1) {
        $row=mysqli_fetch_assoc($result);
        if (password_verify($pass,$row['user_pass'])) {
            // echo "logged in";
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['uid']=$row['user_id'];
            $_SESSION['username']=$email;
            header("location:/forum/index.php");
            exit();
        }
    }
    header('location:/forum/index.php');
 }
 ?>