<?php

namespace App\IPA;

class Word {
  static function ipa( $word ) {
    if ( property_exists( $word, 'ipa' ) && $word->ipa ) {
      return $word->ipa;
    }
    return $word->getText();
  }
  static function render_combined( $word ) {
    return Word::ipa( $word ) . $word->modifier;
  }
  static function html_replace( $text ) {
    if ( 2 == count( $text ) ) {
      return $text[1];
    }
    $normal = $text[1];
    $ipa    = $text[2];

    $ipa_info = PhoneticRepresentation::lookup( $ipa );
    if ( ! $ipa_info ) {
      return sprintf(
        '<span class="ipa" data-ipa="%s">%s</span>',
        $ipa, $normal
      );
    }
    return sprintf(
      '<span class="ipa ipa-group-%s ipa-category-%s" data-ipa="%s">%s</span>',
      $ipa_info->group, $ipa_info->category, $ipa, $normal
    );
  }
  static function render_html( $word ) {
    $ipa = Word::ipa( $word );

    $text = preg_replace_callback(
      '/\[([^\]\|]+)\|?([^\]]*)\]/',
      __CLASS__ .'::html_replace',
      $ipa
    );
    $text = str_replace( '<span class="ipa"></span>', '', $text );
    // Method Letters\Container::__toString() must not throw an exception, caught ErrorException: preg_replace(): Compilation failed: nothing to repeat at offset 12

    return $text . $word->modifier;
  }
}
