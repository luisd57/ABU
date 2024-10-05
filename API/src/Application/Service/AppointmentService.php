<?php

namespace App\Application\Service;

use App\Application\DTO\CreateAppointmentDTO;
use App\Domain\Entity\Appointment;
use App\Domain\Repository\AppointmentRepositoryInterface;

class AppointmentService
{
    public function __construct(
        private AppointmentRepositoryInterface $appointmentRepository
    ) {}

    public function createAppointment(CreateAppointmentDTO $dto): Appointment
    {
        //Implement some form of validation in the case of unavailable dates

        $appointment = new Appointment(
            $dto->name,
            $dto->surname,
            $dto->email,
            $dto->phoneNumber,
            $dto->date,
            $dto->appointmentType
        );

        $this->appointmentRepository->save($appointment);

        return $appointment;
    }

    /*    public function getAvailableDates(\DateTimeImmutable $start, \DateTimeImmutable $end): array
        {
            return $this->appointmentRepository->findAvailableDates($start, $end);
        }*/
}
