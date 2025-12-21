<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $healthRecords = HealthRecord::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        $chartData = $this->prepareChartData($healthRecords);
        $averageCycle = $this->calculateAverageCycle($healthRecords);

        $irregularCycle = false;
        if (is_numeric($averageCycle)) {
            if ($averageCycle < 24 || $averageCycle > 32) {
                $irregularCycle = true;
            }
        }

        $lastCycleStartDate = null;
        $lastPeriodEndDate = null;
        $nextPeriodStartDate = null;

        $lastCycleStartDateRecord = $healthRecords->where('is_cycle_start', true)->sortByDesc('date')->first();

        if ($lastCycleStartDateRecord) {
            $lastCycleStartDate = Carbon::parse($lastCycleStartDateRecord->date);
            $lastPeriodEndDate = $lastCycleStartDate->copy()->addDays(4); // Assuming a 5-day period, so the last day is start + 4
            if (is_numeric($averageCycle)) {
                $nextPeriodStartDate = $lastCycleStartDate->copy()->addDays($averageCycle);
            } else {
                // Fallback to a default 28-day cycle if not enough data
                $nextPeriodStartDate = $lastCycleStartDate->copy()->addDays(28);
            }
        }

        $abnormalWeightFluctuation = false;
        $recordsWithWeight = $healthRecords->whereNotNull('weight')->values();
        if ($recordsWithWeight->count() >= 2) {
            $latestWeight = $recordsWithWeight[0]->weight;
            $previousWeight = $recordsWithWeight[1]->weight;
            if (abs($latestWeight - $previousWeight) >= 10) {
                $abnormalWeightFluctuation = true;
            }
        }

        return view('health-records.index', compact(
            'healthRecords', 
            'chartData', 
            'averageCycle',
            'lastCycleStartDate',
            'lastPeriodEndDate',
            'nextPeriodStartDate',
            'irregularCycle',
            'abnormalWeightFluctuation'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('health-records.create', ['can_start_new_cycle' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'mood' => 'required',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'is_cycle_start' => ['sometimes', 'boolean', function ($attribute, $value, $fail) use ($request) {
                if ($value) {
                    $newDate = Carbon::parse($request->date);
                    $fiveDaysBefore = $newDate->copy()->subDays(4)->toDateString();
                    $fiveDaysAfter = $newDate->copy()->addDays(4)->toDateString();

                    $conflictingCycle = HealthRecord::where('user_id', Auth::id())
                        ->where('is_cycle_start', true)
                        ->whereBetween('date', [$fiveDaysBefore, $fiveDaysAfter])
                        ->exists();

                    if ($conflictingCycle) {
                        $fail('A new cycle cannot be started within 5 days of an existing one.');
                    }
                }
            }],
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        HealthRecord::create($data);

        return redirect()->route('health-records.index')
            ->with('success', 'Health record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthRecord $healthRecord)
    {
        // Ensure the user can only see their own records
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403);
        }

        return view('health-records.show', compact('healthRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HealthRecord $healthRecord)
    {
        // Ensure the user can only edit their own records
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403);
        }

        return view('health-records.edit', compact('healthRecord') + ['can_start_new_cycle' => true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HealthRecord $healthRecord)
    {
        // Ensure the user can only update their own records
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
            'mood' => 'required',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'is_cycle_start' => ['sometimes', 'boolean', function ($attribute, $value, $fail) use ($request, $healthRecord) {
                if ($value) {
                    $newDate = Carbon::parse($request->date);
                    $fiveDaysBefore = $newDate->copy()->subDays(4)->toDateString();
                    $fiveDaysAfter = $newDate->copy()->addDays(4)->toDateString();

                    $conflictingCycle = HealthRecord::where('user_id', Auth::id())
                        ->where('is_cycle_start', true)
                        ->where('id', '!=', $healthRecord->id)
                        ->whereBetween('date', [$fiveDaysBefore, $fiveDaysAfter])
                        ->exists();

                    if ($conflictingCycle) {
                        $fail('A new cycle cannot be started within 5 days of an existing one.');
                    }
                }
            }],
        ]);

        $data = $request->all();
        $data['is_cycle_start'] = $request->has('is_cycle_start');

        $healthRecord->update($data);

        return redirect()->route('health-records.index')
            ->with('success', 'Health record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthRecord $healthRecord)
    {
        // Ensure the user can only delete their own records
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $healthRecord->delete();

        return redirect()->route('health-records.index')
            ->with('success', 'Health record deleted successfully.');
    }

     /**
     * Prepare data for the calendar view.
     */
    public function calendarEvents(Request $request)
    {
        $healthRecords = HealthRecord::where('user_id', Auth::id())->get();

        $events = $healthRecords->map(function ($record) {
            return [
                'title' => $record->mood,
                'start' => $record->date->format('Y-m-d'),
                'extendedProps' => [
                    'is_cycle_start' => $record->is_cycle_start,
                ],
            ];
        });

        $backgroundEvents = collect();
        $cycleStartRecords = $healthRecords->where('is_cycle_start', true);

        foreach ($cycleStartRecords as $record) {
            $startDate = Carbon::parse($record->date);
            for ($i = 0; $i < 5; $i++) {
                $date = $startDate->copy()->addDays($i);
                $backgroundEvents->push([
                    'start' => $date->format('Y-m-d'),
                    'display' => 'background',
                    'backgroundColor' => '#ff3366',
                ]);
            }
        }

        // Predict next cycle
        $lastCycleStartDateRecord = $healthRecords->where('is_cycle_start', true)->sortByDesc('date')->first();
        if ($lastCycleStartDateRecord) {
            $lastCycleStartDate = Carbon::parse($lastCycleStartDateRecord->date);
            $averageCycle = $this->calculateAverageCycle($healthRecords);
            $predictedNextStartDate = null;
            if (is_numeric($averageCycle)) {
                $predictedNextStartDate = $lastCycleStartDate->copy()->addDays($averageCycle);
            } else {
                 $predictedNextStartDate = $lastCycleStartDate->copy()->addDays(28);
            }


            for ($i = 0; $i < 5; $i++) {
                $predictedDate = $predictedNextStartDate->copy()->addDays($i);
                $backgroundEvents->push([
                    'start' => $predictedDate->format('Y-m-d'),
                    'display' => 'background',
                    'backgroundColor' => 'violet',
                ]);
            }
        }

        return response()->json($events->concat($backgroundEvents));
    }


    /**
     * Prepare data for charts.
     */
    private function prepareChartData($records)
    {
        $labels = $records->pluck('date')->map(function ($date) {
            return $date->format('M d');
        });
        $moodData = $records->pluck('mood');
        $weightData = $records->pluck('weight');
        $heightData = $records->pluck('height');

        return [
            'labels' => $labels->reverse(),
            'moodData' => $moodData->reverse(),
            'weightData' => $weightData->reverse(),
            'heightData' => $heightData->reverse(),
        ];
    }

    /**
     * Calculate average cycle length.
     */
    private function calculateAverageCycle($records)
    {
        $cycleStartDates = $records->where('is_cycle_start', true)->pluck('date')->sort()->values();
        
        if ($cycleStartDates->count() < 2) {
            return 'Not enough data to calculate average cycle.';
        }

        $cycleLengths = [];
        for ($i = 0; $i < $cycleStartDates->count() - 1; $i++) {
            $cycleLengths[] = $cycleStartDates[$i]->diffInDays($cycleStartDates[$i+1]);
        }

        return round(collect($cycleLengths)->avg());
    }
}
