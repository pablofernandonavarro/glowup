<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - GlowUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        html { font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial; }
    </style>
</head>
<body class="h-full bg-gradient-to-b from-white to-slate-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white border-b border-slate-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="size-8 rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m9-9H3"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-lg text-slate-900">GlowUp</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-sm text-slate-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-slate-600 hover:text-slate-900">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Dashboard</h1>
                <p class="mt-2 text-slate-600">Bienvenido a GlowUp, {{ auth()->user()->name }}</p>
            </div>

            <!-- Quick actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('datos') }}" class="block p-6 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="size-10 rounded-lg bg-indigo-50 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-indigo-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20V9m6 11V6m6 14v-8"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-slate-900">Cargar Datos</h3>
                    <p class="text-sm text-slate-600 mt-1">Registrá tu peso</p>
                </a>

                <a href="{{ route('graficos') }}" class="block p-6 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="size-10 rounded-lg bg-fuchsia-50 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-fuchsia-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 4h18M4 8h16v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Zm3 7 4-3 4 3 4-6"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-slate-900">Gráficos</h3>
                    <p class="text-sm text-slate-600 mt-1">Ver progreso</p>
                </a>

                <a href="{{ route('historial') }}" class="block p-6 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="size-10 rounded-lg bg-amber-50 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-amber-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-slate-900">Historial</h3>
                    <p class="text-sm text-slate-600 mt-1">Ver registros</p>
                </a>

                <a href="{{ route('ayuda') }}" class="block p-6 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="size-10 rounded-lg bg-blue-50 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.5 9a3.5 3.5 0 1 1 5.6 2.8c-.7.5-1.1 1-1.1 1.7V14M12 17h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-slate-900">Ayuda</h3>
                    <p class="text-sm text-slate-600 mt-1">Centro de ayuda</p>
                </a>
            </div>

            <!-- Redirect to home -->
            <div class="rounded-xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 border border-slate-200 p-6 text-center">
                <h2 class="text-xl font-semibold text-slate-900 mb-2">¿Preferís la vista móvil?</h2>
                <p class="text-slate-600 mb-4">La interfaz principal de GlowUp está optimizada para dispositivos móviles</p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white font-semibold shadow-lg shadow-indigo-500/20 hover:scale-105 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                    </svg>
                    Ir a la página principal
                </a>
            </div>
        </main>
    </div>
</body>
</html>
