<?php

class Settings {

    public function default_settings() {
        $defaults = array(
            "company_info" => array(
                "company" => "Bomba Stuzzichini e Aperitivi",
                "website" => "http://www.bombarestaurant.com.au",                
                "date_created" => 2012,
                "address" => "176 Burgundy St. Heidelberg",
                "contact_no" => "(03) 9455 1519",
                "fax_no" => "",
                "postal_code" => "3084",
                "email_admin" => "admin@bombarestaurant.com.au",                
                "email_enquiry" => "info@bombarestaurant.com.au",
                "email_no_reply" => "no-reply@bombarestaurant.com.au",
                "email_newsletter" => "newsletter@bombarestaurant.com.au",
                "link_unsubscribe" => "index.php?pg=unsubscribe"
            ),
            "development" => array(
                "domain" => "bombarestaurant.com.au",
                "prod" => $_SERVER['SERVER_NAME'],
                "local" => "localhost/Bomba_v2",
            ),
            "database" => array(
                "local" => array(
                    "host" => "localhost",
                    "db_name" => "Bomba",
                    "user" => "root",
                    "password" => "sa"
                ),
                "prod" => array(
                    "host" => "localhost",
                    "db_name" => "bobo9353_bomba",
                    "user" => "bobo9353_admin",
                    "password" => "p@ssw0rd"
                ),
            ),
            "security" => array(
                "key" => "bomba"
            ),
            "directories" => array(
                "files" => "downloadables",
                "articles" => "image_articles",
                "images" => "image_products"
            ),
            "stylesheets" => array(
                "top" => array(
                    "http://fonts.googleapis.com/css?family=Great+Vibes|Bad+Script|Open+Sans|Marck+Script|Quicksand:400,700|Josefin+Sans:600",
                    "scripts/bootstrap/css/bootstrap.min.css",
                    "scripts/jquery-ui/jquery-ui.min.css",                    
                    "styles/Bomba.css"
                ),
                "bottom" => array()
            ),
            "scripts" => array(
                "top" => array(                    
                    "scripts/jquery-1.11.3.min.js",
                    "scripts/galleria/galleria-1.4.2.min.js",                    
                ),
                "bottom" => array(
                    "scripts/bootstrap/js/bootstrap.min.js",
                    "scripts/jquery-ui/jquery-ui.min.js",
                    "scripts/cypherdesign.js",
                    "scripts/bomba.js",
                    "modules/bomba.enquiry.js",
                    "modules/bomba.unsubscribe.js"
                )
            ),
            "social_media" => array(
                "facebook_url" => "http://www.facebook.com/pages/Bomba-Stuzzichini-e-Aperitivi/217499474973747?ref=ts&fref=ts",
                "twitter_url" => "https://twitter.com/BombaStuzzi",
                "instagram_url" => "",
                "linkedin_url" => "",
                "youtube_url" => "",
                "googleplus_url" => ""
            ),
            "google_map" => array(
                "url" => "http://maps.google.com.ph/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Burgundy+St.+Heidelberg&amp;aq=&amp;sll=-37.755883,145.064116&amp;sspn=0.009772,0.026157&amp;gl=ph&amp;ie=UTF8&amp;hq=&amp;hnear=Burgundy+St,+Heidelberg+Victoria+3084,+Australia&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"
            ),
            "others" => array(
                "restaurant_menu" => array()
            ),
            "notifs" => array(
                "sending_error" => "There is an error encountered sending your request. Please try again.",
                "sending_success" => "Your message was sent successfully. Please give us an ample time to give you a feedback regarding your concern as soon as possible. Thank you.",
                "captcha_mismatched" => "There is an error encountered: Captcha code did not match. Please try again.",
                "sending_unsubscribe" => "You have successfully unsubscribe. Please check your inbox for further details."
            )
        );
        return $defaults;
    }

}
