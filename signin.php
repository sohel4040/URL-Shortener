<?php

require("decrypt.php");

session_start();

$email=$_POST['email'];
$pass=$_POST['pass'];

$_SESSION['email']=$email;

$con=mysqli_connect("localhost","sohel","sohel@04","urlshort");
    
if($con)
{
    $d=new Decrpyt();
    $p=$d->encryptstr($pass);
    $query="select * from users where email='$email'";


    $res=mysqli_query($con,$query);
    if(mysqli_num_rows($res)>0)
    {
        while($r=mysqli_fetch_assoc($res))
        {
            $p=$d->decryptstr($r['pass']);

            $e=$r['email'];
           
            if($email==$e && $pass==$p)
            {
                echo "Signin Successful";
                header("location:http://localhost/Project/main.php");

            }
            else
            {
                echo "Wrong Credentials";
                header("location:http://localhost/Project/Signin.html");
            }
        }
    }
}






?>