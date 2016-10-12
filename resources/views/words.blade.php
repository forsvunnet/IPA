
@extends('layouts.app')

@section('content')

<?php

    $word = 'man';
    $ipa = 'man';

    $word_def['spelling']      = 'har';
    $word_def['word']          = 'h[a]r';
    $word_def['ipa']           = 'h[ɑː]r';
    $word_def['breakdown']     = ['h'=>'h', 'ɑː'=>'a', 'r'=>'r'];
    $palette              = ['ɑː' => 1];
    $colors               = [1 => '#C00'];
    $inline_html   = true;
    $inline_styles = true;
    $color_vowels  = true;

    $sentance = "Har du en paraply?\nH[a]r du en paraply";
    $words = explode(' ', $sentance);
    foreach ($words as &$word) {
        $lower = strtolower($word);
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
        echo "$lower<br>";
    }
    $line = implode(' ', $words);

    echo $line;


?>


    <!-- TODO: Current Tasks -->
@endsection
