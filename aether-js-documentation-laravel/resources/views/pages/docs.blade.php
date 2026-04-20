@extends('layouts.default')

@section('content')

@php
$currentPage = $viewModel->getModel();
$currentId = $currentPage ? $currentPage->id : null;
$locale = app()->getLocale();

$buildGroup = function($title, $criteria) use ($currentId, $locale) {
$query = \App\Models\Page::where('status', 1)
->orderBy('order', 'asc')
->with('translations');

if (is_array($criteria)) {
$query->whereIn('id', $criteria);
} else {
$query->where('parent_id', $criteria);
}

$pages = $query->get();

if ($pages->isEmpty()) return null;

return (object) [
'type' => 'group',
'title' => $title,
'items' => $pages->map(function($page) use ($currentId, $locale) {

return (object) [
'id' => $page->id,
'title' => $page->translate($locale)->title ?? $page->title,
'url' => $page->getPath($locale),
'isActive' => $currentId === $page->id
];
})->filter()
];
};

$buildLink = function($pageId) use ($currentId, $locale) {

if (!is_int($pageId)) return null;

$page = \App\Models\Page::with('translations')->find($pageId);

if (!$page || $page->status != 1) return null;

return (object) [
'type' => 'single_link',
'id' => $page->id,
'title' => $page->translate($locale)->title ?? $page->title,
'url' => $page->getPath($locale),
'isActive' => $currentId === $page->id
];
};

$sidebarData = collect([

$buildLink(2),

$buildGroup(__('Başlangıç'), [39,26]),
$buildGroup(__('Çekirdek Mekanik'), [21,22,23]),
$buildGroup(__('Yapı ve Durum Yönetimi'), [27,35,31,24]),
$buildGroup(__('Davranış ve UX'), [29,30,32,33]),
$buildGroup(__('Görünüm ve Stil'), [28,34]),

$buildGroup(__('Bileşenler'), 37),
])->filter();

$breadcrumbs = collect([]);

if ($currentPage) {
$path = collect([]);
$temp = $currentPage;

while($temp->parent_id) {
$temp = \App\Models\Page::with('translations')->find($temp->parent_id);
if($temp) {
$path->prepend($temp);
} else {
break;
}
}

foreach($path as $ancestor) {
$breadcrumbs->push((object)[
'title' => $ancestor->translate($locale)->title ?? $ancestor->title,
'url' => $ancestor->getPath($locale),
'is_current' => false
]);
}

$breadcrumbs->push((object)[
'title' => $currentPage->translate($locale)->title ?? $currentPage->title,
'url' => $currentPage->getPath($locale),
'is_current' => true
]);
}
@endphp

<div class="w-full shrink-0 sticky top-[calc(var(--navbar-h)+1px)] border-b border-primary bg-primary/80 backdrop-blur-xl z-20">
    <div class="flex items-center h-navbar gap-2 px-4 ">
        <button
            data-aether-trigger="ui-control"
            data-aether-target="mobile-docs-sidebar"
            class="w-9 h-9 flex xl:hidden items-center justify-center rounded-full cursor-pointer hover:bg-primary-interactive text-primary transition-colors">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                <g id="SVGRepo_iconCarrier">
                    <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </g>
            </svg>
        </button>
        <nav class="flex h-full w-full overflow-x-auto" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 whitespace-nowrap">
                @foreach($breadcrumbs as $index => $crumb)
                @if($index > 0)
                <li class="shrink-0">
                    <svg class="w-4 h-4 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                @endif
                <li class="shrink-0">
                    @if($crumb->is_current)
                    <span class="text-sm font-semibold text-primary" aria-current="page">{{ $crumb->title }}</span>
                    @else
                    <a href="{{ $crumb->url }}" class="text-sm font-medium text-nowrap text-secondary hover:text-primary transition-colors duration-200">{{ $crumb->title }}</a>
                    @endif
                </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>

