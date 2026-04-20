<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Services\SlugResolverService;
use App\ViewModels\PageViewModel;
use Illuminate\Support\Facades\View;
use App\Services\CacheManagerService;
use App\Services\CatalogService;

class SiteController extends Controller
{
    protected $resolverService;

    protected $cacheManager;

    protected $catalogService;

    public function __construct(
        SlugResolverService $resolverService,
        CacheManagerService $cacheManager,
        CatalogService $catalogService
    ) {
        $this->resolverService = $resolverService;
        $this->cacheManager = $cacheManager;
        $this->catalogService = $catalogService;
    }

    public function resolve($locale, $slug)
    {
        return $this->resolverService->resolve($locale, $slug);
    }

    public function index($locale)
    {
        $page = Page::where('is_homepage', 1)
            ->where('status', 1)
            ->firstOrFail();

        $viewModel = new PageViewModel(
            $page,
            $locale,
            $this->catalogService
        );

        $bladeName = $viewModel->getBladeName();

        if (empty($bladeName) || !View::exists('pages.' . $bladeName)) {
            abort(404);
        }

        return view('pages.' . $bladeName, [
            'locale' => $locale,
            'viewModel' => $viewModel,
        ]);
    }
}
