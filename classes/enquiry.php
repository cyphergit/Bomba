<?php

class EnquiryTemplate {
    
    public $company;    
    public $replyTo;
    public $ccTo;
    public $sendTo;
    public $subject;    
    public $withReservation;    
    public $clientFname;
    public $clientLname;
    public $clientEmail;
    public $clientContact;
    public $clientMessage;
    public $reservationDate;
    public $reservationTime;    
    public $numberOfGuest;    
    public $isSubcribed;
    public $unsubscribeLink;
    
    private function client_fullname() {
        $fullname = $this->clientFname. " " .$this->clientLname;
        return $fullname;
    }
    
    private function with_reservation() {
        if (!$this->withReservation) {
            return false;            
        } else {
            return true;
        }
    }
    
    private function reservation_details() {
        $body = "<p>"
                . "<strong>Reservation Date: </strong> <em>$this->reservationDate</em><br/>"
                . "<strong>Time: </strong> <em>$this->reservationTime</em><br/>"
                . "<strong>Number of Guest: </strong> <em>$this->numberOfGuest pax</em><br/>"
                . "</p>";
        
        return $body;
    }
    
    private function email_subject() {
        $from = $this->company. ' - ' . $this->subject;
        return $from;
    }
    
    public function unsubscribe_link($website, $page) {
        $link = $website."/".$page;
        return $link;
    }
    
    public function client_subscribe() {
        if ($this->isSubcribed == "Yes") {
            return true;
        } else {
            return false;
        }
    }
    
    public function send_enquiry() {
        $clientName = $this->client_fullname();
        
        $body = "<html>"
                . "<body>"
                . "<div>"
                . "<h2>$this->company - $this->subject</h2>"
                . "<h3>Customer Information</h3>"
                . "<p>"
                . "<strong>Name: </strong> <em>$clientName</em><br/>"
                . "<strong>E-mail:</strong> <em>$this->clientEmail</em><br/>"
                . "<strong>Contact No.:</strong> <em>$this->clientContact</em><br/>"
                . "<strong>Newsletter Subscription:</strong> <em>$this->isSubcribed</em>"
                . "</p>"
                . "<p>"
                . "<strong>Subject:</strong> <em>$this->subject</em>"
                . "</p>";

        if ($this->with_reservation()) { $body .= $this->reservation_details(); }

        $body .= "<p>"
                . "<strong>Message/Content:</strong>"
                . "</p>"
                . "<p>"
                . "<em>$this->clientMessage</em>"
                . "</p>"
                . "</div>"
                . "</body>"
                . "</html>";
        
        $headers = "MIME-Version: 1.0\r\n"
                . "From: $this->company<$this->clientEmail>\r\n"
                . "Cc: $this->ccTo\r\n"
                . "Content-type: text/html; charset=iso-8859-1\r\n";
        
        return mail($this->sendTo, $this->email_subject(), $body, $headers);        
    }
    
    public function notify_admin($to, $bcc, $from) {
        $subject = "New Member Notice";
        
        $body = "<html>"
                . "<body>"
                . "<div>"
                . "<h2>$this->company - New Mailing Member</h2>"
                . "<p>"
                . "Dear Administrator,"
                . "</p>"
                . "<p>"
                . "New member ($this->clientEmail) has been added to the company newsletter mailing list."
                . "To see the added member/s, please login to the administrative section of the website."
                . "</p>"
                . "<p>"
                . "Thank you and regards,<br/><br/>"
                . "$this->company - Administrator"
                . "</p>"
                . "</div>"
                . "</body>"
                . "</html>";
        
        $headers = "MIME-Version: 1.0\r\n"
                . "From: $this->company - Newsletter Subscription<$from\r\n"
                . "Bcc: $bcc\r\n"
                . "Content-type: text/html; charset=iso-8859-1\r\n";
        
        mail($to, $subject, $body, $headers);
    }
    
    public function notify_client($from, $bcc) {
        $subject = "Newsletter Subscription";
        $client_name = $this->client_fullname();
        
        $body = "<html>"
                . "<body>"
                . "<div>"
                . "<h2>$this->company - Newsletter Subscription</h2>"
                . "<p>"
                . "Hello $client_name,"
                . "</p>"
                . "<p/>"
                . "You have successfully subscribed to receive our newsletter using our Online Enquiry form. "
                . "</p>"
                . "<p>"
                . "From now on, we will keep you posted from any updates, promos, and events the will happen in $this->company. "
                . "If by any case you would like to unsubscibe from our newsletter, just click <strong><a href='$this->unsubscribeLink' target='_blank'>here</a></strong>."
                . "</p>"
                . "<p>"
                . "Thank you and regards,<br/><br/>"
                . "$this->company - Administrator"
                . "</p>"
                . "</div>"
                . "</body"
                . "</html>";

        $headers = "MIME-Version: 1.0\r\n"
                . "From: $this->company - Newsletter Subscription<$from>\r\n"
                . "Bcc: $bcc\r\n"
                . "Content-type: text/html; charset=iso-8859-1\r\n";     
        
        mail($this->clientEmail, $subject, $body, $headers);
    }    
}