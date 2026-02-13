<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Historial - GlowUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        html { font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Apple Color Emoji', 'Segoe UI Emoji'; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        .tap { min-height: 44px; min-width: 44px; }
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
    </style>
    @livewireStyles
</head>

<body class="h-full bg-gradient-to-b from-white to-slate-50 dark:from-neutral-900 dark:to-neutral-950 text-slate-900 dark:text-slate-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="sticky top-0 z-40 backdrop-blur supports-[backdrop-filter]:bg-white/70 bg-white/90 dark:bg-neutral-900/80 border-b border-slate-200/70 dark:border-neutral-800">
            <div class="mx-auto max-w-screen-sm px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="tap rounded-lg p-1 hover:bg-slate-100 dark:hover:bg-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h1 class="font-semibold text-lg">Historial</h1>
                </div>
            </div>
        </header>

        <!-- Contenido -->
        <main class="flex-1 mx-auto w-full max-w-screen-sm px-4 pt-5 pb-24">
            @livewire('historial')
        </main>

        <!-- Bottom Tab Bar -->
        @include('partials.bottom-nav')
    </div>

    @livewireScripts
</body>
</html>
