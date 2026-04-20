@php
    $locale = app()->getLocale();

    $buildFooterGroup = function ($title, $criteria, $limit = 5) use ($locale) {
        $query = \App\Models\Page::where('status', 1)
            ->orderBy('order', 'asc')
            ->with('translations');

        if (is_array($criteria)) {
            $query->whereIn('id', $criteria);

        } else {
            $query->where('parent_id', $criteria);
        }

        if ($limit > 0) {
            $query->take($limit);
        }

        $pages = $query->get();

        if ($pages->isEmpty())
            return null;

        return (object) [
            'title' => $title,
            'items' => $pages->map(function ($page) use ($locale) {
                return (object) [
                    'id' => $page->id,
                    'title' => $page->translate($locale)->title ?? $page->title,
                    'url' => $page->getPath($locale),
                ];
            })
        ];
    };

    $footerData = collect([

        $buildFooterGroup(__('Site Haritası'), [1, 2, 37]),

        $buildFooterGroup(__('Dökümantasyon'), 2),

        $buildFooterGroup(__('Bileşenler'), 37),
    ])->filter();

@endphp

<footer class="custom-container relative overflow-hidden">
    <div
        class="flex flex-col xl:flex-row w-full flex-wrap gap-16 xl:gap-48 items-start justify-between border-y border-primary py-16 mb-8">

        <div
            class="w-fit max-w-[400px] flex flex-col gap-4 max-xl:mx-auto max-xl:text-center max-xl:justify-center max-xl:items-center">
            <a href="{{ route('index', ['locale' => app()->getLocale()]) }}" class="flex items-center gap-2.5 group">
                <img src="{{ Storage::url(setting('site.logo')) }}" alt="{{ setting('site.title') }}"
                    class="size-8 sm:size-10" />
                <span class="font-display font-bold text-lg tracking-tight text-primary">
                    Aether<span class="text-accent">JS</span>
                </span>
            </a>
            <p class="text-secondary">@lang("Modern web için geliştirilmiş, hafif ve headless UI kontrolcüsü.")</p>

            <div class="flex w-full flex-wrap gap-6 items-center max-xl:justify-center">
                <a href="https://github.com/xkintaro/aether-js"
                    class="text-primary hover:text-secondary transition-colors">
                    <svg class="size-6" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"
                                d="M120.755 170c.03-4.669.059-20.874.059-27.29 0-9.272-3.167-15.339-6.719-18.41 22.051-2.464 45.201-10.863 45.201-49.067 0-10.855-3.824-19.735-10.175-26.683 1.017-2.516 4.413-12.63-.987-26.32 0 0-8.296-2.672-27.202 10.204-7.912-2.213-16.371-3.308-24.784-3.352-8.414.044-16.872 1.14-24.785 3.352C52.457 19.558 44.162 22.23 44.162 22.23c-5.4 13.69-2.004 23.804-.987 26.32C36.824 55.498 33 64.378 33 75.233c0 38.204 23.149 46.603 45.2 49.067-3.551 3.071-6.719 9.138-6.719 18.41 0 6.416.03 22.621.059 27.29M27 130c9.939.703 15.67 9.735 15.67 9.735 8.834 15.199 23.178 10.803 28.815 8.265">
                            </path>
                        </g>
                    </svg>
                </a>
                <a href="https://discord.gg/NSQk27Zdkv" class="text-primary hover:text-secondary transition-colors">
                    <svg class="size-6" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"
                                d="m68 138-8 16c-10.19-4.246-20.742-8.492-31.96-15.8-3.912-2.549-6.284-6.88-6.378-11.548-.488-23.964 5.134-48.056 19.369-73.528 1.863-3.334 4.967-5.778 8.567-7.056C58.186 43.02 64.016 40.664 74 39l6 11s6-2 16-2 16 2 16 2l6-11c9.984 1.664 15.814 4.02 24.402 7.068 3.6 1.278 6.704 3.722 8.567 7.056 14.235 25.472 19.857 49.564 19.37 73.528-.095 4.668-2.467 8.999-6.379 11.548-11.218 7.308-21.769 11.554-31.96 15.8l-8-16m-68-8s20 10 40 10 40-10 40-10">
                            </path>
                            <ellipse cx="71" cy="101" fill="currentColor" rx="13" ry="15"></ellipse>
                            <ellipse cx="121" cy="101" fill="currentColor" rx="13" ry="15"></ellipse>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
        <div
            class="flex w-full flex-1 flex-wrap gap-10 items-start justify-between md:justify-center xl:justify-between">
            @foreach($footerData as $group)
                <div class="w-fit min-w-[140px] flex flex-col gap-4">
                    <h4 class="text-primary font-semibold text-base">{{ $group->title }}</h4>
                    <div class="flex flex-col gap-2">
                        @foreach($group->items as $item)
                            <a href="{{ $item->url }}"
                                class="text-secondary text-sm hover:text-primary hover:underline transition-colors duration-200">
                                {{ $item->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="flex flex-wrap w-full items-center justify-between mb-8 pt-8 border-t border-primary/10">
        <p class="text-tertiary text-sm">© {{ date('Y') }} @lang("AetherUI Open Source Project. Tüm hakları saklıdır.")
        </p>
    </div>
</footer>