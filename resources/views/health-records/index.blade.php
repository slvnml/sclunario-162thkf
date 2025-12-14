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

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-pink-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-pink-800">Most Recent Period</h4>
                            @if ($lastCycleStartDate)
                                <p class="text-pink-700 text-sm">{{ $lastCycleStartDate->format('F d, Y') }} - {{ $lastPeriodEndDate->format('F d, Y') }}</p>
                            @else
                                <p class="text-gray-500">Not enough data to predict.</p>
                            @endif
                        </div>
                        <div class="bg-purple-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-purple-800">Next Predicted Period</h4>
                            @if ($nextPeriodStartDate)
                                <p class="text-purple-700 text-sm">{{ $nextPeriodStartDate->format('F d, Y') }}</p>
                            @else
                                <p class="text-gray-500">Not enough data to predict.</p>
                            @endif
                        </div>
                        <div class="bg-indigo-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-indigo-800">Average Cycle Length</h4>
                            <p class="text-indigo-700 text-sm">{{ is_numeric($averageCycle) ? $averageCycle . ' days' : $averageCycle }}</p>
                        </div>
                    </div>

                    <div id='calendar' class="mb-8"></div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cycle Start</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mood</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Height</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($healthRecords as $healthRecord)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $healthRecord->date->format('F d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($healthRecord->is_cycle_start)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">
                                                    Yes
                                                </span>
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </td>
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
    @section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("health-records.calendar-events") }}'
            });
            calendar.render();
        });
    </script>
    @endsection
</x-app-layout>
