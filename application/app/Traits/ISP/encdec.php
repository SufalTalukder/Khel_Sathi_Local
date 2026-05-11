<?php



function encryptString($plaintext, $password){
	$salt = "0000000011111111";
$bytes = array('0','0','0','0','0','0','0','0','1', '1','1', '1','1', '1','1', '1');
$iv = implode(array_map("chr", $bytes));

$iterations = 1000;
$keyLength = 32;
$prepared_key = openssl_pbkdf2($password, $salt, $keyLength, $iterations, "sha512");
$ciphertext_b64 = base64_encode(openssl_encrypt($plaintext,"AES-256-CBC",$prepared_key,OPENSSL_RAW_DATA, $iv));
return $ciphertext_b64;

	
}


function decryptString($ciphertext_b64, $password){
	$salt = "0000000011111111";
$bytes = array('0','0','0','0','0','0','0','0','1', '1','1', '1','1', '1','1', '1');
$iv = implode(array_map("chr", $bytes));

$iterations = 1000;
$keyLength = 32;
$prepared_key = openssl_pbkdf2($password, $salt, $keyLength, $iterations, "sha512");
$pt = openssl_decrypt(base64_decode($ciphertext_b64),"AES-256-CBC",$prepared_key,OPENSSL_RAW_DATA, $iv);
//echo $pt::class;
//return serialize($pt);
return $pt;

}

?> 