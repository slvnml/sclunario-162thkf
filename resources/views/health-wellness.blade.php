<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Health & Wellness') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl font-bold mb-4" style="color: #ff3366;">Nourish Your Body & Soul</h3>
                    <p class="mb-8 text-lg">
                        Explore a curated collection of articles on menstrual health, self-care, and wellness, written with the Filipina woman in mind. Empower yourself with knowledge and embrace a healthier, happier you.
                    </p>
                    
                    <div class="mb-8">
                        <h4 class="text-2xl font-semibold mb-4">Featured Articles</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Article 1 -->
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                                <img src="/images/healthy-food.avif" alt="Healthy Food" class="w-full h-40 object-cover rounded-lg mb-4">
                                <h5 class="text-xl font-bold mb-2">Filipina-Friendly Foods for a Healthy Cycle</h5>
                                <p class="text-gray-700 mb-4">Discover local ingredients that can help ease menstrual discomfort and boost your energy.</p>
                                <a href="https://ph.theasianparent.com/period-food-eat" class="hover:underline" style="color: #ff3366;">Read More</a>
                            </div>
                            <!-- Article 2 -->
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                                <img src="/images/woman-exercising-healthy.avif" alt="Exercise" class="w-full h-40 object-cover rounded-lg mb-4">
                                <h5 class="text-xl font-bold mb-2">Gentle Exercises for Period Pain Relief</h5>
                                <p class="text-gray-700 mb-4">Simple, effective workouts to help you stay active and comfortable during your period.</p>
                                <a href="https://www.doctoranywhere.ph/post/5-ways-to-relieve-period-cramps" class="hover:underline" style="color: #ff3366;">Read More</a>
                            </div>
                            <!-- Article 3 -->
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                                <img src="/images/menstrual-cramps.avif" alt="Self-care" class="w-full h-40 object-cover rounded-lg mb-4">
                                <h5 class="text-xl font-bold mb-2">Self-Care Rituals for Filipinas</h5>
                                <p class="text-gray-700 mb-4">Embrace traditional and modern self-care practices to nurture your well-being.</p>
                                <a href="https://www.shopcambio.co/blogs/news/rest-as-resistance-6-filipinas-share-their-self-care-rituals?srsltid=AfmBOorQhojG3FLnxOywFvNRIn_N3sxn0b-6I2vHLacnSKfRzyuAefW0" class="hover:underline" style="color: #ff3366;">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
