<?php
class EnquiryFaq {
    
    public $enquiry_label;
    public $enquiry_url;
    public $enquiry_alt;
    
    public $faq_label;
    public $faq_url;
    public $faq_alt;
    
    public function link($url, $alt, $label) {
        $link_html = "<a href='$url' alt='$alt'>$label</a>";
        echo $link_html;
    }
    
    private function enquiry_link() {
        $link_html = "<a href='$this->enquiry_url' alt='$this->enquiry_alt'>$this->enquiry_label</a>";
        echo $link_html;
    }
    
    private function faq_link() {
        $link_html = "<a href='$this->faq_url' alt='$this->faq_alt'>$this->faq_label</a>";
        echo $link_html;
    }
    
    public function switch_enquiry_faq($page) {
        switch($page) {
            case "faq":
                $this->enquiry_link();                
                break;
            case "enquiry":
                $this->faq_link();                
                break;
            default:
                $this->enquiry_link();                
                $this->faq_link();
        }
    }
}

