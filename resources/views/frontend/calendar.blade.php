@extends('frontend.layout.master')
@section('content')

<!-- Styles -->
{{--  
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css'> --}}
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
<link rel="stylesheet" href="{{ asset('frontend/css/calender.css') }}">

<section class="flat-title-page">
    <div class="container-fluid">
        <div class="row">
            <div id="calendar"></div>
        </div>
    </div>
</section>

<style>
.fc-toolbar .fc-center h2 {
    color: red;
}
</style>

<script>
    // Dynamically load JS scripts
    function loadScript(url, globalVarCheck) {
        return new Promise(function(resolve, reject) {
            if (globalVarCheck && window[globalVarCheck]) { resolve(); return; }
            if (document.querySelector('script[src="' + url + '"]')) { resolve(); return; }

            const script = document.createElement('script');
            script.src = url;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    async function initFullCalendar() {
        try {
            // Load all necessary scripts
            // await loadScript('https://code.jquery.com/jquery-3.7.1.min.js', 'jQuery');
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js', 'moment');
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js', 'fullCalendar');
            await loadScript('https://cdn.jsdelivr.net/npm/sweetalert2@11', 'Swal');

            // Initialize calendar
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    eventLimit: true,
                    themeSystem: 'bootstrap4',
                    defaultView: 'month',
                    header: {
                        left: 'month,agendaWeek,agendaDay',
                        center: 'title',
                        right: 'today prev,next'
                    },
                    events: [
                        {
                            title: 'Restaurant',
                            description: 'Example event description',
                            start: '2026-01-16T09:30:00',
                            end: '2026-01-17T11:45:00',
                            url: 'https://www.lipsum.com/'
                        },
                        {
                            title: 'Restaurant 2',
                            description: 'Example event description',
                            start: '2026-01-16T09:30:00',
                            end: '2026-01-16T11:45:00',
                            url: 'https://www.lipsum.com/'
                        },
                        {
                            title: 'Restaurant 2',
                            description: 'Another event',
                            start: '2026-01-18T10:00:00',
                            end: '2026-01-18T12:00:00',
                            url: 'https://www.lipsum.com/'
                        }
                    ],
                    eventRender: function(event, element) {
                        element.popover({
                            animation: true,
                            delay: 300,
                            content: '<b>Description:</b> ' + event.description,
                            trigger: 'hover',
                            html: true
                        });
                    }
                });
            });

        } catch (err) {
            console.error('Failed to load scripts:', err);
            document.getElementById('calendar').innerHTML = '<p class="text-danger">Failed to load calendar.</p>';
        }
    }

    // SPA-safe initialization: run on page load and when DOM changes
    initFullCalendar();

    // Optional: detect #calendar insertion dynamically (for PJAX/Inertia)
    const observer = new MutationObserver(mutations => {
        mutations.forEach(m => {
            m.addedNodes.forEach(node => {
                if (node.id === 'calendar') { initFullCalendar(); }
            });
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });

</script>

@endsection
