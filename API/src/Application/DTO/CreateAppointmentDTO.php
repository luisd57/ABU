<?php

namespace App\Application\DTO;

use App\Domain\Enum\AppointmentTypeEnum;

class CreateAppointmentDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $surname,
        public readonly string $email,
        public readonly string $phoneNumber,
        public readonly \DateTimeImmutable $date,
        public readonly AppointmentTypeEnum $appointmentType
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['surname'],
            $data['email'],
            $data['phoneNumber'],
            new \DateTimeImmutable($data['date']),
            AppointmentTypeEnum::from($data['appointmentType'])
        );
    }
}