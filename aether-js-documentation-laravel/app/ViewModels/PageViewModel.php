<?php

namespace App\ViewModels;

use App\Models\Page;
use Illuminate\Support\Collection;
use App\Services\CatalogService;
use Illuminate\Support\Str;

class PageViewModel
{
    protected $page;
    protected $locale;
    protected $translation;
    protected $catalogService;

    public function __construct(
        Page $page,
        $locale,
        CatalogService $catalogService
    ) {
        $this->page = $page;
        $this->locale = $locale;
        $this->translation = $page->translate($locale);
        $this->catalogService = $catalogService;
    }

    public function getChildrenContent(): Collection
    {
        if ($this->getBladeName() !== 'aggregate') {
            return collect();
        }

        return $this->catalogService->getPageChildrenContent($this->page, $this->locale);
    }

    public function getModel()
    {
        return $this->page;
    }

    public function getTitle()
    {
        return $this->translation->title ?? '';
    }

    public function getContent()
    {
        return $this->translation->content ?? '';
    }

    public function getSubtitle()
    {
        return $this->translation->subtitle ?? '';
    }

    public function getSeoTitle()
    {
        return $this->translation->meta_title ?? $this->getTitle();
    }

    public function getMetaDescription()
    {
        return $this->translation->meta_description ?? '';
    }

    public function getSeoText()
    {
        return $this->translation->seo_text ?? '';
    }

    public function getBladeName()
    {
        return $this->translation->blade_name ?? $this->page->blade_name;
    }
}
