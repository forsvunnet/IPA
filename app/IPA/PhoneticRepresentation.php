<?php

namespace App\IPA;

class PhoneticRepresentation {
  function __construct( $values ) {
    $this->category = $values[0];
    $this->group    = $values[1];
  }
  static function lookup( $ipa ) {
    static $map = [
      '𝗒'  => [ 'short-vowel',    '1' ],
      'ǝ'  => [ 'short-vowel',    '1' ],
      'ɑː' => [ 'short-vowel',    '1' ],
      'æ'  => [ 'long-vowel',     '2' ],
      '•'  => [ 'silent-letter',  '3' ],
    ];
    if ( ! isset( $map[ $ipa ] ) ) {
      return null;
    }
    return new PhoneticRepresentation( $map[ $ipa ] );
  }
}
