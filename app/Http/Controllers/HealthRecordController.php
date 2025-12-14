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

        return view('health-records.index', compact('healthRecords', 'chartData', 'averageCycle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('health-records.create');
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
            'is_cycle_start' => 'sometimes|boolean',
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

        return view('health-records.edit', compact('healthRecord'));
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
            'is_cycle_start' => 'sometimes|boolean',
        ]);

        $healthRecord->update($request->all());

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
        $lastCycleStartDate = $healthRecords->where('is_cycle_start', true)->sortByDesc('date')->first();
        if ($lastCycleStartDate) {
            $predictedNextStartDate = Carbon::parse($lastCycleStartDate->date)->addDays(4)->addDays(28);
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
        $cycleStartDates = $records->where('is_cycle_start', true)->pluck('date')->sort();
        
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
