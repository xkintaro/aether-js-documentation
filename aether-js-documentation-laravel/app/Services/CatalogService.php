<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CatalogService
{
    protected $cacheManager;

    public function __construct(CacheManagerService $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function getPageChildrenContent(Page $page, string $locale): Collection
    {
        return $this->cacheManager->remember(
            'page_vm_children_content',
            [$page->id, $locale],
            function () use ($page, $locale) {
                $childrenPages = $page->children()
                    ->where('status', 1)
                    ->orderBy('order', 'asc')
                    ->with('translations')
                    ->get();

                return $childrenPages->map(function ($child) use ($locale) {
                    $translation = $child->translate($locale);
                    $title = $translation->title ?: $child->getOriginal('title');
                    return (object) [
                        'title' => $title,
                        'subtitle' => $translation->subtitle ?: $child->getOriginal('subtitle'),
                        'content' => $translation->content ?: $child->getOriginal('content'),
                        'anchor_slug' => Str::slug($title)
                    ];
                });
            }
        );
    }
}
