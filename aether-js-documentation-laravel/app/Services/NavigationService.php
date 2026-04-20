<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Collection;
use App\Services\CacheManagerService;
use Illuminate\Support\Str;

class NavigationService
{
    protected $cacheManager;

    public function __construct(CacheManagerService $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function getMenu(string $locale): Collection
    {
        return $this->cacheManager->remember('menu', [$locale], function () use ($locale) {

            $pages = Page::whereNull('parent_id')
                ->where('menu_show', 1)
                ->where('status', 1)
                ->with('translations')
                ->with([
                    'children' => function ($query) {
                        $query->where('menu_show', 1)
                            ->where('status', 1)
                            ->orderBy('order', 'asc')
                            ->with('translations');
                    }
                ])
                ->orderBy('order', 'asc')
                ->get();

            return $pages->map(function ($page) use ($locale) {

                $translation = $page->translate($locale);

                $title = $translation->title ?: $page->getOriginal('title');
                $subtitle = $translation->subtitle ?: $page->getOriginal('subtitle');
                $parentUrl = $page->getPath($locale);
                $children = collect();

                if ($page->blade_name === 'aggregate') {
                    $children = $page->children->map(function ($child) use ($locale, $parentUrl) {
                        $childTranslation = $child->translate($locale);
                        $childTitle = $childTranslation->title ?: $child->getOriginal('title');
                        $childSubtitle = $childTranslation->subtitle ?: $child->getOriginal('subtitle');
                        $anchor = Str::slug($childTitle);

                        return (object) [
                            'title' => $childTitle,
                            'subtitle' => $childSubtitle,
                            'icon' => $child->icon,
                            'url' => $parentUrl . '#' . $anchor
                        ];
                    });
                } else {
                    $children = $page->children->map(function ($child) use ($locale) {
                        $childTranslation = $child->translate($locale);
                        $childTitle = $childTranslation->title ?: $child->getOriginal('title');
                        $childSubtitle = $childTranslation->subtitle ?: $child->getOriginal('subtitle');

                        return (object) [
                            'title' => $childTitle,
                            'subtitle' => $childSubtitle,
                            'icon' => $child->icon,
                            'url' => $child->getPath($locale)
                        ];
                    });
                }

                return (object) [
                    'title' => $title,
                    'subtitle' => $subtitle,
                    'icon' => $page->icon,
                    'url' => $parentUrl,
                    'children' => $children
                ];
            });
        });
    }
}
