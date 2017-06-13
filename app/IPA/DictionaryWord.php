<?php

namespace App\IPA;

use Illuminate\Database\Eloquent\Model;

class DictionaryWord extends Model {
    //DB:
    public $id;
    // public $text;
    // public $ipa;

    protected $fillable = [
        'text',
        'language',
        'ipa'
    ];

    //Util:
    public $breakdown;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct() {
    }


    static function lookup( $word ) {

        // var_dump(
        //     $dictionary = DictionaryWord::query()
        //     ->where( 'language', '=', 'nb_no' )
        //     ->where( 'text', 'like', $word->getText() )
        //     ->getQuery()->toSql()
        //     ); die;
        $dictionary = DictionaryWord::query()
            ->where( 'language', '=', 'nb_no' )
            ->where( 'text', 'like', $word->getText() )
            ->get()
            ->all();

        if ( empty( $dictionary ) ) {
            return $word;
        }

        $dictionary_word = reset( $dictionary );
        $word->ipa = $dictionary_word->ipa;
        $word->end_processing = true;

        return $word;
    }
}
