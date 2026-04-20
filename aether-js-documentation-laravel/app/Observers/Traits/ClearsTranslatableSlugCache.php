<?php

namespace App\Observers\Traits;

use Illuminate\Database\Eloquent\Model;

trait ClearsTranslatableSlugCache
{
    protected function clearTranslatableSlugCache(Model $model, string $strategyKey, string $event = 'updating')
    {
        if (!property_exists($this, 'cacheManager')) {
            throw new \Exception(
                get_class($this) . ' must have a $cacheManager property to use ClearsTranslatableSlugCache trait.'
            );
        }

        $originalSlugJson = $model->getOriginal('slug');

        if ($originalSlugJson) {
            $originalSlugs = null;
            if (is_string($originalSlugJson) && ($decoded = json_decode($originalSlugJson, true)) !== null && json_last_error() === JSON_ERROR_NONE) {
                $originalSlugs = $decoded;
            } else {
                $originalSlugs = [$model->getOriginal('locale') ?? config('app.fallback_locale') => $originalSlugJson];
            }

            if (is_array($originalSlugs)) {
                foreach ($originalSlugs as $locale => $slug) {
                    if ($slug && $locale) {
                        $this->cacheManager->forget($strategyKey, [$locale, $slug]);
                    }
                }
            }
        }

        if ($event !== 'deleted') {
            $newSlugJson = $model->slug;

            if ($newSlugJson) {
                $newSlugs = null;
                if (is_string($newSlugJson) && ($decoded = json_decode($newSlugJson, true)) !== null && json_last_error() === JSON_ERROR_NONE) {
                    $newSlugs = $decoded;
                } else {
                    $newSlugs = [$model->locale ?? config('app.fallback_locale') => $newSlugJson];
                }

                if (is_array($newSlugs)) {
                    foreach ($newSlugs as $locale => $slug) {
                        if ($slug && $locale) {
                            $this->cacheManager->forget($strategyKey, [$locale, $slug]);
                        }
                    }
                }
            }
        }
    }
}