<div class="max-w-full mx-auto flex items-start gap-4 bg-[image:repeating-linear-gradient(315deg,_var(--pattern-fg)_0,_var(--pattern-fg)_1px,_transparent_0,_transparent_50%)] bg-[size:10px_10px] bg-fixed [--pattern-fg:var(--color-gray-950)]/5 dark:[--pattern-fg:var(--color-white)]/10">

    <aside class="hidden xl:block w-64 shrink-0 sticky top-[calc((var(--navbar-h)*2)+2px)] h-[calc(100vh-((var(--navbar-h)*2)+2px))] overflow-y-auto px-4 py-8 no-scrollbar border-r border-primary bg-primary">
        <nav>
            <div class="space-y-1">
                @foreach ($sidebarData as $item)
                @if(isset($item->type) && $item->type === 'group')
                <div class="my-8">
                    <h5 class="text-xs font-bold text-secondary uppercase tracking-wider mb-4">
                        {{ $item->title }}
                    </h5>
                    <ul class="space-y-3 border-l border-primary">
                        @foreach($item->items as $subItem)
                        <li>
                            <a href="{{ $subItem->url }}"
                                class="block pl-4 -ml-px border-l text-sm font-medium 
                                            {{ $subItem->isActive 
                                              ? 'text-primary border-black dark:border-white' 
                                              : 'text-tertiary border-transparent hover:border-primary-interactive hover:text-secondary transition-colors' 
                                            }}">
                                {{ $subItem->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @elseif(isset($item->type) && $item->type === 'single_link')
                <div>
                    <a href="{{ $item->url }}"
                        class="flex items-center gap-2.5  py-1.5 text-sm font-semibold transition-colors
                                      {{ $item->isActive 
                                         ? 'text-primary' 
                                         : 'text-secondary hover:text-primary' 
                                      }}">
                        <svg class="size-4" fill="currentColor" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.665 25.537c-1.966-1.094-3.116-2.962-3.232-4.673-0.619-9.164-15.889-10.357-23.662-19.509l-0 0c0.403 11.661 13.204 11.604 20.744 17.449-4.879-2.113-12.876-1.649-18.664-5.404 2.7 8.775 12.332 5.886 19.406 8.271-4.212-0.411-9.768 1.968-15.020 0.086 4.638 7.31 10.654 2.427 16.483 2.47-2.94 0.749-5.977 4.025-10.036 3.718 4.946 4.76 7.536 0.139 11.079-1.633-0.357 0.425-0.583 0.967-0.61 1.565-0.064 1.443 1.054 2.665 2.497 2.73s2.665-1.054 2.73-2.497c0.052-1.169-0.672-2.193-1.716-2.574z" />
                        </svg>
                        {{ $item->title }}
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </nav>
    </aside>

    <main class="min-h-[calc(100vh-((var(--navbar-h)*2)+2px))] w-full bg-primary border-primary xl:border-x xl:mr-4">
        <div class="max-w-7xl mx-auto py-4 px-4 xl:py-8 xl:px-16">
            <h1 class="text-3xl font-bold text-primary mb-4">{{ $viewModel->getTitle() }}</h1>
            {!! $viewModel->getContent() !!}
        </div>
    </main>
</div>

<aside id="mobile-docs-sidebar"
    class="hidden block w-64 shrink-0 fixed top-[calc((var(--navbar-h)*2)+2px)] h-[calc(100vh-((var(--navbar-h)*2)+2px))] overflow-y-auto px-4 py-8 no-scrollbar border-r border-primary bg-primary "
    data-aether-click-outside
    data-aether-scroll-lock
    data-aether-focus-trap>
    <nav>
        <div class="space-y-1">
            @foreach ($sidebarData as $item)
            @if(isset($item->type) && $item->type === 'group')
            <div class="my-8">
                <h5 class="text-xs font-bold text-secondary uppercase tracking-wider mb-4">
                    {{ $item->title }}
                </h5>
                <ul class="space-y-3 border-l border-primary">
                    @foreach($item->items as $subItem)
                    <li>
                        <a href="{{ $subItem->url }}"
                            class="block pl-4 -ml-px border-l text-sm font-medium 
                                            {{ $subItem->isActive 
                                              ? 'text-primary border-black dark:border-white' 
                                              : 'text-tertiary border-transparent hover:border-primary-interactive hover:text-secondary transition-colors' 
                                            }}">
                            {{ $subItem->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @elseif(isset($item->type) && $item->type === 'single_link')
            <div>
                <a href="{{ $item->url }}"
                    class="flex items-center gap-2.5  py-1.5 text-sm font-semibold transition-colors
                                      {{ $item->isActive 
                                         ? 'text-primary' 
                                         : 'text-secondary hover:text-primary' 
                                      }}">
                    <svg class="size-4" fill="currentColor" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.665 25.537c-1.966-1.094-3.116-2.962-3.232-4.673-0.619-9.164-15.889-10.357-23.662-19.509l-0 0c0.403 11.661 13.204 11.604 20.744 17.449-4.879-2.113-12.876-1.649-18.664-5.404 2.7 8.775 12.332 5.886 19.406 8.271-4.212-0.411-9.768 1.968-15.020 0.086 4.638 7.31 10.654 2.427 16.483 2.47-2.94 0.749-5.977 4.025-10.036 3.718 4.946 4.76 7.536 0.139 11.079-1.633-0.357 0.425-0.583 0.967-0.61 1.565-0.064 1.443 1.054 2.665 2.497 2.73s2.665-1.054 2.73-2.497c0.052-1.169-0.672-2.193-1.716-2.574z" />
                    </svg>
                    {{ $item->title }}
                </a>
            </div>
            @endif
            @endforeach
        </div>
    </nav>
</aside>


@endsection