<?php

namespace App\IPA;

use App\IPA\ColourPalette;
use App\IPA\LetterMap;

class Letter
{
  private $letter;
  private $ipa;
  private $palette;

  function __construct($letter, $ipa) {
    $this->letter = $letter;
    $this->ipa = $ipa;
  }
  public function get_colour_number() {
    $map = LetterMap::get_instance();
    return $map->get_colour_number( $this->ipa );
  }
  public function get_colour() {
    $palette = ColourPalette::get_instance();
    $colour_number = $this->get_colour_number();
    return $palette->get_colour( $colour_number );
  }
  public function format_inline_css() {
    $format = '<span style="colour:%s" title="%s">%s</span>';
    return sprintf($format);
  }

  public function format_classed() {
    $format = '<span class="%s" title="%s">a</span>';
    return sprintf($format);
  }
}
