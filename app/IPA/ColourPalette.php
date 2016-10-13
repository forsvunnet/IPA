<?php

namespace App\IPA;

class ColourPalette {
  public function get_instance() {
    if ( ! self::$instance ) {
      self::$instance = new ColourPalette;
    }
    return self::$instance;
  }

  public function get_colour( $colour_number ) {
    // ...
    return ;
  }
}
