@extends('layouts.default')

@section('content')

<section
    class="custom-site-gap relative overflow-hidden bg-primary border-b border-primary">
    <div class="absolute inset-0 pointer-events-none">

        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>

        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-accent/10 blur-[120px] rounded-full"></div>
        <div
            class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/10 blur-[100px] rounded-full"></div>

    </div>
    
    <div class="relative z-10 custom-container">
        <div class="grid xl:grid-cols-2 gap-12 xl:gap-20 items-center">
            <div class="text-center xl:text-left space-y-8 ">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-tertiary/50 border border-primary text-tertiary text-xs font-medium perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(2.5deg)_rotateY(-6deg)_rotateZ(1deg)_scale(1.05)]">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span
                            class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    @lang("v1.0.0 Sürümü Yayında")
                </div>

                <h1
                    class="text-5xl xl:text-7xl font-display font-bold tracking-tight text-primary leading-[1.1] perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)]">
                    @lang("Arayüzlerinizi") <br />
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-accent via-indigo-500 to-purple-600">@lang("Işık Hızında")</span>
                    @lang("Tasarlayın.")
                </h1>

                <p
                    class="text-base xl:text-xl text-secondary max-w-2xl mx-auto xl:mx-0 leading-relaxed perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(2.5deg)_rotateY(-6deg)_rotateZ(1deg)_scale(1.05)]">
                    @lang("AetherUI, modern web uygulamaları için geliştirilmiş, DOM manipülasyonunu minimize eden, utility-first bir JavaScript kontrolcüsüdür. Karmaşık state yönetimine son.")
                </p>

                <div
                    class="flex items-center justify-center xl:justify-start gap-2.5 xl:gap-4">
                    <a
                        href="https://github.com/xkintaro/aether-js"
                        target="_blank"
                        class="w-fit px-5 py-2.5 xl:px-8  xl:py-4 rounded-full bg-gradient-to-r from-accent/50 via-indigo-500/50 to-purple-600/50 text-primary border border-primary font-bold text-sm perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)] active:scale-95 flex items-center justify-center gap-2  ">
                        <svg class="size-6" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" d="M120.755 170c.03-4.669.059-20.874.059-27.29 0-9.272-3.167-15.339-6.719-18.41 22.051-2.464 45.201-10.863 45.201-49.067 0-10.855-3.824-19.735-10.175-26.683 1.017-2.516 4.413-12.63-.987-26.32 0 0-8.296-2.672-27.202 10.204-7.912-2.213-16.371-3.308-24.784-3.352-8.414.044-16.872 1.14-24.785 3.352C52.457 19.558 44.162 22.23 44.162 22.23c-5.4 13.69-2.004 23.804-.987 26.32C36.824 55.498 33 64.378 33 75.233c0 38.204 23.149 46.603 45.2 49.067-3.551 3.071-6.719 9.138-6.719 18.41 0 6.416.03 22.621.059 27.29M27 130c9.939.703 15.67 9.735 15.67 9.735 8.834 15.199 23.178 10.803 28.815 8.265" />
                            </g>
                        </svg>
                        GitHub
                    </a>
                    <a
                        href="https://discord.gg/NSQk27Zdkv"
                        target="_blank"
                        class="w-fit px-5 py-2.5 xl:px-8  xl:py-4 rounded-full bg-tertiary/50 text-secondary border border-primary font-bold text-sm perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)] active:scale-95 flex items-center justify-center gap-2  ">
                        <svg class="size-6" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" d="m68 138-8 16c-10.19-4.246-20.742-8.492-31.96-15.8-3.912-2.549-6.284-6.88-6.378-11.548-.488-23.964 5.134-48.056 19.369-73.528 1.863-3.334 4.967-5.778 8.567-7.056C58.186 43.02 64.016 40.664 74 39l6 11s6-2 16-2 16 2 16 2l6-11c9.984 1.664 15.814 4.02 24.402 7.068 3.6 1.278 6.704 3.722 8.567 7.056 14.235 25.472 19.857 49.564 19.37 73.528-.095 4.668-2.467 8.999-6.379 11.548-11.218 7.308-21.769 11.554-31.96 15.8l-8-16m-68-8s20 10 40 10 40-10 40-10" />
                                <ellipse cx="71" cy="101" fill="currentColor" rx="13" ry="15" />
                                <ellipse cx="121" cy="101" fill="currentColor" rx="13" ry="15" />
                            </g>
                        </svg>
                        Discord
                    </a>
                </div>

                <div class="flex w-full xl:w-fit items-center gap-3 pt-4 justify-center xl:justify-start text-left perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(2.5deg)_rotateY(-6deg)_rotateZ(1deg)_scale(1.05)] cursor-default ">
                    <div class="relative">
                        <img src="https://avatars.githubusercontent.com/u/118665344" alt="User" class="w-10 h-10 rounded-full border-2 border-primary shadow-sm">
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-primary rounded-full"></div>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-primary leading-none">
                            Kintaro
                        </div>
                        <div class="text-xs text-tertiary mt-1">
                            @lang("Tarafından geliştirildi.")
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute w-full left-0 -z-10 opacity-10 xl:relative xl:w-auto xl:left-auto xl:z-auto xl:opacity-100 pointer-events-none xl:pointer-events-auto group perspective-[1500px]">

                <div
                    class="absolute -inset-4 bg-gradient-to-r from-accent/10 to-purple-500/10 rounded-[40px] blur-2xl -z-10 transition-opacity duration-500 group-hover:opacity-75"></div>

                <div class="bg-transparent xl:bg-primary/70 xl:backdrop-blur-xl rounded-none xl:rounded-3xl xl:border xl:border-primary overflow-hidden transition-all duration-500 ease-out transform-gpu group-hover:[transform:rotateX(2.5deg)_rotateY(-6deg)_rotateZ(1deg)_scale(1.05)]">
                    <div class="hidden xl:flex bg-primary/50 items-center justify-between px-6 py-4 border-b border-primary">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 rounded-full bg-red-400/80">&nbsp;</div>
                            <div class="w-3 h-3 rounded-full bg-amber-400/80">&nbsp;</div>
                            <div class="w-3 h-3 rounded-full bg-green-400/80">&nbsp;</div>
                        </div>
                        <div class="text-xs text-tertiary font-mono">index.html</div>
                    </div>
                    <div class="p-6 max-h-[600px] xl:overflow-auto">
                        <pre class="font-mono text-[13px] leading-6 text-code-prop"><span class="text-code-muted">&lt;!-- Wrapper --&gt;</span>
