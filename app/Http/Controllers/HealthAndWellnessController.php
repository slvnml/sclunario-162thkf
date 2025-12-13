<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthAndWellnessController extends Controller
{
    public function index()
    {
        return view('health-wellness');
    }
}
