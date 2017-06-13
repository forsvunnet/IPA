<?php

namespace App\IPA;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model {
  protected $fillable = [
    'regex',
    'replace',
    'name',
    'last_rule',
    'priority',
    'language',
  ];

  public function getRegex() {
    return strtr(
      $this->regex,
      [
        '{consonant}' => '([qwrtpsdfghjklzxcvbnmQWRTPSDFGHJKLZXCVBNM])',
      ]
    );
  }


  public function process( $word ) {
    if ( property_exists( $word, 'ipa' ) ) {
      $text = $word->ipa;
    } else {
      $text = $word->getText();
    }
    $regex = $this->getRegex();
    if ( $this->last_rule ) {
      $word->end_processing = true;
    }
    return preg_replace( "/{$regex}/", $this->replace, $text );
  }

  static function apply_rules( $word, $factory ) {
    if ( property_exists( $word, 'end_processing' ) && $word->end_processing ) {
      return;
    }
    $query = Rule::query()
      ->where( 'language', '=', 'nb_no' );
    $query->getQuery()
      ->orderBy( 'priority' );
    $rules = $query
      ->get()
      ->all();

    foreach ( $rules as $rule ) {
      // Overload the object with the ipa translation
      $word->ipa = $rule->process( $word );
    }
  }
}