<span class="text-code-tag">&lt;div</span> <span class="text-code-prop highlight-marker">data-aether-ui</span>=<span class="text-code-value">"tab-group"</span><span class="text-code-tag">&gt;</span>

    <span class="text-code-muted">&lt;!-- Triggers --&gt;</span>
    <span class="text-code-tag">&lt;div</span> <span class="text-code-prop">class</span>=<span class="text-code-value">"flex gap-4"</span><span class="text-code-tag">&gt;</span>
        <span class="text-code-tag">&lt;button</span> <span class="text-code-prop">data-aether-trigger</span>=<span class="text-code-value">"tab"</span> <span class="text-code-prop">data-aether-target</span>=<span class="text-code-value">"general"</span><span class="text-code-tag">&gt;</span>General<span class="text-code-tag">&lt;/button&gt;</span>
        <span class="text-code-tag">&lt;button</span> <span class="text-code-prop">data-aether-trigger</span>=<span class="text-code-value">"tab"</span> <span class="text-code-prop">data-aether-target</span>=<span class="text-code-value">"security"</span><span class="text-code-tag">&gt;</span>Security<span class="text-code-tag">&lt;/button&gt;</span>
    <span class="text-code-tag">&lt;/div&gt;</span>

    <span class="text-code-muted">&lt;!-- Panels --&gt;</span>
    <span class="text-code-tag">&lt;div</span> <span class="text-code-prop">id</span>=<span class="text-code-value">"general"</span> <span class="text-code-prop highlight-marker">data-aether-ui</span>=<span class="text-code-value">"tab-panel"</span><span class="text-code-tag">&gt;</span>
        <span class="text-code-muted">General...</span>
    <span class="text-code-tag">&lt;/div&gt;</span>

    <span class="text-code-tag">&lt;div</span> <span class="text-code-prop">id</span>=<span class="text-code-value">"security"</span> <span class="text-code-prop highlight-marker">data-aether-ui</span>=<span class="text-code-value">"tab-panel"</span><span class="text-code-tag">&gt;</span>
        <span class="text-code-muted">Security...</span>
    <span class="text-code-tag">&lt;/div&gt;</span>

