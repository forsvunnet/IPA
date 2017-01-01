<?php

namespace App\IPA;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model {
  public $fillable = [
    'regex',
    'last_rule',
    'language',
  ];
}
