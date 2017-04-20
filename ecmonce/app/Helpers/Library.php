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
        return [
            '0' => trans('common.made_in.chosse'),
            trans('common.made_in.china') => trans('common.made_in.china'),
            trans('common.made_in.vietname') => trans('common.made_in.vietname'),
            trans('common.made_in.usa') => trans('common.made_in.usa'),
            trans('common.made_in.japan') => trans('common.made_in.japan'),
            trans('common.made_in.italy') => trans('common.made_in.italy'),
        ];
    }

    /**
    * get getRatings
     *
     * @return category
     */
    public static function getRatings()
    {
        return [
            '0' => trans('common.rating.chosse'),
            '1' => trans('common.ratind.one'),
            '2' => trans('common.ratind.two'),
            '3' => trans('common.ratind.three'),
            '4' => trans('common.ratind.four'),
        ];
    }

    /**
    * get sort price
     *
     * @return category
     */
    public static function getSortPrice()
    {
        return [
            '0' => trans('common.price.sort'),
            '1' => trans('common.price.ascending'),
            '2' => trans('common.price.decrease'),
        ];
    }
}
