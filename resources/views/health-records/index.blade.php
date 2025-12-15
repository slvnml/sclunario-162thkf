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

                    @if ($irregularCycle)
                        <div id="irregular-cycle-alert" class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM9 5v6h2V5H9zm0 8h2v2H9v-2z"/></svg></div>
                                <div>
                                    <p class="font-bold">Irregular period detected</p>
                                    <p class="text-sm">Your average cycle length is outside the typical range. Please consult a doctor. <a href="{{ route('doctor-directory') }}" class="font-semibold underline">Find a doctor</a>.</p>
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-yellow-100 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex h-8 w-8" onclick="document.getElementById('irregular-cycle-alert').style.display='none'">
                                    <span class="sr-only">Dismiss</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    @if ($abnormalWeightFluctuation)
                        <div id="abnormal-weight-alert" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM9 5v6h2V5H9zm0 8h2v2H9v-2z"/></svg></div>
                                <div>
                                    <p class="font-bold">Abnormal weight fluctuations recorded</p>
                                    <p class="text-sm">Please see doctors or consult articles. <a href="{{ route('doctor-directory') }}" class="font-semibold underline">Find a doctor</a> or <a href="{{ route('health-wellness') }}" class="font-semibold underline">read articles</a>.</p>
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8" onclick="document.getElementById('abnormal-weight-alert').style.display='none'">
                                    <span class="sr-only">Dismiss</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
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
