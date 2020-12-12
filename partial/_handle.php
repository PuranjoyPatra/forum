<?php
$showerr="false";
if ($_SERVER['REQUEST_METHOD']=="POST") {
    include "_dbconnect.php";
    $useremail=$_POST['signupemail'];
    $userpass=$_POST['signuppass'];
    $usercpass=$_POST['signupcpass'];
    $existsql="SELECT * FROM `users` WHERE user_email='$useremail'";
    $result=mysqli_query($conn,$existsql);
    $num=mysqli_num_rows($result);
    if ($num>0) {
        $showerr="User email already exist";

    }
    else {
        if ($userpass==$usercpass) {
            $hash=password_hash($userpass,PASSWORD_DEFAULT);
            
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `create_date`) VALUES ('$useremail', '$hash', current_timestamp())";
            $res=mysqli_query($conn,$sql);
            // echo $res;
            if ($res) {
                $showalert=true;
                header('location:/forum/index.php?signupsuccess=true');
                exit();
            }
            
        }
        else {
            $showerr="password do not match";
            
        }
        // header("location:/forum/index.php?signupsuccess=false&error=$showerr");
    }
}
?>