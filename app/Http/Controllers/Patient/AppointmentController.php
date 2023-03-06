<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        $specialties = Specialty::all();

        return view('appointments.create', compact('specialties'));
    }
}
