<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event calendar using jQuery</title>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.css'>
    <link rel="stylesheet" href="{{ asset('frontend/css/calender.css') }}">

</head>


<body>
    <div id='calendar'></div>
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>

    <script>
        $(document).ready(function() {
            (function() {
                'use strict';
                // ------------------------------------------------------- //
                // Calendar
                // ------------------------------------------------------ //
                jQuery(function() {

                    jQuery('#calendar').fullCalendar({
                        eventLimit: true,
                        themeSystem: 'bootstrap4',
                        // emphasizes business hours
                        businessHours: false,
                        defaultView: 'month',
                        //defaultDate: 'now',
                        header: {
                            left: 'month,agendaWeek,agendaDay',
                            center: 'title',
                            right: 'today prev,next'
                        },
                        eventRender: function(info) {

                        },
                        events: [{
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2026-01-16T09:30:00',
                                end: '2026-01-16T11:45:00',
                                url: 'https://www.lipsum.com/'
                            },
                            {
                                title: 'Restaurant 2',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2026-01-16T09:30:00',
                                end: '2026-01-18T11:45:00',
                                url: 'https://www.lipsum.com/'
                            },
                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2025-05-15T09:30:00',
                                end: '2025-05-15T11:45:00',

                            },
                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2025-05-17T09:30:00',
                                end: '2025-05-17T11:45:00',

                            },
                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2025-05-20T09:30:00',
                                end: '2025-05-20T11:45:00',

                            },
                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2025-06-15T09:30:00',
                                end: '2025-06-15T11:45:00',

                            },
                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2025-06-15T09:30:00',
                                end: '2025-06-15T11:45:00',

                            },

                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2020-07-16T09:30:00',
                                end: '2020-07-16T11:45:00',

                            },
                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2020-03-17T09:30:00',
                                end: '2020-03-17T11:45:00',

                            },
                            {
                                title: 'Restaurant',
                                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                                start: '2020-03-18T09:30:00',
                                end: '2020-03-18T11:45:00',

                            },
                        ],
                        eventRender: function(event, element) {
                            element.popover({
                                animation: true,
                                delay: 300,
                                content: '<b>Inicio</b>:' + event.description,
                                trigger: 'hover',
                                html: true,
                            });
                            //if(event.icon){
                            element.find(".fc-title").prepend("<i class='fa fa-" + event.icon + "'></i>");
                            //} 
                        },
                    });
                });

            })(jQuery);

        })
    </script>
    <style>

    </style>
</body>

</html>