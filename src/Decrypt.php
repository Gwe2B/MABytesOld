<?php

namespace MABytes;

/**
 * Method's description
 * @author Ragiot Hugo
 * Open the json file encrypt.conf.json to recover the security key and 
 * the nonce for the encryption, then decode the encrypted password and 
 * return it.
 */

    //TODO: Adapt the $_GET['UNKNOWN'] to the form. Waiting for the form for now.

      function decrypt(string $cryptedPassword): string {

        $file = "../encrypt.conf.json";
        if(isset($_GET['UNKNOWN'])) {
            $jsonFile = file_get_contents($file);
    
            $jsonDataBase64 = json_decode($jsonFile, true);
    
            foreach($jsonDataBase64 as $key => $value) {
    
                $jsonDataBase64[$key] = base64_decode($value);         
            } 
        }

        $decryptPassword = sodium_crypto_secretbox_open($cryptedPassword,
        $jsonDataBase64['nonce_key'],$jsonDataBase64['secret_key']);

        return $decryptPassword;
    }
 ?>
