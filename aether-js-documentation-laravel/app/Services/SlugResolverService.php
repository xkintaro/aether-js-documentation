<?php

namespace App\Services;

use App\Resolvers\PageResolver;
use Illuminate\Pipeline\Pipeline;
use Closure;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SlugResolverService
{
    protected $pipeline;

    protected $resolvers = [
        PageResolver::class,
    ];

    public function __construct(Pipeline $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    public function resolve($locale, $slug)
    {
        $slug = trim($slug, '/');

        if (empty($slug)) {
            abort(404);
        }

        $payload = [
            'locale' => $locale,
            'slug' => $slug
        ];

        return $this->pipeline
            ->send($payload)
            ->through($this->resolvers)
            ->then(function ($payload) {
                abort(404);
            });
    }
}
