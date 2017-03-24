<?php

include 'config/config.php';

class Page {

    private function config() {
        $config = new Config();
        return $config;
    }

    public function company_name() {
        $page = $this->config();
        return $page->company_name();
    }

    public function company_contact() {
        $page = $this->config();
        return $page->company_contact();
    }

    public function company_address() {
        $page = $this->config();
        return $page->company_address();
    }

    public function company_postal() {
        $page = $this->config();
        return $page->company_postcode();
    }

    public function company_website() {
        $page = $this->config();
        return $page->company_website();
    }

    public function company_enquiry_mail() {
        $page = $this->config();
        return $page->enquiry_email();
    }

    public function company_address_postal() {
        $page = $this->config();
        $postal = $page->company_postcode();
        $address = $page->company_address();

        return $address . ", " . $postal;
    }

    public function google_map() {
        $page = $this->config();
        return $page->google_map();
    }

    public function page_secure() {
        header("X-XSS-Protection: 1");
        header("X-Frame-Options: SAMEORIGIN");
        header("X-Content-Type-Options: nosniff ");
        header("Content-Security-Policy: "
                . "style-src 'self' 'unsafe-inline' http://fonts.googleapis.com/;"
                . "script-src 'self' 'unsafe-inline' 'unsafe-eval';"
                . "child-src: 'self';");
    }

    public function page_secure_session() {
        return $_SESSION['6_letters_code'];
    }

    private $spacer = array("_");

    public function page_name() {
        $spacer = $this->spacer;
        $page_name = $_GET["pg"];

        $trimmed_pageName = trim(str_replace($spacer, " ", $page_name));
        $updated_pageName = ucwords(strtolower($trimmed_pageName));

        $company = $this->company_name();

        if ($updated_pageName != null) {
            return $updated_pageName . " | " .$company;
        } else {
            return $company;
        }
    }

    public function css_href($source) {
        return "<link type='text/css' href='$source' rel='stylesheet'/>";
    }

    public function js_source($source) {
        return "<script type='text/javascript' src='$source'></script>";
    }

    private function script_loop($collection) {
        foreach ($collection as $value) {
            $source = $value;
            $external_script = $this->js_source($source);

            echo $external_script;
        }
    }

    private function css_loop($collection) {
        foreach ($collection as $value) {
            $css_href = $value;
            $external_stylesheet = $this->css_href($css_href);

            echo $external_stylesheet;
        }
    }

    public function load_scripts($scripts) {
        $this->script_loop($scripts);
    }

    public function load_top_scripts() {
        $script = $this->config();
        $scriptCollection = $script->script_top();
        $this->script_loop($scriptCollection);
        echo "\n";
    }

    public function load_bottom_scripts() {
        $script = $this->config();
        $scriptCollection = $script->script_bottom();
        $this->script_loop($scriptCollection);
        echo "\n";
    }

    public function load_css($stylesheets) {
        $this->css_loop($stylesheets);

        $pg = $_GET['pg'];
        if ($pg == 'contact') {
            $contact_css = css_href("scripts/themes/base/jquery.ui.all.css");
        } else {
            $contact_css = css_href("scripts/themes/base/jquery.ui.base.css");
        }
        echo $contact_css . "\n\n";
    }

    public function load_top_css() {
        $css = $this->config();
        $cssCollection = $css->stylesheet_top();

        $this->css_loop($cssCollection);

        $pg = $_GET['pg'];
        if ($pg == 'contact') {
            //$contact_css = $this->css_href("scripts/themes/base/jquery.ui.all.css");
        } else {
            //$contact_css = $this->css_href("scripts/themes/base/jquery.ui.base.css");
        }
        echo $contact_css . "\n\n";
    }

    public function load_bottom_css() {
        $css = $this->config();
        $cssCollection = $css->stylesheet_bottom();

        $this->css_loop($cssCollection);
    }

    public function copyright_date() {
        $footer = $this->config();
        $year_created = $footer->year_created();
        $current_year = date('Y');

        if ($year_created != $current_year) {
            echo "&copy; $year_created - $current_year.";
        } else {
            echo "&copy; $year_created.";
        }
    }

    public function break_to_space($string) {
        $break = preg_replace('/<br[^>]*>/', ' ', strip_tags($string, '<br>'));
        $space = preg_replace('/[\ ]+/', ' ', $break);

        return $space;
    }

    //Get File Extension Function
    public function fetch_extension($filename) {
        $extension = split("[/\\.]", strtolower($filename));
        $extension_count = count($extension) - 1;

        return $extension[$extension_count];
    }

    private $social_target = "_blank";
    private function socialmedia_initiate() {
        $page = $this->config();
        $social_media = $page->social_media();

        return $social_media;
    }
    private function social_url($url, $target, $css_class, $label, $title) {
        return "<a href='$url' target='$target' class='$css_class' title='$title'>$label</a>";
    }

    public function social_facebook($css_class, $label, $title) {
        $social_media = $this->socialmedia_initiate();
        echo $this->social_url($social_media["facebook_url"], $this->social_target, $css_class, $label, $title);
    }

    public function social_twitter($css_class, $label, $title) {
        $social_media = $this->socialmedia_initiate();
        echo $this->social_url($social_media["twitter_url"], $this->social_target, $css_class, $label, $title);
    }

    public function social_instagram($css_class, $label, $title) {
        $social_media = $this->socialmedia_initiate();
        echo $this->social_url($social_media["instagram_url"], $this->social_target, $css_class, $label, $title);
    }

    public function social_linkedin($css_class, $label, $title) {
        $social_media = $this->socialmedia_initiate();
        echo $this->social_url($social_media["linkedin_url"], $this->social_target, $css_class, $label, $title);
    }

    public function social_youtube($css_class, $label, $title) {
        $social_media = $this->socialmedia_initiate();
        echo $this->social_url($social_media["youtube_url"], $this->social_target, $css_class, $label, $title);
    }

    public function social_googleplus($css_class, $label, $title) {
        $social_media = $this->socialmedia_initiate();
        echo $this->social_url($social_media["googleplus_url"], $this->social_target, $css_class, $label, $title);
    }

    public function aus_to_standard_date($date) {
        $date = explode('/', $date);
        $d = $date[0];
        $m = $date[1];
        $y = $date[2];
        $formattedDate = "$y-$m-$d";
        $n_date = date($formattedDate);

        return $n_date;
    }
}
