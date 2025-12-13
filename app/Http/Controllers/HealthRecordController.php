<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $healthRecords = HealthRecord::all();
        return view('health-records.index', compact('healthRecords'));
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
            'cycle' => 'required',
            'mood' => 'required',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        HealthRecord::create($request->all());

        return redirect()->route('health-records.index')
            ->with('success', 'Health record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthRecord $healthRecord)
    {
        return view('health-records.show', compact('healthRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HealthRecord $healthRecord)
    {
        return view('health-records.edit', compact('healthRecord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HealthRecord $healthRecord)
    {
        $request->validate([
            'cycle' => 'required',
            'mood' => 'required',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
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
        $healthRecord->delete();

        return redirect()->route('health-records.index')
            ->with('success', 'Health record deleted successfully.');
    }
}
