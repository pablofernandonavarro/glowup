<?php

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $peso_inicial;
    public $peso_objetivo;
    public $altura;
    public $cintura;
    public $cadera;
    public $pecho;
    public $brazo;
    public $pierna;

    public $foto_perfil;
    public $password_actual;
    public $password_nuevo;
    public $password_confirmacion;

    public function mount()
    {
        $user = auth()->user();
        $this->peso_inicial = $user->peso_inicial;
        $this->peso_objetivo = $user->peso_objetivo;
        $this->altura = $user->altura;
        $this->cintura = $user->cintura;
        $this->cadera = $user->cadera;
        $this->pecho = $user->pecho;
        $this->brazo = $user->brazo;
        $this->pierna = $user->pierna;
    }

    public function rules()
    {
        return [
            'peso_inicial' => 'nullable|numeric|min:0|max:500',
            'peso_objetivo' => 'nullable|numeric|min:0|max:500',
            'altura' => 'nullable|numeric|min:0|max:300',
            'cintura' => 'nullable|numeric|min:0|max:300',
            'cadera' => 'nullable|numeric|min:0|max:300',
            'pecho' => 'nullable|numeric|min:0|max:300',
            'brazo' => 'nullable|numeric|min:0|max:300',
            'pierna' => 'nullable|numeric|min:0|max:300',
        ];
    }

    public function updatedFotoPerfil()
    {
        if ($this->foto_perfil) {
            $this->actualizarFoto();
        }
    }

    public function actualizarFoto()
    {
        $this->validate([
            'foto_perfil' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048', // Max 2MB
        ]);

        $user = auth()->user();

        // Eliminar foto anterior si existe
        if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
            Storage::disk('public')->delete($user->foto_perfil);
        }

        $path = $this->foto_perfil->store('fotos-perfil', 'public');

        $user->update(['foto_perfil' => $path]);

        $this->dispatch('foto-actualizada');
        $this->reset('foto_perfil');
    }

    public function cambiarPassword()
    {
        $this->validate([
            'password_actual' => 'required',
            'password_nuevo' => 'required|min:8|same:password_confirmacion',
            'password_confirmacion' => 'required',
        ]);

        if (!\Hash::check($this->password_actual, auth()->user()->password)) {
            $this->addError('password_actual', 'La contraseña actual no es correcta.');
            return;
        }

        auth()->user()->update([
            'password' => \Hash::make($this->password_nuevo),
        ]);

        $this->reset(['password_actual', 'password_nuevo', 'password_confirmacion']);
        $this->dispatch('password-actualizada');
    }

    public function guardar()
    {
        try {
            $this->validate();

            auth()->user()->update([
                'peso_inicial' => $this->peso_inicial,
                'peso_objetivo' => $this->peso_objetivo,
                'altura' => $this->altura,
                'cintura' => $this->cintura,
                'cadera' => $this->cadera,
                'pecho' => $this->pecho,
                'brazo' => $this->brazo,
                'pierna' => $this->pierna,
            ]);

            $this->dispatch('perfil-guardado');

            $this->js("console.log('Guardado exitoso!')");
        } catch (\Exception $e) {
            $this->js("console.error('Error: " . addslashes($e->getMessage()) . "')");
        }
    }
};
?>

<div>
    <!-- Mensajes de éxito -->
    <div x-data="{ showPerfil: false, showFoto: false, showPassword: false }"
         @perfil-guardado.window="showPerfil = true; setTimeout(() => { window.location.href = '{{ route('home') }}'; }, 2000);"
         @foto-actualizada.window="showFoto = true; setTimeout(() => showFoto = false, 3000); location.reload();"
         @password-actualizada.window="showPassword = true; setTimeout(() => showPassword = false, 3000);">

        <div x-show="showPerfil" x-transition class="mb-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4" style="display: none;">
            <p class="text-sm text-green-800 dark:text-green-200">✓ Perfil actualizado exitosamente!</p>
        </div>

        <div x-show="showFoto" x-transition class="mb-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4" style="display: none;">
            <p class="text-sm text-green-800 dark:text-green-200">✓ Foto actualizada exitosamente!</p>
        </div>

        <div x-show="showPassword" x-transition class="mb-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4" style="display: none;">
            <p class="text-sm text-green-800 dark:text-green-200">✓ Contraseña actualizada exitosamente!</p>
        </div>
    </div>

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

    <!-- Cambiar Contraseña -->
    

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

            <!-- Medidas Corporales -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-300">Medidas Corporales (cm)</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="cintura" class="block text-sm font-medium mb-2">Cintura</label>
                        <input type="number"
                               id="cintura"
                               wire:model="cintura"
                               step="0.1"
                               min="0"
                               max="300"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="80.0">
                        @error('cintura') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="cadera" class="block text-sm font-medium mb-2">Cadera</label>
                        <input type="number"
                               id="cadera"
                               wire:model="cadera"
                               step="0.1"
                               min="0"
                               max="300"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="95.0">
                        @error('cadera') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="pecho" class="block text-sm font-medium mb-2">Pecho</label>
                        <input type="number"
                               id="pecho"
                               wire:model="pecho"
                               step="0.1"
                               min="0"
                               max="300"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="90.0">
                        @error('pecho') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="brazo" class="block text-sm font-medium mb-2">Brazo</label>
                        <input type="number"
                               id="brazo"
                               wire:model="brazo"
                               step="0.1"
                               min="0"
                               max="300"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="35.0">
                        @error('brazo') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="pierna" class="block text-sm font-medium mb-2">Pierna</label>
                        <input type="number"
                               id="pierna"
                               wire:model="pierna"
                               step="0.1"
                               min="0"
                               max="300"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="55.0">
                        @error('pierna') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                    </div>
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
</div>