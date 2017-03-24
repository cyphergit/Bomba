<?php

include 'default_settings.php';

class Config {

    private function settings() {
        $settings = new Settings();
        return $settings->default_settings();
    }

    private function scripts() {
        $scripts = $this->settings();
        return $scripts["scripts"];
    }

    private function stylesheets() {
        $stylesheets = $this->settings();
        return $stylesheets["stylesheets"];
    }

    public function script_top() {
        $script = $this->scripts();
        return $script["top"];
    }

    public function script_bottom() {
        $script = $this->scripts();
        return $script["bottom"];
    }

    public function stylesheet_top() {
        $css = $this->stylesheets();
        return $css["top"];
    }


    public function stylesheet_bottom() {
        $css = $this->stylesheets();
        return $css["bottom"];
    }

    public function host_isLocal($isLocal) {
        $host_info = $this->settings();

        if (!$isLocal) {
            return $host_info["development"]["prod"];
        } else {
            return $host_info["development"]["local"];
        }
    }

    public function host($host) { return $host; }

    public function company_name() {
        $company_info = $this->settings();
        return $company_info["company_info"]["company"];
    }

    public function company_contact() {
        $company_info = $this->settings();
        return $company_info["company_info"]["contact_no"];
    }

    public function company_address() {
        $company_info = $this->settings();
        return $company_info["company_info"]["address"];
    }

    public function company_postcode() {
        $company_info = $this->settings();
        return $company_info["company_info"]["postal_code"];
    }

    public function company_email() {
        $company_info = $this->settings();
        return $company_info["company_info"]["enquiry_email"];
    }

    public function company_website() {
        $company_info = $this->settings();
        return $company_info["company_info"]["website"];
    }

    public function google_map() {
        $company_info = $this->settings();
        return $company_info["google_map"]["url"];
    }

    public function domain_name() {
        $domain_info = $this->settings();
        return $domain_info["development"]["domain"];
    }

    public function year_created() {
        $company_info = $this->settings();
        return $company_info["company_info"]["date_created"];
    }

    // SQL Prevention Function
    public function clean_form($data) { // Prevents SQL Injection
        global $db_connect;
        $data = ereg_replace("[\'\")(;|`,<>]", "", $data);
        $data = mysql_real_escape_string(trim($data), $db_connect);

        return stripslashes($data);
    }

    public function social_media() {
        $social_media = $this->settings();
        return $social_media["social_media"];
    }
}
