<?php

namespace App\IPA;

class LetterMap
{
    static private $instance;
    public function get_instance() {
        if ( ! self::$instance ) {
            self::$instance = new ColourPalette;
        }
        return self::$instance;
    }

    public function get_colour_number( $ipa ) {
        $mappings = [
            'ɑː'      => 1,
            'default' => 0,
        ];
        // Get a model for the mapping
        // $mapping = $this->maybe_get_mapping($ipa);
        // return $mapping->colour_number;
        if ( isset( $mappings[$ipa] ) ) {
            return $mappings[$ipa];
        }
    }
}
