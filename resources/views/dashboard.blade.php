<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Population Data (RV021)</h3>
@php
    dd($populationData);
@endphp
                    @if($populationData && $populationData->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <!-- Table header and body here -->
                        </table>
                        <div class="mt-4">
                            {{ $populationData->links() }}
                        </div>
                    @else
                        <p>No data available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>