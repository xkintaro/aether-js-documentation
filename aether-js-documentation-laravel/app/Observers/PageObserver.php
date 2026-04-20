<?php

namespace App\Observers;

use App\Models\Page;
use App\Services\CacheManagerService;
use App\Observers\Traits\ClearsTranslatableSlugCache;

class PageObserver
{
    use ClearsTranslatableSlugCache;

    protected $cacheManager;

    public function __construct(CacheManagerService $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function created(Page $page): void
    {
        $this->clearAllPageCaches($page, 'created');
    }

    public function updating(Page $page): void
    {
        $this->clearAllPageCaches($page, 'updated');
    }

    public function deleted(Page $page): void
    {
        $this->clearAllPageCaches($page, 'deleted');
    }

    public function restored(Page $page): void
    {
        $this->clearAllPageCaches($page, 'restored');
    }

    protected function clearAllPageCaches(Page $page, string $event = 'updating'): void
    {
        $this->clearMenuCache();
        $this->clearResolverCache($page, $event);
        $this->clearParentPageCache($page, $event);
    }

    protected function clearMenuCache(): void
    {
        $supportedLocales = config('voyager.multilingual.locales');
        foreach ($supportedLocales as $locale) {
            $this->cacheManager->forget('menu', [$locale]);
        }
    }

    protected function clearResolverCache(Page $page, string $event = 'updating'): void
    {
        $this->clearTranslatableSlugCache($page, 'page_resolver', $event);
    }

    protected function clearParentPageCache(Page $page, string $event = 'updating'): void
    {
        $supportedLocales = config('voyager.multilingual.locales');

        if ($event !== 'deleted' && $page->parent_id) {
            foreach ($supportedLocales as $locale) {
                $this->cacheManager->forget(
                    'page_vm_children_content',
                    [$page->parent_id, $locale]
                );
            }
        }

        $originalParentId = $page->getOriginal('parent_id');

        if ($originalParentId && $originalParentId !== $page->parent_id) {
            foreach ($supportedLocales as $locale) {
                $this->cacheManager->forget(
                    'page_vm_children_content',
                    [$originalParentId, $locale]
                );
            }
        }
    }
}
