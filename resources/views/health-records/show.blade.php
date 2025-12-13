<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Health Record Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-3xl font-bold" style="color: #ff3366;">Record from {{ $healthRecord->created_at->format('F d, Y') }}</h3>
                            <p class="text-lg text-gray-600">A snapshot of your well-being on this day.</p>
                        </div>
                        <a href="{{ route('health-records.index') }}" class="text-gray-600 hover:text-gray-900">Back to Records</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-xl font-semibold mb-2">Menstrual Cycle</h4>
                            <p class="text-lg">{{ $healthRecord->cycle }}</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-xl font-semibold mb-2">Mood</h4>
                            <p class="text-lg">{{ $healthRecord->mood }}</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-xl font-semibold mb-2">Weight</h4>
                            <p class="text-lg">{{ $healthRecord->weight ? $healthRecord->weight . ' kg' : 'Not recorded' }}</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-xl font-semibold mb-2">Height</h4>
                            <p class="text-lg">{{ $healthRecord->height ? $healthRecord->height . ' cm' : 'Not recorded' }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                         <a href="{{ route('health-records.edit', $healthRecord->id) }}" class="text-white px-6 py-3 rounded-lg transition" style="background-color: #ff3366;">Edit Record</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
