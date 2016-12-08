<?php

class email {

    function generateToken($length) {
       
        $characters = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOASDFGHJKLZXCVBNM1234567890";        
        $charactersLength = strlen($characters);       
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            
            $token .= $characters[rand(0, $charactersLength-1)];            
        }
        return $token;
    }

    function resetPasswordTemplate() {
        
        $file = fopen("resetPassword.html", "r") or die("Unable to open file");        
        $template = fread($file, filesize("resetPassword.html"));            
        fclose($file);        
        return $template;
    }

    function confirmationTemplate() {
        
        $file = fopen("emailConfirmation.html", "r") or die("Unable to open file");
        
        $template = fread($file, filesize("emailConfirmation.html"));
        
        
        fclose($file);
        
        return $template;
    }    
    
    function sendEmail($details) {
        
        $subject = $details["subject"];
        $to = $details["to"];
        $fromName = $details["fromName"];
        $fromEmail = $details["fromEmail"];
        $body = $details["body"];
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;content=UTF-8" . "\r\n";
        $headers .= "From: " . $fromName . "<" . $fromEmail . ">" . "\r\n"; // from <ahmetsafasezgin@gmail.com>            
        mail($to, $subject, $body, $headers);                
    }    
}

?>