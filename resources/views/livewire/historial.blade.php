<div>
    <!-- Resumen -->
    <section class="rounded-2xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 dark:from-fuchsia-500/15 dark:via-indigo-500/15 dark:to-blue-500/15 border border-slate-200 dark:border-neutral-800 p-4 mb-5">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-sm font-semibold">Total de registros</h2>
            <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $totalRegistros }}</span>
        </div>
        @if($primerRegistro)
            <p class="text-xs text-slate-600 dark:text-slate-400">Desde el {{ $primerRegistro->fecha->locale('es')->translatedFormat('d \d\e F, Y') }}</p>
        @else
            <p class="text-xs text-slate-600 dark:text-slate-400">No hay registros todavía</p>
        @endif
    </section>

    @if($registros->count() > 0)
        <!-- Lista de registros agrupados por mes -->
        <div class="space-y-5">
            @foreach($registros as $mes => $registrosMes)
                <section>
                    <h3 class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3 px-1">
                        {{ \Carbon\Carbon::parse($mes)->locale('es')->translatedFormat('F Y') }}
                    </h3>
                    <div class="space-y-2">
                        @foreach($registrosMes as $index => $registro)
                            @php
                                // Calcular diferencia con el registro anterior
                                $registroAnterior = $registrosMes->get($index + 1);
                                $diferencia = $registroAnterior ? $registro->peso - $registroAnterior->peso : 0;
                            @endphp
                            <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-4 shadow-sm hover:shadow-md transition group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 grid place-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5 text-indigo-600 dark:text-indigo-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20V9m6 11V6m6 14v-8"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="flex items-baseline gap-2 flex-wrap">
                                                <span class="text-lg font-bold">{{ $registro->peso }}</span>
                                                <span class="text-sm text-slate-500">kg</span>
                                                @if($registroAnterior && $diferencia != 0)
                                                    <span class="inline-flex items-center gap-1 text-xs font-medium {{ $diferencia < 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3 {{ $diferencia < 0 ? '' : 'rotate-180' }}">
                                                            <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $diferencia > 0 ? '+' : '' }}{{ number_format($diferencia, 1) }} kg
                                                    </span>
                                                @endif
                                                @if($pesoObjetivo)
                                                    @php
                                                        $diferenciaObjetivo = $registro->peso - $pesoObjetivo;
                                                    @endphp
                                                    <span class="inline-flex items-center gap-1 text-xs font-medium {{ $diferenciaObjetivo > 0 ? 'text-amber-600 dark:text-amber-400' : ($diferenciaObjetivo < 0 ? 'text-blue-600 dark:text-blue-400' : 'text-green-600 dark:text-green-400') }}">
                                                        @if($diferenciaObjetivo > 0)
                                                            +{{ number_format(abs($diferenciaObjetivo), 1) }} vs meta
                                                        @elseif($diferenciaObjetivo < 0)
                                                            -{{ number_format(abs($diferenciaObjetivo), 1) }} vs meta
                                                        @else
                                                            En meta ✓
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-slate-600 dark:text-slate-400">
                                                {{ $registro->fecha->locale('es')->translatedFormat('d \d\e F, Y') }} • {{ $registro->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                    <button class="tap rounded-lg p-1.5 opacity-0 group-hover:opacity-100 transition hover:bg-slate-100 dark:hover:bg-neutral-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-4 text-slate-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"/>
                                        </svg>
                                    </button>
                                </div>
                                @if($registro->notas)
                                    <div class="mt-2 pl-13 text-xs text-slate-600 dark:text-slate-400 italic">
                                        {{ $registro->notas }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    @else
        <!-- Estado vacío -->
        <section class="text-center py-12">
            <div class="size-16 mx-auto rounded-full bg-slate-100 dark:bg-neutral-800 grid place-items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-8 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-1">No hay registros todavía</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">Comenzá a registrar tu peso para ver tu historial</p>
            <a href="{{ route('datos') }}" class="inline-flex items-center gap-2 tap rounded-xl bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white px-5 py-2.5 font-semibold shadow-lg shadow-fuchsia-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Cargar primer registro
            </a>
        </section>
    @endif
</div>
