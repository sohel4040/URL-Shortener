<html>
<?php

$url=$_POST['url'];
$text=$_POST['text'];


$con=mysqli_connect("localhost","sohel","sohel@04","urlshort");

if($con)
{
   
    $str = $url;

    $ciphering = "AES-128-CTR";
    
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;

    $iv = '1234567891011121';
    
    $key = "sohel";
    
    $encryption = openssl_encrypt($str, $ciphering, $key, $options, $iv);

    $sql="insert into urls values('$encryption','$text',0)";

    $result=mysqli_query($con,$sql);

    $decryption_iv = '1234567891011121';

    $decryption_key = "sohel";
    
    $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);


    if($result)
    {
        // header("location:/Project/main.php");
        $shortenUrl="localhost/Project/s.php?t="."$text";
        echo "Your Shorten Url is $shortenUrl";

    }
    else
    {
        echo "Data not inserted";
    }
}
else
{
    echo "Something went wrong";
}


?>
<body>
<form action="main.php" method="get">
    <input type="submit" value="Go to Home Page">
</form>
</body>
<html>