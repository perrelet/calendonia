<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use App\Services\EventsService;
use Illuminate\Support\Facades\Route;

class CalendarContoller extends Controller
{

    public function index (EventsService $eventsService, Request $request, $template = null) {
        
        $templates = ['simple', 'directory', 'grid', 'hub'];

        $args = $request->validate([
            'template'  => ['nullable', 'string'],
            'tense'     => ['nullable', 'string'],
            'offset'    => ['nullable', 'integer'],
            'n'         => ['nullable', 'integer'],
            'group'     => ['nullable', 'string'],
            'ppp'       => ['nullable', 'integer'],
            'reverse'   => ['nullable', 'boolean'],
            'tags'      => ['nullable', 'string'],
            'xtags'     => ['nullable', 'string'],
            'filters'   => ['nullable', 'string'],
        ]);

        if (is_null($template)) $template = $args['template'] ?? $templates[0];
        $template = in_array($template, $templates) ? $template : $templates[0];
        $component = "event.{$template}";

        $args['tense'] = $args['tense'] ?? 'future';
        $args['offset'] = $args['offset'] ?? false;
        $args['n'] = $args['n'] ?? false;
        $args['group'] = $args['group'] ?? "F Y";
        if ($args['group']) $args['group'] = str_replace("-", " ", $args['group']);
        $args['ppp'] = $args['ppp'] ?? 12;
        $args['order'] = isset($args['reverse']) ? 'DESC' : 'ASC';

        $args['tags'] = isset($args['tags']) ? array_map('trim', explode(',', $args['tags'])) : [];
        $args['xtags'] = isset($args['xtags']) ? array_map('trim', explode(',', $args['xtags'])) : [];
        $filters = isset($args['filters']) ? array_map('trim', explode(',', $args['filters'])) : [];

        $query = Event::query()
        ->when($args['tense'] === 'future', function ($query) {
            $query->where('start_date', '>=', Carbon::now('Europe/London'));
        })
        ->when($args['tense'] === 'past', function ($query) {
            $query->where('start_date', '<=', Carbon::now('Europe/London'));
        })
        ->when($args['offset'], function ($query, $offset) {
            $query->offset($offset);
        })
        ->when($args['n'], function ($query, $n) {
            $query->limit($n);
        })
        ->when($args['tags'], function ($query, $tags) {
            $query->withAnyTags($tags);
        })
        ->when($args['xtags'], function ($query, $xtags) {
            $query->withoutTags($xtags);
        })
        ->whereNull('hide')
        ->orderBy('start_date', $args['order']);

        if ($args['ppp']) {
            $events = $query->paginate($args['ppp']);
        } else {
            $events = $query->get();
        }

        $grouped = $args['group'] ? $eventsService->group_events($events, $args['group']) : null;

        //if ($args['group']) $events = $eventsService->group_events($events, $args['group']);

        $params = [
            'template'  => $template,
            'component' => $component,
            'events'    => $events,
            'grouped'   => $grouped,
            'args'      => $args,
        ];

        $uri = explode("/", Route::current()->uri);
        if ($uri && ($uri[0] == 'api')) return $params;

        return view('calendar', $params);

    }

    
}
