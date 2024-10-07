<?php

namespace App\Presentation\API\Response;

use App\Domain\Entity\Appointment;

class AppointmentResponse implements \JsonSerializable
{
    public function __construct(private Appointment $appointment) {}

    public function jsonSerialize(): array
    {
        return [
            'id'          => $this->appointment->getId(),
            'name'        => $this->appointment->getName(),
            'surname'     => $this->appointment->getSurname(),
            'email'       => $this->appointment->getEmail(),
            'phoneNumber' => $this->appointment->getPhoneNumber(),
            'date'        => $this->appointment->getDate()->format('Y-m-d'),
            'type'        => $this->appointment->getType()->value,
            'createdAt'   => $this->appointment->getCreatedAt()->format('c'),
        ];
    }
}