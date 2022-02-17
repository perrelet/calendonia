<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class CalendarContoller extends Controller
{

    public function index (Request $request) {

        $args = $request->validate([
            'tense'     => ['nullable', 'string'],
            'offset'    => ['nullable', 'integer'],
            'n'         => ['nullable', 'integer'],
            'reverse'   => ['nullable', 'boolean'],
        ]);

        $tense = $args['tense'] ?? 'future';
        $offset = $args['offset'] ?? false;
        $n = $args['n'] ?? false;
        $order = isset($args['reverse']) ? 'DESC' : 'ASC';

        $query = Event::query()
        ->when($tense === 'future', function ($query) {
            $query->where('start_date', '>=', Carbon::now('Europe/London'));
        })
        ->when($tense === 'past', function ($query) {
            $query->where('start_date', '<=', Carbon::now('Europe/London'));
        })
        ->when($offset, function ($query, $offset) {
            $query->offset($offset);
        })
        ->when($n, function ($query, $n) {
            $query->limit($n);
        })
        ->orderBy('start_date', $order);

        //dd($events);

        return view('calendar', [
            'events' => $query->get()
        ]);

    }

    
}
