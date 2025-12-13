<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorDirectoryController extends Controller
{
    public function index()
    {
        return view('doctor-directory');
    }
}
