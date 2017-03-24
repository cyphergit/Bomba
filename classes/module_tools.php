<?php

class ModuleTools {

    public function extract_fields($array) {
        $fieldset = $array;
        $new_fieldset = array();

        foreach($fieldset as $field) {
            $field = explode(":", $field);
            $key = $field[0];
            $value = $field[1];

            $new_fieldset[$key] = $value;
        }
        return $new_fieldset;
    }
    
    public function is_injected($str) {
        $injections = array('(\n+)',
            '(\r+)',
            '(\t+)',
            '(%0A+)',
            '(%0D+)',
            '(%08+)',
            '(%09+)'
        );
        $inject = join('|', $injections);
        $inject = "/$inject/i";
        if (preg_match($inject, $str)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function alter_time($time) {
        return str_replace("_", ":", $time);
    }
}
