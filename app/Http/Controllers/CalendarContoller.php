<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use App\Services\EventsService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Spatie\Tags\Tag;

class CalendarContoller extends Controller
{

    public function index (EventsService $eventsService, Request $request, $template = null) {
        
        $templates = ['simple', 'directory', 'grid', 'hub', 'calendar', 'fullcal'];

        $args = $request->validate([
            'template'  => ['nullable', 'string'],      // Template to render
            'start'     => ['nullable', 'string'],      // Get dates starting from
            'end'       => ['nullable', 'string'],      // Get dates until
            'tense'     => ['nullable', 'string'],      // 
            'timezone'  => ['nullable', 'string'],      // Timezone to display dates in (see https://www.php.net/manual/en/timezones.php)
            'order'     => ['nullable', 'string'],      // Date order. Default's to ASC for future and DESC for past tense.
            'offset'    => ['nullable', 'integer'],     // Skips n dates.
            'n'         => ['nullable', 'integer'],     // Maximum total dates to collect from the db.
            'group'     => ['nullable', 'string'],      // Group events by date. Defaults to "F Y".
            'ppp'       => ['nullable', 'integer'],     // Events per page to display.
            'type'      => ['nullable', 'string'],      // Filters events by type.
            'tags'      => ['nullable', 'string'],      // Filters events by tag(s).
            'xtags'     => ['nullable', 'string'],      // Inverser filters events by tag(s).  
            'filters'   => ['nullable', 'string'],      // Not used.
            'ui'        => ['nullable', 'integer'],     // Whether to display the user controls panel.
            'ui_type'   => ['nullable', 'integer'],     // Display type filtering in ui.
            'ui_tags'   => ['nullable', 'integer'],     // Display tag filtering in ui.
            'direct'    => ['nullable', 'integer'],     // Links events to their access_url value if one exists.
        ]);

        $uri = explode("/", Route::current()->uri);
        $api = ($uri && ($uri[0] == 'api'));

        if (is_null($template)) $template = $args['template'] ?? $templates[0];
        $template = in_array($template, $templates) ? $template : $templates[0];
        $component = "event.{$template}";

        $args['start'] = $args['start'] ?? null;
        $args['end'] = $args['end'] ?? null;

        $args['tense'] = $args['tense'] ?? 'future';

        $args['timezone'] = $args['timezone'] ?? null;
        $args['order'] = $args['order'] ?? ($args['tense'] == 'past' ? 'desc' : 'asc');
        $args['offset'] = $args['offset'] ?? false;
        $args['n'] = $args['n'] ?? false;
        $args['group'] = $args['group'] ?? "F Y";
        if ($args['group']) $args['group'] = str_replace("-", " ", $args['group']);
        $args['ppp'] = $args['ppp'] ?? 8;

        $args['type'] = isset($args['type']) && $args['type'] ? $args['type'] : false;
        if ($args['type']) $args['type'] = str_replace("-", " ", $args['type']);
        if ($args['type']) $args['type'] = explode(",", $args['type']);

        $args['tags'] = isset($args['tags']) && $args['tags'] ? array_map('trim', explode(',', $args['tags'])) : [];
        $args['xtags'] = isset($args['xtags']) && $args['xtags'] ? array_map('trim', explode(',', $args['xtags'])) : [];
        //$filters = isset($args['filters']) ? array_map('trim', explode(',', $args['filters'])) : [];
        
        $args['ui']         = $args['ui'] ?? 1;
        $args['ui_type']    = $args['ui_type'] ?? 1;
        $args['ui_tags']    = $args['ui_tags'] ?? 0;

        $args['direct'] = $args['direct'] ?? 0;

        $query = Event::query()
        ->when($args['start'], function ($query, $start) {
            $query->where('start_date', '>=', Carbon::parse($start));
        })
        ->when($args['end'], function ($query, $end) {
            $query->where('start_date', '<=', Carbon::parse($end));
        })
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
        ->when($args['type'], function ($query, $type) {
            $query->whereIn('type', $type);
        })
        ->when($args['tags'], function ($query, $tags) {
            $query->withAnyTags($tags);
        })
        ->when($args['xtags'], function ($query, $xtags) {
            $query->withoutTags($xtags);
        })
        ->whereNull('hide')
        ->orderBy('start_date', $args['order']);

        if ($args['ppp'] && !$api) {
            $events = $query->paginate($args['ppp']);
        } else {
            $events = $query->get();
        }

        if ($args['ui']) {
            if ($args['ui_type']) $args['list_types'] = Event::select('type')->distinct()->orderBy('type')->pluck('type');
            if ($args['ui_tags']) $args['list_tags'] = Tag::all()->sortBy('slug');
        }

        $grouped = $args['group'] ? $eventsService->group_events($events, $args['group']) : null;

        //if ($args['group']) $events = $eventsService->group_events($events, $args['group']);

        $params = [
            'component' => $component,
            'events'    => $events,
            'grouped'   => $grouped,
        ];

        if ($api) {
            
            if ($template == 'fullcal') {
                $full_cal_events = [];
                foreach ($events as $event) $full_cal_events[] = $event->to_full_calendar();
                return $full_cal_events;
            } else {
                return $events;
            }
            

        }

        View::share('template', $template);
        View::share('args', $args);

        return view('calendar', $params);

    }

    
}
