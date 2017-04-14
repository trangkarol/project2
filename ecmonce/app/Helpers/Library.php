<?php

namespace App\Helpers;

use DateTime;
use Mail;
use Cache;
use App\Models\Category;

class Library
{
    protected $categoryRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
    * get category level.
     *
     * @return category
     */
    public static function getCategoryLevel($type_category)
    {
        $rememberName = 'categoryOne';
        if ($type_category == config('setting.mutil-level.two')) {
            $rememberName = 'categoryTwo';
        }

        return Cache::remember($rememberName, config('setting.minutes'), function () use ($type_category) {
            return Category::where('type_category', $type_category)->pluck('name', 'id')->all();
        });
    }
}
