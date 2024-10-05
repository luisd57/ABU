<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Appointment;

interface AppointmentRepositoryInterface
{
    public function save(Appointment $appointment): void;

    /*    public function findAvailableDates(\DateTimeImmutable $start, \DateTimeImmutable $end): array;*/
}