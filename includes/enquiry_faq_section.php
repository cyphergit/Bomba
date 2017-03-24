<div class="enquiry-faq-section">
    <?php
        include 'classes/enquiry_faq_section.php';
        
        $enquiry_faq = new EnquiryFaq();
        //Enquiry
        $enquiry_faq->enquiry_url = "index.php?pg=enquiry";
        $enquiry_faq->enquiry_label = "Enquiry &amp; Reservation";
        $enquiry_faq->enquiry_alt = "Enquiry &amp; Reservation";        
        //Reservation
        $enquiry_faq->faq_url = "index.php?pg=faq";
        $enquiry_faq->faq_label = "FAQs";
        $enquiry_faq->faq_alt = "FAQs";
        //Call links
        $enquiry_faq->switch_enquiry_faq($_GET['pg']);
?>   
</div>