<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl font-bold mb-4" style="color: #ff3366;">Connect with Trusted Health Partners</h3>
                    <p class="mb-6 text-lg">
                        Finding the right doctor is a vital step in your health journey. We have partnered with Google to help you find the best doctors in your area. 
                    </p>
                    
                    <div class="mb-8">
                        <h4 class="text-2xl font-semibold mb-4">Find a Doctor</h4>
                        <div class="flex space-x-4">
                            <a href="https://www.google.com/search?q=obgyn+near+me" target="_blank" class="text-white px-6 py-3 rounded-lg transition" style="background-color: #ff3366;">Search for Doctors Near You</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
