<!DOCTYPE html>

<?php

session_start();

if(!isset($_SESSION['email']))
{
  header("location:http://localhost/Project/Signin.html");
}



?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
</head>
<body>
<div style="height:100vh;width:99vw">


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ShortUrl</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/Project/main.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/Project/url.php">All URL's</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>  
      </ul>
    </div>
  </div>
</nav>
    <div class="container-fluid p-5 h-40 my-0 bg-primary text-white">
    <h1>URL Shortener</h1>
    <p>Here you have full control over your links.</p>
    </div>

    <div class="container-fluid p-5 my-0 bg-dark text-white mt-0 pl-10">
    <form action="main.php" method="post">
        <input type="text" class="col-sm-5 p-1 bg-white text-black" name="url" placeholder="Enter main URL">
        <input type="text" class="col-sm-3 p-1 bg-white text-black" name="text" placeholder=" Enter text you want to add in URL">
        <input type="submit" class="col-sm-2 p-1 bg-primary text-white" value="Submit">
    </form>
    </div>

    <div class="container-fluid p-5 h-50 my-0 bg-secondary text-white">
    <?php

    if(isset($_POST['url']))
    {
        
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

    $sql="insert into urls values('$encryption','$text',0,'".$_SESSION['email']."')";

    $result=mysqli_query($con,$sql);

    $decryption_iv = '1234567891011121';

    $decryption_key = "sohel";
    
    $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);


    if($result)
    {
        // header("location:/Project/main.php");
        $shortenUrl="localhost/Project/s.php?t="."$text";
        echo "<div class='panel panel-default'>
        <div class='panel-heading'>Your Shorten Url</div>
        <div class='panel-body'>$shortenUrl</div>
      </div>";

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



    }

    ?>
    </div>
    


</div>


</body>
</html>