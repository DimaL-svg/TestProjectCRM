<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Статистика по заявкам') }}
            </h2>
            <a href="{{ route('dashboard') }}"
                class="text-white hover:text-blue-700 px-4 py-2 rounded inline-block bg-blue-500">
                Повернутися до панелі керування
            </a>
        </div>
    </x-slot>
    <div class="py-12 container mx-auto px-4">
        <div class="grid grid-cols-4 gap-6 mb-6">
            <div class="card border-l-4 border-green-500">
                <h1 class="mr-2">За день: </h1>
                <p>{{ $stats['today'] }}</p>
            </div>
            <div class="card border-l-4 border-blue-500">
                <h1 class="mr-2">За тиждень: </h1>
                <p>{{ $stats['weekly'] }}</p>
            </div>
            <div class="card border-l-4 border-yellow-500 ">
                <h1 class="mr-2">За місяць: </h1>
                <p>{{ $stats['monthly'] }}</p>
            </div>
            <div class="card border-l-4 border-red-500 ">
                <h1 class="mr-2">Всього: </h1>
                <p>{{ $stats['total'] }}</p>
            </div>
        </div>
</x-app-layout>