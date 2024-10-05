<?php

namespace App\Domain\Enum;

enum AppointmentTypeEnum: string
{
    case ONLINE    = 'online';
    case IN_PERSON = 'in_person';
}