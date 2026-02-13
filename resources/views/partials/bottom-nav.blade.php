@php
    $sections = [
        [ 'name' => 'Datos',     'icon' => 'chart-bar',               'url' => route('datos', false) ],
        [ 'name' => 'Gráficos',  'icon' => 'presentation-chart-line', 'url' => route('graficos', false) ],
        [ 'name' => 'Historial', 'icon' => 'clock',                   'url' => route('historial', false) ],
        [ 'name' => 'Ayuda',     'icon' => 'question-mark-circle',    'url' => route('ayuda', false) ],
    ];
@endphp

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
