<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Health Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl font-bold mb-6" style="color: #ff3366;">Log Your Well-being</h3>
                    <form action="{{ route('health-records.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cycle -->
                            <div>
                                <label for="cycle" class="block text-lg font-medium text-gray-700">Menstrual Cycle</label>
                                <select name="cycle" id="cycle" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" required>
                                    <option value="" disabled selected>Select your cycle phase</option>
                                    <option value="Menstruation">Menstruation</option>
                                    <option value="Follicular Phase">Follicular Phase</option>
                                    <option value="Ovulation">Ovulation</option>
                                    <option value="Luteal Phase">Luteal Phase</option>
                                </select>
                            </div>

                            <!-- Mood -->
                            <div>
                                <label for="mood" class="block text-lg font-medium text-gray-700">Your Mood</label>
                                <select name="mood" id="mood" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" required>
                                    <option value="" disabled selected>How are you feeling?</option>
                                    <option value="Happy">Happy</option>
                                    <option value="Sad">Sad</option>
                                    <option value="Anxious">Anxious</option>
                                    <option value="Energetic">Energetic</option>
                                    <option value="Fatigued">Fatigued</option>
                                </select>
                            </div>

                            <!-- Weight -->
                            <div>
                                <label for="weight" class="block text-lg font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" name="weight" id="weight" step="0.1" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" placeholder="e.g., 55.5">
                            </div>

                            <!-- Height -->
                            <div>
                                <label for="height" class="block text-lg font-medium text-gray-700">Height (cm)</label>
                                <input type="number" name="height" id="height" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" placeholder="e.g., 160">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <a href="{{ route('health-records.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="text-white px-6 py-3 rounded-lg transition" style="background-color: #ff3366;">Add Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
