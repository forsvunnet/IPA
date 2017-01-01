
@extends('layouts.app')

@section('content')

<?php

use Letters\Paragraph;

    $word      = 'man';
    $combined  = 'm[a|ɑː]n';
    $ipa       = 'mɑːn';

    $word_def['spelling']      = 'har';
    $word_def['word']          = 'har';
    $word_def['ipa']           = 'hɑːr';
    $word_def['combined']      = 'h[a|ɑː]r';
    $word_def['breakdown']     = ['h'=>'h', 'ɑː'=>'a', 'r'=>'r'];
    $palette                   = ['ɑː' => 1];
    $colors                    = [1 => '#C00'];
    $inline_html               = true;
    $inline_styles             = true;
    $color_vowels              = true;



    $chapter = new Paragraph( $sentence );

    // var_dump( (string) $chapter );


    $words = explode(' ', $sentence);
    foreach ($words as &$word) {
        $lower = strtolower($word);
        $lower = ($word);
        if ($lower == $word_def['spelling']) {
            if ($inline_html) {
                $letters = str_split($lower);
                $word = '';
                foreach ($word_def['breakdown'] as $key => $letter) {
                    // @to_html()
                    if (isset($palette[$key])) {
                        if ($inline_styles) {
                            // @letter->render_inline_css();
                            $letter = sprintf(
                                '<span style="color:%s" title="%s">%s</span>',
                                $colors[$palette[$key]], $key, $letter
                            );
                        } else {
                            // @letter->render_classed();
                            $letter = sprintf(
                                '<span class="%s" title="%s">a</span>',
                                'c'. $palette[$key], $key, $letter
                            );
                        }
                    }
                    $word .= $letter;
                }
            } else {
                // @to_text()
                $word = "{{$word_def['word']}|{$word_def['ipa']}}";
                // $word = json_encode($word_def['breakdown']);
            }
        }
        // echo "$lower<br>";
    }
    $line = implode(' ', $words);

    echo nl2br( trim( $line ) );


?>


    <!-- TODO: Current Tasks -->
@endsection
