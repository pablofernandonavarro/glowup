<div>
    @if($hayDatos)
        <!-- Estadísticas rápidas -->
        <section class="grid grid-cols-3 gap-3 mb-5">
            <!-- Peso Actual -->
            <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-3 shadow-sm">
                <div class="text-xs text-slate-600 dark:text-slate-400 mb-1">Actual</div>
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($pesoActual, 1) }}</div>
                <div class="text-[10px] text-slate-500">kg</div>
            </div>

            <!-- Cambio -->
            <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-3 shadow-sm">
                <div class="text-xs text-slate-600 dark:text-slate-400 mb-1">Cambio</div>
                <div class="text-xl font-bold {{ $cambio < 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ $cambio > 0 ? '+' : '' }}{{ number_format($cambio, 1) }}
                </div>
                <div class="text-[10px] text-slate-500">kg</div>
            </div>

            <!-- Meta -->
            <div class="rounded-xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-3 shadow-sm">
                <div class="text-xs text-slate-600 dark:text-slate-400 mb-1">Meta</div>
                <div class="text-xl font-bold text-fuchsia-600 dark:text-fuchsia-400">{{ number_format($meta, 1) }}</div>
                <div class="text-[10px] text-slate-500">kg</div>
            </div>
        </section>

        <!-- Gráfico Principal -->
        <section class="rounded-2xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-5 shadow-sm mb-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 4h18M4 8h16v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Zm3 7 4-3 4 3 4-6"/>
                    </svg>
                    Evolución de Peso
                </h2>
                <!-- Filtro de período -->
                <select wire:model.live="periodo" class="text-xs rounded-lg border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="7">7 días</option>
                    <option value="30">30 días</option>
                    <option value="90">90 días</option>
                    <option value="all">Todo</option>
                </select>
            </div>
            <canvas id="pesoChart" class="w-full" style="max-height: 250px;"></canvas>
        </section>

        <!-- Progreso hacia la meta -->
        <section class="rounded-2xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 dark:from-fuchsia-500/15 dark:via-indigo-500/15 dark:to-blue-500/15 border border-slate-200 dark:border-neutral-800 p-4">
            <h3 class="text-sm font-semibold mb-3">Progreso hacia tu meta</h3>

            <!-- Barra de progreso -->
            <div class="relative w-full h-3 bg-slate-200 dark:bg-neutral-700 rounded-full overflow-hidden mb-2">
                <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-fuchsia-500 to-indigo-500 rounded-full transition-all" style="width: {{ $progreso }}%;"></div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <span class="text-slate-600 dark:text-slate-400">{{ $progreso }}% completado</span>
                <span class="font-semibold {{ $faltante > 0 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                    @if($faltante > 0)
                        Quedan {{ number_format($faltante, 1) }} kg
                    @else
                        ¡Meta alcanzada!
                    @endif
                </span>
            </div>

            <!-- Estimación -->
            @if($faltante > 0 && $semanasEstimadas > 0)
                <div class="mt-3 pt-3 border-t border-slate-200/50 dark:border-neutral-700/50">
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        <span class="font-semibold">Estimación:</span> Al ritmo actual, alcanzarás tu meta en
                        <span class="text-indigo-600 dark:text-indigo-400 font-semibold">
                            {{ $semanasEstimadas }} {{ $semanasEstimadas == 1 ? 'semana' : 'semanas' }}
                        </span>
                    </p>
                </div>
            @endif
        </section>

        <!-- Script del gráfico -->
        <script>
            document.addEventListener('livewire:navigated', function() {
                initChart();
            });

            document.addEventListener('DOMContentLoaded', function() {
                initChart();
            });

            function initChart() {
                const ctx = document.getElementById('pesoChart');
                if (!ctx) return;

                // Destruir gráfico anterior si existe
                if (window.pesoChartInstance) {
                    window.pesoChartInstance.destroy();
                }

                const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const textColor = isDark ? '#e2e8f0' : '#334155';
                const gridColor = isDark ? '#374151' : '#e2e8f0';

                const labels = @json($labels);
                const datos = @json($datos);
                const meta = @json($meta);

                window.pesoChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Peso (kg)',
                            data: datos,
                            borderColor: '#a855f7',
                            backgroundColor: 'rgba(168, 85, 247, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#a855f7',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }, {
                            label: 'Meta',
                            data: Array(labels.length).fill(meta),
                            borderColor: '#ec4899',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            fill: false,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    color: textColor,
                                    usePointStyle: true,
                                    padding: 15,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: isDark ? '#1f2937' : '#ffffff',
                                titleColor: textColor,
                                bodyColor: textColor,
                                borderColor: isDark ? '#374151' : '#e2e8f0',
                                borderWidth: 1,
                                padding: 12,
                                displayColors: true,
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.parsed.y + ' kg';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                ticks: {
                                    color: textColor,
                                    callback: function(value) {
                                        return value + ' kg';
                                    }
                                },
                                grid: {
                                    color: gridColor
                                }
                            },
                            x: {
                                ticks: {
                                    color: textColor
                                },
                                grid: {
                                    color: gridColor
                                }
                            }
                        }
                    }
                });
            }

            // Reinicializar cuando Livewire actualiza
            Livewire.hook('morph.updated', () => {
                setTimeout(() => initChart(), 100);
            });
        </script>
    @else
        <!-- Estado vacío -->
        <section class="text-center py-12">
            <div class="size-16 mx-auto rounded-full bg-slate-100 dark:bg-neutral-800 grid place-items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-8 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 4h18M4 8h16v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Zm3 7 4-3 4 3 4-6"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-1">No hay datos para mostrar</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">Necesitás al menos un registro de peso para ver los gráficos</p>
            <a href="{{ route('datos') }}" class="inline-flex items-center gap-2 tap rounded-xl bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white px-5 py-2.5 font-semibold shadow-lg shadow-fuchsia-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Cargar primer registro
            </a>
        </section>
    @endif
</div>
