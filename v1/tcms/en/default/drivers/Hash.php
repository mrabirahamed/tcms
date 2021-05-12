<?php

class Hash {

    public static function encrypt($data) {
      /* $encryption_key_256bit = base64_encode(openssl_random_pseudo_bytes(32));*/
      //$key = "bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU";
      // Remove the base64 encoding from our key
      $encryption_key = base64_decode(HashKEYforOPENSSL);
      // Generate an initialization vector
      $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
      // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
      $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
      // The $iv is just as important as the key for decrypting, so save it with our encrypted data
      // using a unique separator (:DefaultAppName:)
      return base64_encode($encrypted . ':' . DefaultAppName . ':' . $iv);
    }

    public static function decrypt($data) {
      /* $encryption_key_256bit = base64_encode(openssl_random_pseudo_bytes(32));*/
      //$key = "bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU";
      // Remove the base64 encoding from our key
      $encryption_key = base64_decode(HashKEYforOPENSSL);
        // To decrypt, split the encrypted data from our IV - our unique separator used was ":DefaultAppName:"
      list($encrypted_data, $iv) = explode(':' . DefaultAppName . ':', base64_decode($data), 2);
      return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

    public static function passwordENCRYPT($string) {
      // you may change these values to your own
      /*$secret_key = 'my_simple_secret_key';*/
      $secret_iv = 'my_simple_secret_iv';

      $encrypt_method = 'AES-256-CBC';
      $key = hash( 'sha256', HashKEY );
      $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

      return base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }

    public static function passwordDECRYPT($string) {
      // you may change these values to your own
      /*$secret_key = 'my_simple_secret_key';*/
      $secret_iv = 'my_simple_secret_iv';

      $encrypt_method = 'AES-256-CBC';
      $key = hash( 'sha256', HashKEY );
      $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

      return openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

}