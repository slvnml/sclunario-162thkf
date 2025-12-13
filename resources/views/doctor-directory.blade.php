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
                        Finding the right doctor is a vital step in your health journey. Our directory features a curated list of trusted OB-GYNs and specialists across the Philippines, dedicated to providing compassionate and expert care for every Filipina.
                    </p>
                    
                    <div class="mb-8">
                        <h4 class="text-2xl font-semibold mb-4">Find a Doctor</h4>
                        <div class="flex space-x-4">
                            <input type="text" placeholder="Search by name, specialization, or location..." class="w-full p-3 border border-gray-300 rounded-lg">
                            <button class="text-white px-6 py-3 rounded-lg transition" style="background-color: #ff3366;">Search</button>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-2xl font-semibold mb-4">Featured Doctors</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                                <div class="flex items-center mb-4">
                                    <img src="/images/women-doctor.avif" alt="Doctor" class="w-16 h-16 rounded-full mr-4">
                                    <div>
                                        <h5 class="text-xl font-bold">Dr. Maria Santos, MD</h5>
                                        <p class="text-gray-600">OB-GYN</p>
                                    </div>
                                </div>
                                <p class="text-gray-700">Specializes in reproductive health and prenatal care. Compassionate and dedicated to her patients' well-being.</p>
                                <a href="#" class="hover:underline mt-4 inline-block" style="color: #ff3366;">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
