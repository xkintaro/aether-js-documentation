<!-- Navbar -->
<header class="fixed top-0 w-full z-50 border-b border-primary bg-primary/80 backdrop-blur-xl">
    <div
        class="{{ request()->routeIs('index') ? 'custom-container' : 'max-w-full mx-auto px-4' }} h-navbar flex items-center justify-between">
        <a href="{{ route('index', ['locale' => app()->getLocale()]) }}" class="flex items-center gap-2.5 group">
            <img src="{{ Storage::url(setting('site.logo')) }}" alt="{{ setting('site.title') }}"
                class="size-8 sm:size-10" />
            <span class="font-display font-bold text-lg tracking-tight text-primary">
                Aether<span class="text-accent">JS</span>
            </span>
        </a>
        <nav class="flex items-center gap-2">
            <div class="hidden xl:flex items-center gap-2">
                @foreach ($menuItems as $item)
                    <div class="relative group">
                        <a href="{{ $item->url }}" @if ($item->children->isNotEmpty()) data-aether-trigger="ui-control"
                        data-aether-target="nav-menu-{{ $item->url }}" @endif
                            class="px-3 py-2 inline-flex items-center text-sm font-medium text-secondary hover:text-primary hover:underline transition-colors">
                            {{ $item->title }}
                            @if ($item->children->isNotEmpty())
                                <svg class="ml-1 w-4 h-4 fill-current opacity-70" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            @endif
                        </a>
                        @if ($item->children->isNotEmpty())
                            <div id="nav-menu-{{ $item->url }}" data-aether-click-outside
                                class="hidden absolute top-full right-0 mt-2 w-72 py-2 bg-secondary border border-primary rounded-xl shadow-xl origin-top-right z-60">
                                <div class="px-4 py-1.5 mb-1 text-[10px] font-bold text-tertiary uppercase tracking-wider">
                                    {{ $item->title }}
                                </div>
                                @foreach ($item->children as $child)
                                    <a href="{{ $child->url }}"
                                        class="flex items-start gap-3 px-4 py-2 hover:bg-secondary-interactive transition-colors">
                                        <div>
                                            <div class="text-sm font-medium text-secondary">
                                                {{ $child->title }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
                <a href="{{ Storage::url((json_decode(setting('site.aetherjs'), true)[0]['download_link'] ?? json_decode(setting('site.aetherjs'), true)['download_link']) ?? setting('site.aetherjs')) }}"
                    download="{{ (json_decode(setting('site.aetherjs'), true)[0]['original_name'] ?? json_decode(setting('site.aetherjs'), true)['original_name']) ?? 'file.js' }}"
                    class="w-fit px-4 py-1.5 rounded-full bg-gradient-to-r from-accent/50 via-indigo-500/50 to-purple-600/50 text-primary border border-primary text-sm hover:brightness-150 transition-all duration-300 ">
                    @lang("İndir")
                </a>
            </div>
            <button data-aether-trigger="ui-control" data-aether-target="offcanvas"
                class="w-9 h-9 flex items-center justify-center rounded-full cursor-pointer hover:bg-primary-interactive text-primary transition-colors">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                    <g id="SVGRepo_iconCarrier">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                </svg>
            </button>
        </nav>
    </div>
</header>
<!-- Navbar End -->

<!-- Offcanvas -->
<div id="offcanvas" data-aether-scroll-lock data-aether-click-outside data-aether-focus-trap
    class="hidden fixed inset-0 z-[100] flex justify-end">
    <div class="absolute inset-0 bg-primary/50 backdrop-blur-sm" data-aether-trigger="ui-control"
        data-aether-target="offcanvas"></div>
    <div
        class="relative w-full max-w-[400px] h-full xl:border-l border-primary bg-primary/80 backdrop-blur-xl shadow-2xl flex flex-col">
        <div class="p-5 border-b border-primary flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <img src="https://avatars.githubusercontent.com/u/118665344" alt="User"
                        class="w-10 h-10 rounded-full border-2 border-primary shadow-sm" />
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-primary rounded-full">
                    </div>
                </div>
                <div>
                    <div class="text-sm font-bold text-primary leading-none">
                        Kintaro
                    </div>
                    <div class="text-xs text-tertiary mt-1">
                        AetherJS •
                        <a href="#" class="text-accent hover:underline">v1.0.0</a>
                    </div>
                </div>
            </div>
            <button data-aether-trigger="ui-control" data-aether-target="offcanvas"
                class="size-8 p-1 flex items-center justify-center rounded-full cursor-pointer hover:bg-tertiary-interactive text-primary transition-colors">
                <svg class="size-full" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                    <g id="SVGRepo_iconCarrier">
                        <g id="Menu / Close_MD">
                            <path id="Vector" d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </g>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-5 space-y-6 no-scrollbar">
            <div class="space-y-1">
                <div class="text-[10px] font-bold text-tertiary uppercase tracking-wider px-2 mb-2">
                    @lang("Tema")
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <button data-aether-theme="system" aria-label="System Mode"
                        class="theme-btn group cursor-pointer flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 bg-tertiary border-primary text-secondary hover:border-blue-500/30 hover:bg-blue-500/10 hover:text-blue-500 [&.active]:border-blue-500 [&.active]:bg-blue-500/10 [&.active]:text-blue-500">
                        <svg class="size-5 mb-1.5 text-tertiary transition-colors group-hover:text-blue-500 group-[.active]:text-blue-500"
                            viewBox="-0.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="currentColor">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <title>desktop</title>
                                <desc>Created with Sketch Beta.</desc>
                                <defs> </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    sketch:type="MSPage">
                                    <g id="Icon-Set" sketch:type="MSLayerGroup"
                                        transform="translate(-568.000000, -463.000000)" fill="currentColor">
                                        <path
                                            d="M597,481 L570,481 L570,467 C570,465.896 570.896,465 572,465 L595,465 C596.104,465 597,465.896 597,467 L597,481 L597,481 Z M597,485 C597,486.104 596.104,487 595,487 L572,487 C570.896,487 570,486.104 570,485 L570,483 L597,483 L597,485 L597,485 Z M582,489 L586,489 L586,493 L582,493 L582,489 Z M595,463 L572,463 C569.791,463 568,464.791 568,467 L568,485 C568,487.209 569.791,489 572,489 L580,489 L580,493 L578,493 C577.447,493 577,493.448 577,494 C577,494.553 577.447,495 578,495 L590,495 C590.553,495 591,494.553 591,494 C591,493.448 590.553,493 590,493 L588,493 L588,489 L595,489 C597.209,489 599,487.209 599,485 L599,467 C599,464.791 597.209,463 595,463 L595,463 Z"
                                            id="desktop" sketch:type="MSShapeGroup"> </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="text-xs font-medium">@lang("Sistem")</span>
                    </button>
                    <button data-aether-theme="light" aria-label="Light Mode"
                        class="theme-btn group cursor-pointer flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 bg-tertiary border-primary text-secondary hover:border-amber-500/30 hover:bg-amber-500/10 hover:text-amber-500 [&.active]:border-amber-500 [&.active]:bg-amber-500/10 [&.active]:text-amber-500">
                        <svg class="size-5 mb-1.5 text-tertiary transition-colors group-hover:text-amber-500 group-[.active]:text-amber-500"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M7.28451 10.3333C7.10026 10.8546 7 11.4156 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7C11.4156 7 10.8546 7.10026 10.3333 7.28451"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M12 2V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M12 20V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M4 12L2 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M22 12L20 12" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M19.7778 4.22266L17.5558 6.25424" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M4.22217 4.22266L6.44418 6.25424" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M6.44434 17.5557L4.22211 19.7779" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M19.7778 19.7773L17.5558 17.5551" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </g>
                        </svg>
                        <span class="text-xs font-medium">@lang("Aydınlık")</span>
                    </button>
                    <button data-aether-theme="dark" aria-label="Dark Mode"
                        class="theme-btn group cursor-pointer flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 bg-tertiary border-primary text-secondary hover:border-indigo-500/30 hover:bg-indigo-500/10 hover:text-indigo-500 [&.active]:border-indigo-500 [&.active]:bg-indigo-500/10 [&.active]:text-indigo-500">
                        <svg class="size-5 mb-1.5 text-tertiary transition-colors group-hover:text-indigo-500 group-[.active]:text-indigo-500"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M21.0672 11.8568L20.4253 11.469L21.0672 11.8568ZM12.1432 2.93276L11.7553 2.29085V2.29085L12.1432 2.93276ZM21.25 12C21.25 17.1086 17.1086 21.25 12 21.25V22.75C17.9371 22.75 22.75 17.9371 22.75 12H21.25ZM12 21.25C6.89137 21.25 2.75 17.1086 2.75 12H1.25C1.25 17.9371 6.06294 22.75 12 22.75V21.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75V1.25C6.06294 1.25 1.25 6.06294 1.25 12H2.75ZM15.5 14.25C12.3244 14.25 9.75 11.6756 9.75 8.5H8.25C8.25 12.5041 11.4959 15.75 15.5 15.75V14.25ZM20.4253 11.469C19.4172 13.1373 17.5882 14.25 15.5 14.25V15.75C18.1349 15.75 20.4407 14.3439 21.7092 12.2447L20.4253 11.469ZM9.75 8.5C9.75 6.41182 10.8627 4.5828 12.531 3.57467L11.7553 2.29085C9.65609 3.5593 8.25 5.86509 8.25 8.5H9.75ZM12 2.75C11.9115 2.75 11.8077 2.71008 11.7324 2.63168C11.6686 2.56527 11.6538 2.50244 11.6503 2.47703C11.6461 2.44587 11.6482 2.35557 11.7553 2.29085L12.531 3.57467C13.0342 3.27065 13.196 2.71398 13.1368 2.27627C13.0754 1.82126 12.7166 1.25 12 1.25V2.75ZM21.7092 12.2447C21.6444 12.3518 21.5541 12.3539 21.523 12.3497C21.4976 12.3462 21.4347 12.3314 21.3683 12.2676C21.2899 12.1923 21.25 12.0885 21.25 12H22.75C22.75 11.2834 22.1787 10.9246 21.7237 10.8632C21.286 10.804 20.7293 10.9658 20.4253 11.469L21.7092 12.2447Z"
                                    fill="currentColor" />
                            </g>
                        </svg>
                        <span class="text-xs font-medium">@lang("Karanlık")</span>
                    </button>
                </div>
            </div>
            <div class="space-y-1">
                <div class="text-[10px] font-bold text-tertiary uppercase tracking-wider px-2 mb-2">
                    @lang('Navigasyon')
                </div>
                @foreach ($menuItems as $item)
                    @if ($item->children->isNotEmpty())
                        <div data-aether-ui="accordion-group">
                            <button data-aether-trigger="accordion" data-aether-target="offcanvas-menu-{{ $item->url }}"
                                class="w-full flex items-center justify-between cursor-pointer px-3 py-2.5 rounded-lg hover:bg-tertiary-interactive text-secondary hover:text-primary group transition-colors">
                                <span class="text-sm font-medium">{{ $item->title }}</span>
                                <svg class="size-4 text-xs fill-current text-tertiary group-aria-expanded:rotate-180 transition-transform"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="offcanvas-menu-{{ $item->url }}" data-aether-ui="accordion-panel"
                                class="hidden overflow-hidden">

                                <div class="pl-10 pr-2 py-1 space-y-1 border-l border-primary ml-5">
                                    @foreach ($item->children as $child)
                                        <a href="{{ $child->url }}"
                                            class="block py-1.5 text-sm text-tertiary hover:text-primary transition-colors">
                                            {{ $child->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ $item->url }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-tertiary-interactive text-secondary hover:text-primary transition-colors">
                            <span class="text-sm font-medium">{{ $item->title }}</span>
                        </a>
                    @endif
                @endforeach
                <a href="{{ Storage::url((json_decode(setting('site.aetherjs'), true)[0]['download_link'] ?? json_decode(setting('site.aetherjs'), true)['download_link']) ?? setting('site.aetherjs')) }}"
                    download="{{ (json_decode(setting('site.aetherjs'), true)[0]['original_name'] ?? json_decode(setting('site.aetherjs'), true)['original_name']) ?? 'file.js' }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-tertiary-interactive text-secondary hover:text-primary transition-colors">
                    <span class="text-sm font-medium">@lang("İndir")</span>
                </a>
            </div>
        </div>
        <div class="p-5 border-t border-primary  space-y-4">
            <x-language-switcher :locale="$locale" :viewModel="$viewModel ?? null" uniqueId="desktop" />
        </div>
    </div>
</div>
<!-- Offcanvas End -->