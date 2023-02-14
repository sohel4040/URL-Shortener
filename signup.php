<?php

require("decrypt.php");
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$repass=$_POST['repass'];

if($pass==$repass)
{

    $con=mysqli_connect("localhost","sohel","sohel@04","urlshort");
    
    if($con)
    {
        $d=new Decrpyt();
        $p=$d->encryptstr($pass);
        $query="insert into users values('$name','$email','$p')";
    
        $res=mysqli_query($con,$query);
        if($res)
        {
            echo "Registered Succesfully";
            header("location:http://localhost/Project/Signin.html");
        }
    }
}
else
{
    header("location:http://localhost/Project/Signup.html");
}


?>