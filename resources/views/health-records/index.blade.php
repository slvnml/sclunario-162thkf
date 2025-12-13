<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Health Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-3xl font-bold" style="color: #ff3366;">Your Health Journey</h3>
                            <p class="text-lg text-gray-600">Track your cycle, mood, and physical well-being.</p>
                        </div>
                        <a href="{{ route('health-records.create') }}" class="text-white px-6 py-3 rounded-lg transition" style="background-color: #ff3366;">Add New Record</a>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ $message }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cycle</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mood</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Height</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($healthRecords as $healthRecord)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $healthRecord->created_at->format('F d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $healthRecord->cycle }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $healthRecord->mood }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $healthRecord->weight }} kg</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $healthRecord->height }} cm</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('health-records.destroy',$healthRecord->id) }}" method="POST">
                                                <a href="{{ route('health-records.show',$healthRecord->id) }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                                <a href="{{ route('health-records.edit',$healthRecord->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            No health records found. Start by adding a new record.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