<span class="text-code-tag">&lt;/div&gt;</span></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="custom-site-gap relative bg-primary border-t border-primary overflow-hidden">

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-accent/20 blur-[150px] rounded-full pointer-events-none"></div>

    <div class="custom-container relative z-10 perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(2.5deg)_rotateY(-6deg)_rotateZ(1deg)_scale(1.05)]">
        <div class="relative bg-primary/50 backdrop-blur-xl border border-primary rounded-3xl p-12 xl:p-24 text-center overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-5 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:60px_60px] opacity-20"></div>

            <div class="relative z-10 max-w-3xl mx-auto space-y-10">
                <h2 class="text-3xl md:text-5xl xl:text-7xl font-display font-bold text-primary tracking-tight leading-tight perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)]">
                    @lang("Hazır mısınız?") <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent via-indigo-500 to-purple-600">@lang("Projenizi Ateşleyin.")</span>
                </h2>

                <p class="text-base xl:text-xl text-secondary leading-relaxed xl:max-w-xl mx-auto perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)]">
                    @lang("Bağımlılık yok. Karmaşık ayarlar yok. Sadece saf, performanslı ve yönetilebilir arayüzler var.")
                </p>

                <a href="{{ Storage::url((json_decode(setting('site.aetherjs'), true)[0]['download_link'] ?? json_decode(setting('site.aetherjs'), true)['download_link']) ?? setting('site.aetherjs')) }}"
                    download="{{ (json_decode(setting('site.aetherjs'), true)[0]['original_name'] ?? json_decode(setting('site.aetherjs'), true)['original_name']) ?? 'file.js' }}"
                    class="inline-flex items-center gap-4 p-2 pl-6 bg-secondary border border-primary rounded-2xl backdrop-blur-xl hover:border-indigo-500/50 cursor-pointer perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)]">
                    <code class="font-mono text-sm xl:text-lg text-transparent bg-clip-text bg-gradient-to-r from-accent via-indigo-500 to-purple-600">@lang("Aether.js Dosyasını İndir")</code>
                    <div class="p-2 rounded-xl bg-tertiary hover:bg-tertiary-interactive text-primary transition-colors cursor-pointer">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <path d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5" stroke="currentColor" stroke-width="1.5" />
                            </g>

                        </svg>
                    </div>
                </a>

                <div
                    class="flex items-center justify-center gap-2.5 xl:gap-4">
                    <a
                        href="https://github.com/xkintaro/aether-js"
                        target="_blank"
                        class="w-fit px-5 py-2.5 xl:px-8  xl:py-4 rounded-full bg-gradient-to-r from-accent/50 via-indigo-500/50 to-purple-600/50 text-primary border border-primary font-bold text-sm perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)] active:scale-95 flex items-center justify-center gap-2  ">
                        <svg class="size-6" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" d="M120.755 170c.03-4.669.059-20.874.059-27.29 0-9.272-3.167-15.339-6.719-18.41 22.051-2.464 45.201-10.863 45.201-49.067 0-10.855-3.824-19.735-10.175-26.683 1.017-2.516 4.413-12.63-.987-26.32 0 0-8.296-2.672-27.202 10.204-7.912-2.213-16.371-3.308-24.784-3.352-8.414.044-16.872 1.14-24.785 3.352C52.457 19.558 44.162 22.23 44.162 22.23c-5.4 13.69-2.004 23.804-.987 26.32C36.824 55.498 33 64.378 33 75.233c0 38.204 23.149 46.603 45.2 49.067-3.551 3.071-6.719 9.138-6.719 18.41 0 6.416.03 22.621.059 27.29M27 130c9.939.703 15.67 9.735 15.67 9.735 8.834 15.199 23.178 10.803 28.815 8.265" />
                            </g>
                        </svg>
                        GitHub
                    </a>
                    <a
                        href="https://discord.gg/NSQk27Zdkv"
                        target="_blank"
                        class="w-fit px-5 py-2.5 xl:px-8  xl:py-4 rounded-full bg-tertiary/50 text-secondary border border-primary font-bold text-sm perspective-[1500px] transition-all duration-500 ease-out transform-gpu hover:[transform:rotateX(-2.5deg)_rotateY(6deg)_rotateZ(-1deg)_scale(1.05)] active:scale-95 flex items-center justify-center gap-2  ">
                        <svg class="size-6" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" d="m68 138-8 16c-10.19-4.246-20.742-8.492-31.96-15.8-3.912-2.549-6.284-6.88-6.378-11.548-.488-23.964 5.134-48.056 19.369-73.528 1.863-3.334 4.967-5.778 8.567-7.056C58.186 43.02 64.016 40.664 74 39l6 11s6-2 16-2 16 2 16 2l6-11c9.984 1.664 15.814 4.02 24.402 7.068 3.6 1.278 6.704 3.722 8.567 7.056 14.235 25.472 19.857 49.564 19.37 73.528-.095 4.668-2.467 8.999-6.379 11.548-11.218 7.308-21.769 11.554-31.96 15.8l-8-16m-68-8s20 10 40 10 40-10 40-10" />
                                <ellipse cx="71" cy="101" fill="currentColor" rx="13" ry="15" />
                                <ellipse cx="121" cy="101" fill="currentColor" rx="13" ry="15" />
                            </g>
                        </svg>
                        Discord
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>

@include("components.footer")

@endsection