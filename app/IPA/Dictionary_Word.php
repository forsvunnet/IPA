<?php

namespace App\IPA;

use Illuminate\Database\Eloquent\Model;

class Dictionary_Word {
    //DB:
    public $id;
    public $text;
    public $phonetic;
    public $combined;

    //Util:
    public $breakdown;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct( string $word ) {
    }
}
