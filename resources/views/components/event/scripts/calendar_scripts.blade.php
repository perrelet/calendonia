<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',
            events: "{{url('/api/fullcal?tense=all')}}"
            {{-- events: [<?php

                $events->each(function($event, $key) {
                    // Print each city name
                    echo json_encode($event->to_full_calendar()) . ",";
                });
            ?>] --}}
        });
        calendar.render();

    });

</script>