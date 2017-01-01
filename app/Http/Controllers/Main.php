<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\IPA\Word;
use App\IPA\Rule;
use App\User;
use Letters\Paragraph;

class Main extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function __invoke()
    {
        $text = new Paragraph( "
        Pål er 8år i dag.
        De har mye god mat.
        Og mat er noe Pål liker.
        De har kake og solo.
        På kaka er det 8 lys.
        Kjevik.

        Beskyttelse
        Jeg liker å bygge med lego.
        Tekno lego er best.

        Jeg kan bygge biler, fly,roboter og mye mer.
        Det går an å bruke fjernstyring, slik at bilene kan kjøre selv.
        Det går også an å bruke programeringsverktøy for å få roboter til å gjøre det du sier den skal gjøre.
        " );




        die;

        return view( 'words', [
            // 'user' => User::findOrFail($id)
        ] );
    }
}
