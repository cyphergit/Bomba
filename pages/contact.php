<div class="content-wrapper con-contact">
    <div class="col-md-11">
        <div>
            <div class="col-md-9 left-col-design">
                <h1>Contact Us</h1>
                <div class="contact-info">
                    <p>
                        <span class="title">Proprietors</span>
                        <span>Marc and Natalie Ferron</span>                        
                    </p>
                    <p>
                        <span class="title">Opening Hours</span>
<!--                        <span>(Tuesday - Thursday) 5:30pm to 10pm</span>-->
                        <span>(Tuesday - Friday) 5:00pm to 10pm</span>
<!--                        <span>(Friday) 12pm to 10pm</span>-->
                        <span>(Saturday) 5:30pm to 10pm</span>
                    </p>
                    <p>
                        <span class="title">Address &amp; Contact</span>
                        <span>(Address) <?php echo $webpage->company_address_postal(); ?></span>
                        <span>(Tel.No.) <?php echo $webpage->company_contact(); ?></span>
                    </p>
                </div>

                <div>
                    <h1>Location Map</h1>                                                            
                    <div class="google-map">
                        <iframe id="google-map" frameborder="0" scrolling="no"
                                src="<?php echo $webpage->google_map(); ?>">
                        </iframe>
                    </div>
                </div>
                <?php include 'includes/enquiry_faq_section.php' ?>
            </div>
        </div>
        <div class="col-md-3 right-col-design"></div>
    </div>
</div>