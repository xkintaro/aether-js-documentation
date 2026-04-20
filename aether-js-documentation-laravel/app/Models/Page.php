<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use Translatable;

    protected $translatable = [
        'slug',
        'title',
        'subtitle',
        'content',
        'meta_title',
        'meta_description',
        'seo_text',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function getRecursiveSlug(string $locale): string
    {
        $translation = $this->translate($locale);
        $slug = $translation->slug;

        if (empty($slug)) {
            $slug = $this->getOriginal('slug');
        }

        if (is_string($slug) && ($decoded = json_decode($slug, true)) !== null && json_last_error() === JSON_ERROR_NONE) {
            $slug = $decoded[$locale] ?? $decoded[config('app.fallback_locale')] ?? null;
        }

        if (empty($slug)) {
            return '';
        }

        if ($this->parent) {
            $parentSlug = $this->parent->getRecursiveSlug($locale);
            if (!empty($parentSlug) && $parentSlug !== '#') {
                return $parentSlug . '/' . $slug;
            }
        }

        return $slug;
    }

    public function getPath($locale): string
    {
        if ($this->is_homepage) {
            return route('index', ['locale' => $locale]);
        }

        $fullSlug = $this->getRecursiveSlug($locale);

        if (empty($fullSlug)) {
            return '#';
        }

        return route('resolver', [
            'locale' => $locale,
            'slug'   => $fullSlug
        ]);
    }
}
