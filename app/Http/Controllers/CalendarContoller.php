<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarContoller extends Controller
{

    public function index () {

        return view('calendar');

    }

    
}
