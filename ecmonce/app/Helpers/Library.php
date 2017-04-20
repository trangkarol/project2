<?php

namespace App\Helpers;

use DateTime;
use Mail;

class Library
{
    /**
    * get made in.
     *
     * @return category
     */
    public static function getMadeIn()
    {
        $madeIn = [
            '0' => trans('common.made_in.chosse'),
            trans('common.made_in.china') => trans('common.made_in.china'),
            trans('common.made_in.vietname') => trans('common.made_in.vietname'),
            trans('common.made_in.usa') => trans('common.made_in.usa'),
            trans('common.made_in.japan') => trans('common.made_in.japan'),
            trans('common.made_in.italy') => trans('common.made_in.italy'),
        ];

        return $madeIn;
    }
}
