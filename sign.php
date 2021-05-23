<?php
include_once 'dbConnection.php';
ob_start();

if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $name= ucwords(strtolower($name));
    $faculty=$_POST['faculty'];
    $level=$_POST['level'];
    $dep=$_POST['dep'];
    $email=$_POST['email'];
    $password = $_POST['password'];
    $cpassword=$_POST['cpassword'];

    if($password == $cpassword){
        $cpassword = stripslashes($cpassword);
        $cpassword = addslashes($cpassword);
        $cpassword = md5($cpassword);
        
        //insert into database
        $query="INSERT INTO `user`(`name`, `faculty`, `level`, `dep`, `email`, `password`) VALUES ('$name' , '$faculty' , '$level','$dep' ,'$email', '$cpassword')";
        $result=mysqli_query($con,$query);
        if($result){
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $name;

            header("location:account.php?q=1");
            

        }
        else
{
header("location:index.php?q7=Email Already Registered!!!");
}


    }
    else
        {
        header("location:index.php?q7=Your Password Not Match!!!");
        }


}




// $q3=mysqli_query($con,"INSERT INTO user VALUES  ('$name' , '$gender' , '$college','$email' ,'$mob', '$password')");
// if($q3)
// {
// session_start();
// $_SESSION["email"] = $email;
// $_SESSION["name"] = $name;

// header("location:account.php?q=1");
// }

ob_end_flush();
?>