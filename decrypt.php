<?php

class Decrpyt
{
    public function decryptstr($en)
    {
        $ciphering = "AES-128-CTR";
        
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options   = 0;
        
        $decryption_iv = '1234567891011121';
    
        $decryption_key = "sohel";
        
        $decryption = openssl_decrypt($en, $ciphering, $decryption_key, $options, $decryption_iv);
    
        return $decryption;
    }
    
    public function encryptstr($url)
    {
        $str = $url;

        $ciphering = "AES-128-CTR";
        
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options   = 0;
    
        $iv = '1234567891011121';
        
        $key = "sohel";
        
        $encryption = openssl_encrypt($str, $ciphering, $key, $options, $iv);
        return $encryption;
    }
    
}

?>