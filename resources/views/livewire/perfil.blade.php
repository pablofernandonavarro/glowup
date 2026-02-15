<div>

    <!-- Foto de Perfil -->
    <section class="rounded-2xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-5 shadow-sm mb-5">
        <div class="flex items-center gap-4 mb-4">
            @if(auth()->user()->foto_perfil)
                <img src="{{ asset('storage/' . auth()->user()->foto_perfil) }}" alt="Foto de perfil" class="size-20 rounded-full object-cover border-2 border-slate-200 dark:border-neutral-700">
            @else
                <div class="size-20 rounded-full bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white text-2xl font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            @endif
            <div class="flex-1">
                <h3 class="text-sm font-semibold">Foto de Perfil</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400">JPG, PNG o GIF (máx. 2MB)</p>
            </div>
        </div>

        <div class="relative">
            <input type="file"
                   wire:model.live="foto_perfil"
                   accept="image/jpeg,image/jpg,image/png,image/gif"
                   class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/20 dark:file:text-indigo-400">
            <div wire:loading wire:target="foto_perfil" class="absolute inset-0 flex items-center justify-center bg-white/80 dark:bg-neutral-900/80 rounded-lg">
                <span class="text-sm text-indigo-600">Subiendo foto...</span>
            </div>
        </div>
        @error('foto_perfil') <span class="text-xs text-red-600 dark:text-red-400 mt-1 block">{{ $message }}</span> @enderror
    </section>

    <!-- Datos del Perfil -->
    <section class="rounded-2xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-5 shadow-sm mb-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="size-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Mi Perfil</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400">Configurá tus datos y objetivos</p>
            </div>
        </div>

        <form wire:submit.prevent="guardar" class="space-y-5">
            <!-- Objetivos de Peso -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-300">Objetivos de Peso</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="peso_inicial" class="block text-sm font-medium mb-2">Peso Inicial (kg)</label>
                        <input type="number"
                               id="peso_inicial"
                               wire:model="peso_inicial"
                               step="0.1"
                               min="0"
                               max="500"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="75.5">
                        @error('peso_inicial') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="peso_objetivo" class="block text-sm font-medium mb-2">Peso Objetivo (kg)</label>
                        <input type="number"
                               id="peso_objetivo"
                               wire:model="peso_objetivo"
                               step="0.1"
                               min="0"
                               max="500"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="70.0">
                        @error('peso_objetivo') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Altura -->
            <div>
                <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Altura</h3>
                <div>
                    <label for="altura" class="block text-sm font-medium mb-2">Altura (cm)</label>
                    <input type="number"
                           id="altura"
                           wire:model="altura"
                           step="0.1"
                           min="0"
                           max="300"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="175.0">
                    @error('altura') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Botón de envío -->
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="w-full tap rounded-xl bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white px-5 py-3.5 font-semibold shadow-lg shadow-fuchsia-500/20 hover:scale-[1.02] active:scale-95 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove>Guardar Perfil</span>
                <span wire:loading>Guardando...</span>
            </button>
        </form>
    </section>

    <!-- Cambiar Contraseña -->
    <section class="rounded-2xl bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-800 p-5 shadow-sm mb-5">
        <h3 class="text-sm font-semibold mb-4">Cambiar Contraseña</h3>

        <form wire:submit.prevent="cambiarPassword" class="space-y-4">
            <div>
                <label for="password_actual" class="block text-sm font-medium mb-2">Contraseña Actual</label>
                <input type="password" id="password_actual" wire:model="password_actual" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('password_actual') <span class="text-xs text-red-600 dark:text-red-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_nuevo" class="block text-sm font-medium mb-2">Nueva Contraseña</label>
                <input type="password" id="password_nuevo" wire:model="password_nuevo" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('password_nuevo') <span class="text-xs text-red-600 dark:text-red-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_confirmacion" class="block text-sm font-medium mb-2">Confirmar Nueva Contraseña</label>
                <input type="password" id="password_confirmacion" wire:model="password_confirmacion" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('password_confirmacion') <span class="text-xs text-red-600 dark:text-red-400 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled" class="w-full tap rounded-xl bg-gradient-to-br from-red-600 to-pink-600 text-white px-5 py-3.5 font-semibold shadow-lg shadow-red-500/20 hover:scale-[1.02] active:scale-95 transition disabled:opacity-50">
                <span wire:loading.remove>Cambiar Contraseña</span>
                <span wire:loading>Cambiando...</span>
            </button>
        </form>
    </section>

    <!-- Zona de Peligro -->
    <section class="rounded-2xl bg-red-50 dark:bg-red-900/10 border-2 border-red-200 dark:border-red-800 p-5 shadow-sm mb-5">
        <div class="flex items-start gap-3 mb-4">
            <div class="size-10 rounded-xl bg-red-500 grid place-items-center text-white flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-red-900 dark:text-red-200">Zona de Peligro</h2>
                <p class="text-sm text-red-700 dark:text-red-300 mt-1">
                    Esta acción eliminará permanentemente todos tus registros de peso y medidas corporales. No se puede deshacer.
                </p>
            </div>
        </div>

        <button type="button"
                wire:click="confirmarEliminacion"
                class="w-full tap rounded-xl bg-red-600 hover:bg-red-700 text-white px-5 py-3.5 font-semibold shadow-lg shadow-red-500/20 hover:scale-[1.02] active:scale-95 transition">
            Eliminar Todos los Datos
        </button>
    </section>

    <!-- Modal de Confirmación -->
    @if($mostrarModalConfirmacion)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-neutral-900 rounded-2xl shadow-2xl max-w-md w-full p-6 border border-slate-200 dark:border-neutral-800">
                <div class="text-center mb-6">
                    <div class="size-16 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-900/30 grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-8 text-red-600 dark:text-red-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">¿Estás seguro?</h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Esta acción eliminará todos tus registros de peso y medidas corporales de forma <strong>permanente</strong>.
                        No podrás recuperar esta información.
                    </p>
                </div>

                <div class="flex gap-3">
                    <button wire:click="cancelarEliminacion"
                            type="button"
                            class="flex-1 tap rounded-xl px-4 py-3 font-semibold border border-slate-200 dark:border-neutral-700 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-neutral-800 transition">
                        Cancelar
                    </button>
                    <button wire:click="eliminarDatos"
                            type="button"
                            class="flex-1 tap rounded-xl px-4 py-3 font-semibold bg-red-600 text-white hover:bg-red-700 shadow-lg shadow-red-500/20 transition">
                        Sí, Eliminar Todo
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Éxito / Mensaje Motivacional -->
    @if($mostrarModalExito)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-neutral-900 rounded-2xl shadow-2xl max-w-md w-full p-6 border border-slate-200 dark:border-neutral-800">
                <div class="text-center">
                    <div class="size-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-green-400 via-emerald-500 to-teal-500 grid place-items-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-10">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 bg-gradient-to-r from-fuchsia-600 to-indigo-600 bg-clip-text text-transparent">
                        ¡Tu Nuevo Comienzo Está Aquí!
                    </h3>
                    <p class="text-slate-700 dark:text-slate-300 mb-2 text-base">
                        Cada gran transformación empieza con un <strong>primer paso</strong>.
                    </p>
                    <p class="text-slate-600 dark:text-slate-400 mb-4 text-sm leading-relaxed">
                        Hoy dejás atrás el pasado y comenzás una nueva etapa llena de <strong class="text-fuchsia-600 dark:text-fuchsia-400">energía</strong>,
                        <strong class="text-indigo-600 dark:text-indigo-400">motivación</strong> y
                        <strong class="text-emerald-600 dark:text-emerald-400">determinación</strong>.
                    </p>
                    <div class="bg-gradient-to-r from-fuchsia-50 to-indigo-50 dark:from-fuchsia-900/20 dark:to-indigo-900/20 rounded-xl p-4 mb-5 border border-fuchsia-100 dark:border-fuchsia-800/30">
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">
                            💪 ¡Vos podés lograrlo!
                        </p>
                        <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">
                            Este es el momento perfecto para establecer tu peso inicial y comenzar tu viaje hacia tus objetivos.
                        </p>
                    </div>
                    <a href="{{ route('datos') }}"
                       class="block w-full tap rounded-xl bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white px-5 py-4 font-bold text-base shadow-lg shadow-fuchsia-500/30 hover:shadow-fuchsia-500/40 hover:scale-[1.02] active:scale-95 transition text-center">
                        Registrar Mi Peso Inicial
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
