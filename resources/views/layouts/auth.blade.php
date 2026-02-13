<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? config('app.name') }}</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            html { font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial; }
        </style>
        @livewireStyles
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 antialiased">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <!-- Logo y título -->
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-3 font-medium" wire:navigate>
                    <div class="size-16 rounded-2xl bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-9">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m9-9H3"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-slate-900">GlowUp</span>
                </a>

                <!-- Card del formulario -->
                <div class="rounded-2xl bg-white border border-slate-200 p-8 shadow-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
