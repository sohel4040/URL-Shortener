<?php

$code=$_GET['t'];
print_r($code);

function decrypturl($en)
{
    $ciphering = "AES-128-CTR";
    
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    
    $decryption_iv = '1234567891011121';

    $decryption_key = "sohel";
    
    $decryption = openssl_decrypt($en, $ciphering, $decryption_key, $options, $decryption_iv);

    return $decryption;
}

$con=mysqli_connect("localhost","sohel","sohel@04","urlshort");

if($con)
{

    $query="select * from urls where code='$code'";

    $result=mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0)
    {
        $r=mysqli_fetch_assoc($result);
        $url=decrypturl($r['mainurl']);
        $count=(int) $r['count'];
        $count++;
        $q="update urls set count=$count where code='$code'";

        $re=mysqli_query($con,$q);

        header("location:$url");
    }
    else
    {
        echo "Something went wrong";
    }

}
else
{
    echo "Something went wrong";
}

?>