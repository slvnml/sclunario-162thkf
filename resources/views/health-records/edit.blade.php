<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Health Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl font-bold mb-6" style="color: #ff3366;">Update Your Record</h3>
                    <form action="{{ route('health-records.update', $healthRecord->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Date -->
                            <div>
                                <label for="date" class="block text-lg font-medium text-gray-700">Date</label>
                                <input type="date" name="date" id="date" value="{{ $healthRecord->date->format('Y-m-d') }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>

                            <!-- Mood -->
                            <div>
                                <label for="mood" class="block text-lg font-medium text-gray-700">Your Mood</label>
                                <select name="mood" id="mood" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" required>
                                    <option value="Happy" {{ $healthRecord->mood == 'Happy' ? 'selected' : '' }}>Happy</option>
                                    <option value="Sad" {{ $healthRecord->mood == 'Sad' ? 'selected' : '' }}>Sad</option>
                                    <option value="Anxious" {{ $healthRecord->mood == 'Anxious' ? 'selected' : '' }}>Anxious</option>
                                    <option value="Energetic" {{ $healthRecord->mood == 'Energetic' ? 'selected' : '' }}>Energetic</option>
                                    <option value="Fatigued" {{ $healthRecord->mood == 'Fatigued' ? 'selected' : '' }}>Fatigued</option>
                                </select>
                            </div>

                            <!-- Weight -->
                            <div>
                                <label for="weight" class="block text-lg font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" name="weight" id="weight" step="0.1" value="{{ $healthRecord->weight }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" placeholder="e.g., 55.5">
                            </div>

                            <!-- Height -->
                            <div>
                                <label for="height" class="block text-lg font-medium text-gray-700">Height (cm)</label>
                                <input type="number" name="height" id="height" value="{{ $healthRecord->height }}" class="mt-1 block w-full p-3 border border-ray-300 rounded-lg" placeholder="e.g., 160">
                            </div>

                            <!-- Is Cycle Start -->
                            <div class="col-span-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_cycle_start" id="is_cycle_start" value="1" {{ $healthRecord->is_cycle_start ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="is_cycle_start" class="ml-2 block text-sm text-gray-900">
                                        Mark this as the start of a new menstrual cycle
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <a href="{{ route('health-records.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="text-white px-6 py-3 rounded-lg transition" style="background-color: #ff3366;">Update Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
