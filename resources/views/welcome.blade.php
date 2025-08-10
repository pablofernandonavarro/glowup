@php
    // Mantengo tu estructura de secciones
    $sections = [
        [ 'name' => 'Datos',     'icon' => 'chart-bar',               'url' => route('datos', false) ],
        [ 'name' => 'Gráficos',  'icon' => 'presentation-chart-line', 'url' => route('graficos', false) ],
        [ 'name' => 'Historial', 'icon' => 'clock',                   'url' => route('historial', false) ],
        [ 'name' => 'Ayuda',     'icon' => 'question-mark-circle',    'url' => route('ayuda', false) ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>GlowUp</title>

    {{-- Tailwind CDN (puedes reemplazar por @vite en prod) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Fuente legible en mobile --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <style>
        html { font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Apple Color Emoji', 'Segoe UI Emoji'; }
        /* Safe area para iOS */
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        /* Tap targets accesibles */
        .tap { min-height: 44px; min-width: 44px; }
        /* Suaviza animaciones para usuarios con reducción de movimiento */
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
    </style>
</head>

@php
    $sections = [
        [ 'name' => 'Datos',     'icon' => 'chart-bar',               'url' => route('datos', false) ],
        [ 'name' => 'Gráficos',  'icon' => 'presentation-chart-line', 'url' => route('graficos', false) ],
        [ 'name' => 'Historial', 'icon' => 'clock',                   'url' => route('historial', false) ],
        [ 'name' => 'Ayuda',     'icon' => 'question-mark-circle',    'url' => route('ayuda', false) ],
    ];
    $userPhoto = auth()->user()->profile_photo_url ?? 'https://via.placeholder.com/40';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>GlowUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        html { font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Apple Color Emoji', 'Segoe UI Emoji'; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        .tap { min-height: 44px; min-width: 44px; }
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
    </style>
</head>

<body class="h-full bg-gradient-to-b from-white to-slate-50 dark:from-neutral-900 dark:to-neutral-950 text-slate-900 dark:text-slate-100">
    <div class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-40 backdrop-blur supports-[backdrop-filter]:bg-white/70 bg-white/90 dark:bg-neutral-900/80 border-b border-slate-200/70 dark:border-neutral-800">
            <div class="mx-auto max-w-screen-sm px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="size-8 rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m9-9H3"/></svg>
                    </div>
                    <span class="font-semibold text-lg tracking-tight">GlowUp</span>
                    <img src="{{ $userPhoto }}" alt="Foto de usuario" class="size-9 rounded-full border border-slate-200 dark:border-neutral-700 object-cover" />
                </div>
                <a href="#" class="tap rounded-lg px-2 py-1 hover:bg-slate-100 dark:hover:bg-neutral-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-500" aria-label="Preferencias">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M10.5 6h.01M6 6h.01M14.5 6h.01M4 12h16M4 18h10"/></svg>
                </a>
            </div>
        </header>
        <!-- Contenido -->
        <main class="flex-1 mx-auto w-full max-w-screen-sm px-4 pt-5 pb-24">
            <!-- Tarjeta de bienvenida / CTA -->
            <section class="rounded-2xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 dark:from-fuchsia-500/15 dark:via-indigo-500/15 dark:to-blue-500/15 border border-slate-200 dark:border-neutral-800 p-4 sm:p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="size-10 rounded-xl bg-white/80 dark:bg-neutral-800 grid place-items-center shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-fuchsia-600"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12h18M12 3v18"/></svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold leading-tight">Bienvenido 👋</h1>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Registrá tu peso y seguí tu progreso de forma simple.</p>
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <a href="{{ route('datos', false) }}" class="tap rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 px-4 py-3 flex items-center justify-between shadow-sm hover:shadow transition">
                        <span class="text-sm font-medium">Cargar peso</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/></svg>
                    </a>
                    <a href="{{ route('graficos', false) }}" class="tap rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 px-4 py-3 flex items-center justify-between shadow-sm hover:shadow transition">
                        <span class="text-sm font-medium">Ver gráficos</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l4-3 4 5 5-8 5 6"/></svg>
                    </a>
                </div>
            </section>

            <!-- Mosaico de secciones -->
            <section class="mt-6 grid grid-cols-2 gap-3">
                @foreach ($sections as $section)
                    @php $active = request()->is(ltrim($section['url'], '/')); @endphp
                    <a href="{{ $section['url'] }}"
                       class="group tap rounded-2xl p-4 border border-slate-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 shadow-sm hover:shadow transition flex flex-col items-start gap-3 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-500"
                       aria-current="{{ $active ? 'page' : 'false' }}">
                        <div class="size-9 rounded-lg grid place-items-center bg-slate-50 dark:bg-neutral-800">
                            @if($section['icon'] === 'chart-bar')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-indigo-600 group-hover:scale-110 transition"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20V9m6 11V6m6 14v-8"/></svg>
                            @elseif($section['icon'] === 'presentation-chart-line')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-fuchsia-600 group-hover:scale-110 transition"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 4h18M4 8h16v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Zm3 7 4-3 4 3 4-6"/></svg>
                            @elseif($section['icon'] === 'clock')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-amber-600 group-hover:scale-110 transition"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @elseif($section['icon'] === 'question-mark-circle')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-blue-600 group-hover:scale-110 transition"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.5 9a3.5 3.5 0 1 1 5.6 2.8c-.7.5-1.1 1-1.1 1.7V14M12 17h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-medium text-sm">{{ $section['name'] }}</span>
                            @if($active)
                                <span class="sr-only">(actual)</span>
                            @endif
                        </div>
                        <span class="mt-auto text-xs text-slate-500 dark:text-slate-400">Entrar</span>
                    </a>
                @endforeach
            </section>

            <!-- Espacio para más módulos -->
            <div class="h-6"></div>
        </main>

        <!-- FAB (acción principal) -->
        <div class="fixed bottom-20 right-5 sm:right-6 z-50">
            <a href="{{ route('datos', false) }}" class="tap size-14 rounded-full shadow-lg shadow-fuchsia-500/20 bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white grid place-items-center hover:scale-105 active:scale-95 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" aria-label="Nueva carga de peso">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </a>
        </div>

        <!-- Bottom Tab Bar (sticky) -->
        <nav role="navigation" aria-label="Navegación inferior"
             class="fixed bottom-0 inset-x-0 z-40 bg-white/95 dark:bg-neutral-900/95 backdrop-blur border-t border-slate-200 dark:border-neutral-800 pb-safe">
            <ul class="mx-auto max-w-screen-sm grid grid-cols-4">
                @foreach ($sections as $section)
                    @php $active = request()->is(ltrim($section['url'], '/')); @endphp
                    <li>
                        <a href="{{ $section['url'] }}" class="tap flex flex-col items-center justify-center gap-1 py-2 {{ $active ? 'text-indigo-600' : 'text-slate-600 dark:text-slate-300' }} hover:bg-slate-50/60 dark:hover:bg-neutral-800/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-500">
                            <span class="sr-only">Ir a {{ $section['name'] }}</span>
                            @if($section['icon'] === 'chart-bar')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20V9m6 11V6m6 14v-8"/></svg>
                            @elseif($section['icon'] === 'presentation-chart-line')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 4h18M4 8h16v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Zm3 7 4-3 4 3 4-6"/></svg>
                            @elseif($section['icon'] === 'clock')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @elseif($section['icon'] === 'question-mark-circle')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.5 9a3.5 3.5 0 1 1 5.6 2.8c-.7.5-1.1 1-1.1 1.7V14M12 17h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
                            @endif
                            <span class="text-[11px] leading-none font-medium">{{ $section['name'] }}</span>
                            @if($active)
                                <span class="sr-only">(actual)</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    {{-- Opcional: auth links compactos si usas Breeze/Jetstream --}}
    @if (Route::has('login'))
        <div class="fixed top-3 right-3 hidden sm:flex items-center gap-2">
            @auth
                <a href="{{ url('/dashboard') }}" class="tap rounded-lg px-3 py-1.5 text-xs border border-slate-200 dark:border-neutral-700 hover:bg-slate-50 dark:hover:bg-neutral-800">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="tap rounded-lg px-3 py-1.5 text-xs border border-transparent hover:border-slate-200 dark:hover:border-neutral-700">Ingresar</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="tap rounded-lg px-3 py-1.5 text-xs border border-slate-200 dark:border-neutral-700 hover:bg-slate-50 dark:hover:bg-neutral-800">Registro</a>
                @endif
            @endauth
        </div>
    @endif
</body>
</html>
