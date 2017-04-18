<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Category\CategoryInterface;

class MenuComposer
{
    protected $menus = [];

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->menus = $categoryRepository->getMenu();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menus', $this->menus);
    }
}
