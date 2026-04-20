<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\NavigationService;

class NavigationComposer
{
    protected $navigationService;

    public function __construct(NavigationService $navigationService)
    {
        $this->navigationService = $navigationService;
    }

    public function compose(View $view)
    {
        $locale = $view->getData()['locale'] ?? app()->getLocale();
        $menuItems = $this->navigationService->getMenu($locale);
        $view->with('menuItems', $menuItems);
    }
}
