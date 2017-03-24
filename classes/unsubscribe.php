<?php

class UnsubscribeTemplate {

    public $company;    
    public $from;
    public $bcc;
    public $clientEmail;

    public function send_unsubscribe_request() {
        $subject = "Unsubscribe";

        $body = "<html>"
                . "<body>"
                . "<div>"
                . "<p>"
                . "Our valued customer,"
                . "</p>"
                . "<p>"
                . "You have successfully unsubscribe from our newsletter mailing list."
                . "</p>"
                . "<p>"
                . "In case you want to subscribe again, please feel free to contact us in our website."                
                . "</p>"
                . "<p>"
                . "Thank you and regards,<br/><br/>"
                . "$this->company - Administrator"
                . "</p>"
                . "</body>"
                . "</html>";

        $headers = "MIME-Version: 1.0\r\n"
                . "From: $this->company - Newsletter Subscription<$this->from>\r\n"
                . "Bcc: $this->bcc\r\n"
                . "Content-type: text/html; charset=iso-8859-1\r\n";
        
        return mail($this->clientEmail, $subject, $body, $headers);        
    }

}
