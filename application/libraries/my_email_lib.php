<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class My_email_lib{

    function mail_file($to, $from, $subject, $body, $file){
        $boundary=md5(rand());
        $headers = array(
            'MIME-Version: 1.0',
            "Content-Type: multipart/mixed; boundary=\"{$boundary}\"",
            "From: {$from}"
        );
        $message = array(
            "-- {$boundary}",
            'Content-Type: text/plain',
            'Content-Transfer-Encoding: 7bit',
            '',
            chunk_split($body),
            "---{$boundary}",
            "Content-Type: {$file['type']}; name=\"{$file['name']}\"",
            "Content-Disposition: attachment; filename=\"{$file['name']}\"",
            "Content-Transfer-Encoding: base64",
            '',
            chunk_split(base64_encode(file_get_contents($file['tmp_name']))),
            "--- {$boundary}--"
        );
        mail($to, $subject, implode("\r\n", $message), implode("\r\n", $headers));
    }

    function html_email($to,$from='noreply@mycollege.goendeavor.com',$subject='My College',$body){
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: '.$to. "\r\n";
        $headers .= 'From: My College <'.$from.'>' . "\r\n";
        $headers .= 'Cc: ' . "\r\n";
        $headers .= 'Bcc: ' . "\r\n";
        mail($to, $subject,  $body, $headers);
    }

}
?>
