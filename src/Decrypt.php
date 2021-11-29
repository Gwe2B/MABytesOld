<?php

namespace MABytes;

/**
 * Method's description
 * @author Ragiot Hugo
 * v2 . 29/11
 * Open the json file encrypt.conf.json to recover the security key and 
 * the nonce for the encryption, then decode the encrypted password and 
 * return it.
 */

    //TODO: Adapt the $_GET['UNKNOWN'] to the form. Waiting for the form for now.

      function decryptPassword(string $cryptedPassword): string {

        $file = "encrypt.conf.json";
        if(isset($_GET['UNKNOWN'])) {
            $jsonFile = file_get_contents($file);
            $jsonDataEncryptBase64 = json_decode($jsonFile, true);
    
            foreach($jsonDataEncryptBase64 as $key => $value) {
    
                $jsonDataEncryptBase64[$key] = base64_decode($value);         
            } 
        }

        $decryptPassword = sodium_crypto_secretbox_open($cryptedPassword,
                                                        $jsonDataEncryptBase64['nonce_key'],
                                                        $jsonDataEncryptBase64['secret_key']);

        return $decryptPassword;
    }

    function decryptDatabase(string &$login, &$password): void {

        $file = "encrypt.conf.json";
        $jsonFile = file_get_contents($file);
            $jsonDataEncryptBase64 = json_decode($jsonFile, true);
    
            foreach($jsonDataEncryptBase64 as $key => $value) {
    
                $jsonDataEncryptBase64[$key] = base64_decode($value);         
            } 
        
        //Not used for now, waiting for the form
        //if(isset($_GET['UNKNOWN'])) {}
            $file = "bdd.conf.json";
            $jsonFile = file_get_contents($file);
            $jsonDataBDDBase64 = json_decode($jsonFile, true);
    
            foreach($jsonDataBDDBase64 as $key => $value) {
    
                $jsonDataBDDBase64[$key] = base64_decode($value);     
            }   
        $decryptLogin = sodium_crypto_secretbox_open($jsonDataBDDBase64['login'],
                                                     $jsonDataEncryptBase64['nonce_key'],
                                                     $jsonDataEncryptBase64['secret_key']);
                                                     
        $decryptPassword = sodium_crypto_secretbox_open($jsonDataBDDBase64['password'],
                                                        $jsonDataEncryptBase64['nonce_key'],
                                                        $jsonDataEncryptBase64['secret_key']);
         
            $login = $decryptLogin;
            $password = $decryptPassword;
        

    }
