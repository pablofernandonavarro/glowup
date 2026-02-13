<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="mb-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4">
            <p class="text-sm text-green-800 dark:text-green-200">{{ session('message') }}</p>
        </div>
    @endif

    <!-- Formulario de carga -->
    <section class="rounded-2xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-5 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <div class="size-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Nuevo Registro</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400">Registrá tu peso actual</p>
            </div>
        </div>

        <form wire:submit.prevent="guardar" class="space-y-5">
            <!-- Peso -->
            <div>
                <label for="peso" class="block text-sm font-medium mb-2">Peso (kg)</label>
                <div class="relative">
                    <input type="number"
                           id="peso"
                           wire:model="peso"
                           step="0.1"
                           min="0"
                           max="500"
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-lg font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="75.5">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 font-medium">kg</span>
                </div>
                @error('peso') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Fecha -->
            <div>
                <label for="fecha" class="block text-sm font-medium mb-2">Fecha</label>
                <input type="date"
                       id="fecha"
                       wire:model="fecha"
                       required
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('fecha') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Notas (opcional) -->
            <div>
                <label for="notas" class="block text-sm font-medium mb-2">Notas <span class="text-slate-400 font-normal">(opcional)</span></label>
                <textarea id="notas"
                          wire:model="notas"
                          rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
                          placeholder="Ej: Después del entrenamiento, en ayunas..."></textarea>
                @error('notas') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Botón de envío -->
            <button type="submit"
                    class="w-full tap rounded-xl bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white px-5 py-3.5 font-semibold shadow-lg shadow-fuchsia-500/20 hover:scale-[1.02] active:scale-95 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Guardar Registro
            </button>
        </form>
    </section>

    <!-- Último registro -->
    <section class="mt-5 rounded-2xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 dark:from-fuchsia-500/15 dark:via-indigo-500/15 dark:to-blue-500/15 border border-slate-200 dark:border-neutral-800 p-4">
        <h3 class="text-sm font-semibold mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Último registro
        </h3>
        @if($ultimoPeso)
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $ultimoPeso->peso }}</span>
                <span class="text-slate-600 dark:text-slate-400">kg</span>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $ultimoPeso->fecha->format('d/m/Y') }}</p>
        @else
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-slate-400">--</span>
                <span class="text-slate-600 dark:text-slate-400">kg</span>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">No hay registros todavía</p>
        @endif
    </section>
</div>
