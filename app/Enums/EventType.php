<?php

namespace App\Enums;

enum EventType: string
{
    case UpcomingEvent = 'Upcoming events';
    case GeneralEvent = 'General events';
}
