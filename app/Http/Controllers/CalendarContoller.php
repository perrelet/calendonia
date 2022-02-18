<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class CalendarContoller extends Controller
{

    public function index (Request $request) {

        $templates = ['simple', 'directory', 'grid'];

        $args = $request->validate([
            'template'  => ['nullable', 'string'],
            'tense'     => ['nullable', 'string'],
            'offset'    => ['nullable', 'integer'],
            'n'         => ['nullable', 'integer'],
            'reverse'   => ['nullable', 'boolean'],
            'tags'      => ['nullable', 'string'],
            'xtags'     => ['nullable', 'string'],
        ]);

        $template = $args['template'] ?? $templates[0];
        $template = in_array($template, $templates) ? $template : $templates[0];
        $component = "event.{$template}";

        $tense = $args['tense'] ?? 'future';
        $offset = $args['offset'] ?? false;
        $n = $args['n'] ?? false;
        $order = isset($args['reverse']) ? 'DESC' : 'ASC';

        $tags = isset($args['tags']) ? array_map('trim', explode(',', $args['tags'])) : [];
        $xtags = isset($args['xtags']) ? array_map('trim', explode(',', $args['tags'])) : [];

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
            'template'  => $template,
            'component' => $component,
            'events'    => $query->get(),
        ]);

    }

    
}
