<?php

namespace App\IPA;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model {
  protected $fillable = [
    'regex',
    'name',
    'last_rule',
    'language',
  ];
}
