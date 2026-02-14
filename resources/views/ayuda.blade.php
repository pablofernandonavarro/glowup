<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Ayuda - GlowUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        html { font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Apple Color Emoji', 'Segoe UI Emoji'; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        .tap { min-height: 44px; min-width: 44px; }
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
    </style>
</head>

<body class="h-full bg-slate-50 dark:bg-neutral-950 text-slate-900 dark:text-slate-100">
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
                    <h1 class="font-semibold text-lg">Ayuda</h1>
                </div>
            </div>
        </header>

        <!-- Contenido -->
        <main class="flex-1 mx-auto w-full max-w-screen-sm px-4 pt-5 pb-24">
            <!-- Bienvenida -->
            <section class="rounded-2xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 dark:from-fuchsia-500/15 dark:via-indigo-500/15 dark:to-blue-500/15 border border-slate-200 dark:border-neutral-800 p-5 mb-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="size-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.5 9a3.5 3.5 0 1 1 5.6 2.8c-.7.5-1.1 1-1.1 1.7V14M12 17h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">Centro de Ayuda</h2>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Aprende a usar GlowUp</p>
                    </div>
                </div>
            </section>

            <!-- Guía rápida -->
            <section class="mb-6">
                <h3 class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3 px-1">Guía Rápida</h3>

                <div class="space-y-3">
                    <!-- Paso 1 -->
                    <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-4 shadow-sm">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 size-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 grid place-items-center text-indigo-600 dark:text-indigo-400 font-bold text-sm">1</div>
                            <div>
                                <h4 class="font-semibold mb-1">Registrá tu peso</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Andá a la sección "Datos" y cargá tu peso actual. Podés agregar notas opcionales.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Paso 2 -->
                    <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-4 shadow-sm">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 size-8 rounded-full bg-fuchsia-100 dark:bg-fuchsia-900/30 grid place-items-center text-fuchsia-600 dark:text-fuchsia-400 font-bold text-sm">2</div>
                            <div>
                                <h4 class="font-semibold mb-1">Visualizá tu progreso</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">En "Gráficos" podés ver la evolución de tu peso con gráficos interactivos.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Paso 3 -->
                    <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-4 shadow-sm">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 size-8 rounded-full bg-amber-100 dark:bg-amber-900/30 grid place-items-center text-amber-600 dark:text-amber-400 font-bold text-sm">3</div>
                            <div>
                                <h4 class="font-semibold mb-1">Revisá tu historial</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">En "Historial" tenés todos tus registros organizados por fecha.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Preguntas Frecuentes -->
            <section class="mb-6">
                <h3 class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3 px-1">Preguntas Frecuentes</h3>

                <div class="space-y-2">
                    <!-- FAQ 1 -->
                    <details class="group rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 shadow-sm overflow-hidden">
                        <summary class="tap flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-neutral-800/50 transition">
                            <span class="font-medium text-sm">¿Con qué frecuencia debo registrar mi peso?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-slate-400 group-open:rotate-180 transition">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-4 pb-4 text-sm text-slate-600 dark:text-slate-400">
                            Se recomienda pesarse 1-2 veces por semana, siempre a la misma hora (idealmente por la mañana, en ayunas) para obtener mediciones consistentes.
                        </div>
                    </details>

                    <!-- FAQ 2 -->
                    <details class="group rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 shadow-sm overflow-hidden">
                        <summary class="tap flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-neutral-800/50 transition">
                            <span class="font-medium text-sm">¿Puedo editar o eliminar un registro?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-slate-400 group-open:rotate-180 transition">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-4 pb-4 text-sm text-slate-600 dark:text-slate-400">
                            Sí, en la sección "Historial" podés tocar el menú de cada registro (⋮) para editarlo o eliminarlo.
                        </div>
                    </details>

                    <!-- FAQ 3 -->
                    <details class="group rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 shadow-sm overflow-hidden">
                        <summary class="tap flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-neutral-800/50 transition">
                            <span class="font-medium text-sm">¿Cómo establezco mi meta de peso?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-slate-400 group-open:rotate-180 transition">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-4 pb-4 text-sm text-slate-600 dark:text-slate-400">
                            Podés configurar tu meta de peso en la sección de Configuración de tu perfil. La meta se mostrará en los gráficos como referencia.
                        </div>
                    </details>

                    <!-- FAQ 4 -->
                    <details class="group rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 shadow-sm overflow-hidden">
                        <summary class="tap flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-neutral-800/50 transition">
                            <span class="font-medium text-sm">¿Mis datos están seguros?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-slate-400 group-open:rotate-180 transition">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-4 pb-4 text-sm text-slate-600 dark:text-slate-400">
                            Sí, todos tus datos están encriptados y almacenados de forma segura. Solo vos tenés acceso a tu información personal.
                        </div>
                    </details>

                    <!-- FAQ 5 -->
                    <details class="group rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 shadow-sm overflow-hidden">
                        <summary class="tap flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-neutral-800/50 transition">
                            <span class="font-medium text-sm">¿Puedo exportar mis datos?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-slate-400 group-open:rotate-180 transition">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-4 pb-4 text-sm text-slate-600 dark:text-slate-400">
                            Próximamente podrás exportar tus datos en formato CSV o PDF desde la sección de Configuración.
                        </div>
                    </details>
                </div>
            </section>

            <!-- Consejos -->
            <section class="mb-6">
                <h3 class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3 px-1">Consejos Útiles</h3>

                <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-4 shadow-sm space-y-3">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 size-6 rounded-full bg-green-100 dark:bg-green-900/30 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3 text-green-600 dark:text-green-400">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Pesate siempre a la misma hora del día</p>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-shrink-0 size-6 rounded-full bg-green-100 dark:bg-green-900/30 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3 text-green-600 dark:text-green-400">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Usá la misma balanza para mantener consistencia</p>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-shrink-0 size-6 rounded-full bg-green-100 dark:bg-green-900/30 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3 text-green-600 dark:text-green-400">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">No te obsesiones con el número diario, mirá la tendencia general</p>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-shrink-0 size-6 rounded-full bg-green-100 dark:bg-green-900/30 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3 text-green-600 dark:text-green-400">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Agregá notas para recordar contexto (ejercicio, ayuno, etc.)</p>
                    </div>
                </div>
            </section>

            <!-- Contacto -->
            <section class="rounded-2xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 dark:from-fuchsia-500/15 dark:via-indigo-500/15 dark:to-blue-500/15 border border-slate-200 dark:border-neutral-800 p-4 text-center">
                <h3 class="font-semibold mb-1">¿Necesitás más ayuda?</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Contactanos si tenés alguna pregunta o sugerencia</p>
                <a href="mailto:soporte@glowup.app" class="inline-flex items-center gap-2 tap rounded-xl bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white px-4 py-2.5 font-semibold shadow-lg shadow-fuchsia-500/20 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                    Contactar Soporte
                </a>
            </section>
        </main>

        <!-- Bottom Tab Bar -->
        @include('partials.bottom-nav')
    </div>
</body>
</html>
