<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\IPA\DictionaryWord;
use App\IPA\Rule;
use App\User;
use \Letters\Paragraph;

class Main extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function __invoke()
    {
        $files = glob( '../vendor/cove/letters/src/Letters/**/*.php' );
        $files = array_merge( $files, glob( '../vendor/cove/letters/src/Letters/*.php' ) );
        foreach ( $files as $file) {
            require_once $file;
        }

        $factory = new \Letters\Factory();
        $factory->language = 'nb_no';
        $factory->addCallback( 'word', '\App\IPA\DictionaryWord::lookup' );
        $factory->addCallback( 'word', '\App\IPA\Rule::apply_rules' );
        $factory->setRenderer( 'word', '\App\IPA\Word::render_combined' );
        $factory->setRenderer( 'word', '\App\IPA\Word::render_html' );
        $volume = $factory->make( 'volume', "
        Pål er 8år i dag.
        De har mye god mat.
        Og mat er noe Pål liker.
        De har kake og solo.
        På kaka er det 8 lys.
        Kjevik.

        Beskyttelse
        Jeg liker å bygge med lego.
        Tekno lego er best.

        Jeg kan bygge biler, fly, roboter og mye mer.
        Det går an å bruke fjernstyring, slik at bilene kan kjøre selv.
        Det går også an å bruke programeringsverktøy for å få roboter til å gjøre det du sier den skal gjøre.
        " );
        ?>
<style>
p {
    font-size: 1.5rem;
}
.ipa-category-silent-letter {
    color: #999;
}
.ipa-category-long-vowel {
  color: #09F;
}
.ipa-category-short-vowel {
  color: red;
}
</style>
        <?php
        echo "<p>";
        echo( "$volume\n" );
        // var_dump( $volume->content['word'] );

        $rules = Rule::query()
          ->where( 'language', '=', 'nb_no' )
          ->get()->all();
        foreach ( $rules as $rule ) {
            $rule->delete();
        }
        $rules = [];
        // var_dump( $rules );

        if ( empty( $rules ) ) {
            // echo "It's empty";
            $rule = new Rule();
            $rule->name = 'Short e';
            $rule->priority = 10;
            $rule->language = 'nb_no';
            $rule->last_rule = false;
            $rule->regex = '{consonant}e$';
            $rule->replace = '$1[e|ǝ]';
            $rule->save();
            $rules[] = $rule;

            $rule = new Rule();
            $rule->name = 'Short vowel e';
            $rule->priority = 10;
            $rule->language = 'nb_no';
            $rule->last_rule = false;
            $rule->regex = '([Ee]){consonant}{consonant}';
            $rule->replace = '[$1|ǝ]$2$3';
            $rule->save();
            $rules[] = $rule;

            $rule = new Rule();
            $rule->name = 'Short vowel y';
            $rule->priority = 10;
            $rule->language = 'nb_no';
            $rule->last_rule = false;
            $rule->regex = '([Yy]){consonant}{consonant}';
            $rule->replace = '[$1|𝗒]$2$3';
            $rule->save();
            $rules[] = $rule;

            $rule = new Rule();
            $rule->name = '"Be" in the beginning';
            $rule->priority = 5;
            $rule->language = 'nb_no';
            $rule->last_rule = false;
            $rule->regex = '^([Bb])e';
            $rule->replace = '$1[e]';
            $rule->save();
            $rules[] = $rule;

            $rule = new Rule();
            $rule->name = '"Kj" in the beginning';
            $rule->priority = 5;
            $rule->language = 'nb_no';
            $rule->last_rule = false;
            $rule->regex = '^([Kk]j)';
            $rule->replace = '[$1|ʈ]';
            $rule->save();
            $rules[] = $rule;

            $rule = new Rule();
            $rule->name = '"er" changes the sound';
            $rule->priority = 5;
            $rule->language = 'nb_no';
            $rule->last_rule = false;
            $rule->regex = '([a-z])e(r[kn])';
            $rule->replace = '$1[e|æ]$2';
            $rule->save();
            $rules[] = $rule;

            $rule = new Rule();
            $rule->name = '"lv" at the end is silent';
            $rule->priority = 5;
            $rule->language = 'nb_no';
            $rule->last_rule = false;
            $rule->regex = 'lv$';
            $rule->replace = 'l[v|•]';
            $rule->save();
            $rules[] = $rule;
        }

        $dictionary = DictionaryWord::query()->get()->all();
        foreach ( $dictionary as $dictionary_word ) {
            $dictionary_word->delete();
        }
        $dictionary_word = new DictionaryWord();
        $dictionary_word->ipa = 'besk[y|𝗒]tt[e|ǝ]ls[e|ǝ]';
        $dictionary_word->text = 'beskyttelse';
        $dictionary_word->language = 'nb_no';
        $dictionary_word->save();

        $dictionary_word = new DictionaryWord();
        $dictionary_word->ipa = '[e|æ]r';
        $dictionary_word->text = 'er';
        $dictionary_word->language = 'nb_no';
        $dictionary_word->save();

        $dictionary_word = new DictionaryWord();
        $dictionary_word->ipa = '';
        $dictionary_word->text = 'De';
        $dictionary_word->language = 'nb_no';
        $dictionary_word->save();

        echo "</pre>";


        die;

        return view( 'words', [
            // 'user' => User::findOrFail($id)
        ] );
    }
}
