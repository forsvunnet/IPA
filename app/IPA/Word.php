<?php

namespace App\IPA;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    //DB:
    $spelling;
    $phonetic_spelling;
    //Util:
    $breakdown;
}
