<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="mb-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4">
            <p class="text-sm text-green-800 dark:text-green-200">{{ session('message') }}</p>
        </div>
    @endif

    <!-- Mensaje de error -->
    @if (session()->has('error'))
        <div class="mb-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4">
            <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Formulario de medidas corporales -->
    <section class="rounded-2xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-5 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <div class="size-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Medidas Corporales</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400">Registrá tus medidas en cm</p>
            </div>
        </div>

        <form wire:submit.prevent="guardar" class="space-y-5">
            <!-- Fecha y Hora -->
            <div>
                <label for="fecha" class="block text-sm font-medium mb-2">Fecha y Hora</label>
                <input type="datetime-local"
                       id="fecha"
                       wire:model="fecha"
                       required
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('fecha') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Grid de medidas -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Cuello -->
                <div>
                    <label for="cuello" class="block text-sm font-medium mb-2">Cuello @if($ultimaMedida?->cuello)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->cuello }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="cuello"
                               wire:model="cuello"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->cuello ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('cuello') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Hombros -->
                <div>
                    <label for="hombros" class="block text-sm font-medium mb-2">Hombros @if($ultimaMedida?->hombros)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->hombros }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="hombros"
                               wire:model="hombros"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->hombros ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('hombros') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Pecho -->
                <div>
                    <label for="pecho" class="block text-sm font-medium mb-2">Pecho @if($ultimaMedida?->pecho)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->pecho }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="pecho"
                               wire:model="pecho"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->pecho ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('pecho') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Cintura -->
                <div>
                    <label for="cintura" class="block text-sm font-medium mb-2">Cintura @if($ultimaMedida?->cintura)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->cintura }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="cintura"
                               wire:model="cintura"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->cintura ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('cintura') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Cadera -->
                <div>
                    <label for="cadera" class="block text-sm font-medium mb-2">Cadera @if($ultimaMedida?->cadera)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->cadera }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="cadera"
                               wire:model="cadera"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->cadera ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('cadera') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Muslo -->
                <div>
                    <label for="muslo" class="block text-sm font-medium mb-2">Muslo @if($ultimaMedida?->muslo)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->muslo }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="muslo"
                               wire:model="muslo"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->muslo ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('muslo') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Pantorrilla -->
                <div>
                    <label for="pantorrilla" class="block text-sm font-medium mb-2">Pantorrilla @if($ultimaMedida?->pantorrilla)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->pantorrilla }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="pantorrilla"
                               wire:model="pantorrilla"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->pantorrilla ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('pantorrilla') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Brazo -->
                <div>
                    <label for="brazo" class="block text-sm font-medium mb-2">Brazo @if($ultimaMedida?->brazo)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->brazo }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="brazo"
                               wire:model="brazo"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->brazo ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('brazo') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Antebrazo -->
                <div>
                    <label for="antebrazo" class="block text-sm font-medium mb-2">Antebrazo @if($ultimaMedida?->antebrazo)<span class="text-xs text-slate-500">(Último: {{ $ultimaMedida->antebrazo }})</span>@endif</label>
                    <div class="relative">
                        <input type="number"
                               id="antebrazo"
                               wire:model="antebrazo"
                               step="0.1"
                               min="0"
                               max="200"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="{{ $ultimaMedida?->antebrazo ?? '' }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-sm">cm</span>
                    </div>
                    @error('antebrazo') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Notas (opcional) -->
            <div>
                <label for="notas" class="block text-sm font-medium mb-2">Notas <span class="text-slate-400 font-normal">(opcional)</span></label>
                <textarea id="notas"
                          wire:model="notas"
                          rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
                          placeholder="Ej: Medidas post-entrenamiento..."></textarea>
                @error('notas') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Botón de envío -->
            <button type="submit"
                    class="w-full tap rounded-xl bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white px-5 py-3.5 font-semibold shadow-lg shadow-fuchsia-500/20 hover:scale-[1.02] active:scale-95 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Guardar Medidas
            </button>
        </form>
    </section>

    <!-- Última medida registrada -->
    @if($ultimaMedida)
        <section class="mt-5 rounded-2xl bg-gradient-to-br from-fuchsia-500/10 via-indigo-500/10 to-blue-500/10 dark:from-fuchsia-500/15 dark:via-indigo-500/15 dark:to-blue-500/15 border border-slate-200 dark:border-neutral-800 p-4">
            <h3 class="text-sm font-semibold mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Última medición
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">{{ $ultimaMedida->fecha->format('d/m/Y H:i') }}</p>
            <div class="grid grid-cols-2 gap-3 text-sm">
                @if($ultimaMedida->cuello)
                    <div><span class="text-slate-600 dark:text-slate-400">Cuello:</span> <strong>{{ $ultimaMedida->cuello }} cm</strong></div>
                @endif
                @if($ultimaMedida->hombros)
                    <div><span class="text-slate-600 dark:text-slate-400">Hombros:</span> <strong>{{ $ultimaMedida->hombros }} cm</strong></div>
                @endif
                @if($ultimaMedida->pecho)
                    <div><span class="text-slate-600 dark:text-slate-400">Pecho:</span> <strong>{{ $ultimaMedida->pecho }} cm</strong></div>
                @endif
                @if($ultimaMedida->cintura)
                    <div><span class="text-slate-600 dark:text-slate-400">Cintura:</span> <strong>{{ $ultimaMedida->cintura }} cm</strong></div>
                @endif
                @if($ultimaMedida->cadera)
                    <div><span class="text-slate-600 dark:text-slate-400">Cadera:</span> <strong>{{ $ultimaMedida->cadera }} cm</strong></div>
                @endif
                @if($ultimaMedida->muslo)
                    <div><span class="text-slate-600 dark:text-slate-400">Muslo:</span> <strong>{{ $ultimaMedida->muslo }} cm</strong></div>
                @endif
                @if($ultimaMedida->pantorrilla)
                    <div><span class="text-slate-600 dark:text-slate-400">Pantorrilla:</span> <strong>{{ $ultimaMedida->pantorrilla }} cm</strong></div>
                @endif
                @if($ultimaMedida->brazo)
                    <div><span class="text-slate-600 dark:text-slate-400">Brazo:</span> <strong>{{ $ultimaMedida->brazo }} cm</strong></div>
                @endif
                @if($ultimaMedida->antebrazo)
                    <div><span class="text-slate-600 dark:text-slate-400">Antebrazo:</span> <strong>{{ $ultimaMedida->antebrazo }} cm</strong></div>
                @endif
            </div>
        </section>
    @endif
</div>
