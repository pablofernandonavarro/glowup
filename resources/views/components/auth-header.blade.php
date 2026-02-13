@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center gap-2">
    <h1 class="text-2xl font-bold text-slate-900">{{ $title }}</h1>
    <p class="text-sm text-slate-600">{{ $description }}</p>
</div>
