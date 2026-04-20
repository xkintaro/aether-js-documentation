@php
$linksCollection = collect($links);
$activeLink = $linksCollection->firstWhere('isActive', true);
$otherLinks = $linksCollection->where('isActive', false);
@endphp
<div data-aether-ui="accordion-group">
    <button
        data-aether-trigger="accordion"
        data-aether-target="acc-language-offcanvas"
        class="w-full flex items-center cursor-pointer justify-between px-3 py-2 rounded-lg border border-primary hover:border-primary-interactive bg-transparent text-sm text-secondary hover:text-primary group transition-colors">
        <div class="flex items-center gap-2">
            @if ($activeLink)
            <img src="{{ asset('assets/flags/' . $activeLink->code . '.png') }}"
                alt="{{ $activeLink->code }} @lang('Bayrak')"
                class="w-5 h-5 rounded-full object-cover border border-primary/20">
            <span class="font-medium uppercase">{{ $activeLink->code }}</span>
            @else
            <i class="ph-duotone ph-globe text-tertiary"></i>
            <span>@lang('Dil Seç')</span>
            @endif
        </div>
        <svg class="size-4 text-xs fill-current text-tertiary group-aria-expanded:rotate-180 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
        </svg>
    </button>
    <div
        id="acc-language-offcanvas"
        data-aether-ui="accordion-panel"
        class="hidden overflow-hidden">
        <div class="pl-10 pr-2 py-1 space-y-1 border-l border-primary ml-5 mt-1">
            @foreach ($otherLinks as $link)
            <a href="{{ $link->url }}"
                class="flex items-center gap-2 py-1.5 text-sm text-tertiary hover:text-primary transition-colors">
                <img src="{{ asset('assets/flags/' . $link->code . '.png') }}"
                    alt="{{ $link->code }} @lang('Bayrak')"
                    class="w-4 h-4 rounded-full object-cover opacity-70">
                <span class="uppercase">{{ $link->code }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>