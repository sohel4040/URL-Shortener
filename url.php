<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<ul class="list-group">
   <?php
    session_start();
   
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
    $sql="select * from urls where email='".$_SESSION['email']."'";
    $result=mysqli_query($con,$sql);

    if(mysqli_num_rows($result)>0)
    {
        while($r=mysqli_fetch_assoc($result))
        {
            $url=decrypturl($r['mainurl']);
            // $u="localhost/Project/s.php?t=";
            $code=$r['code'];
            $u="<li class='list-group-item mt-10'><a href='$url'>$code</a>". $r['code']."</li>";
            echo $u;

        }
    }
}
   
   
   ?>
  </ul>
</body>

</html>