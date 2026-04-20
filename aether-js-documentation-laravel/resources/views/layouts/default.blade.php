<!DOCTYPE html>
<html lang="{{ $locale }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>AetherJS</title>
    <meta name="description" content="x">

    <link rel="icon" type="image/png" href="{{ Storage::url(setting('site.favicon')) }}">
</head>

<body class="bg-primary text-primary selection:bg-accent/90 selection:text-inverse min-h-screen" data-aether-auto>

    <div class="fixed -z-10 -left-5 -top-5 bg-accent/20 blur-3xl rounded-full size-[200px] scale-[1.5] animate-pulse">
    </div>
    <div
        class="fixed -z-10 -right-5 -bottom-5 bg-accent/20 blur-3xl rounded-full size-[200px] scale-[1.5] animate-pulse">
    </div>

    <x-navbar :locale="$locale" />


    <div class="pt-[calc(var(--navbar-h))] min-h-screen">
        @yield('content')
    </div>

    <script>
        document.addEventListener("aether:theme-change", (e) => {
            const currentTheme = e.detail.theme;

            document
                .querySelectorAll(".theme-btn")
                .forEach((btn) => btn.classList.remove("active"));

            const activeBtn = document.querySelector(
                `[data-aether-theme="${currentTheme}"]`
            );
            if (activeBtn) activeBtn.classList.add("active");
        });

        window.addEventListener("DOMContentLoaded", () => {
            const savedTheme = localStorage.getItem("theme") || "system";
            const btn = document.querySelector(
                `[data-aether-theme="${savedTheme}"]`
            );
            if (btn) btn.classList.add("active");
        });
    </script>
</body>

</html>