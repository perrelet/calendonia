<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class CalendarContoller extends Controller
{

    public function index () {

        $events = Event::
        where('start_date', '>=', Carbon::now('Europe/London'))
        ->orderBy('start_date', 'ASC')
        ->get();

        //dd($events);

        return view('calendar', [
            'events' => $events
        ]);

    }

    
}
