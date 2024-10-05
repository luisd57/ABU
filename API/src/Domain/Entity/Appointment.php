<?php

namespace App\Domain\Entity;

use App\Domain\Enum\AppointmentTypeEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $surname;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 20)]
    private string $phoneNumber;

    #[ORM\Column(type: 'date_immutable')]
    private \DateTimeImmutable $date;

    #[ORM\Column(type: 'string', enumType: AppointmentTypeEnum::class)]
    private AppointmentTypeEnum $type;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(
        string              $name,
        string              $surname,
        string              $email,
        string              $phoneNumber,
        \DateTimeImmutable  $date,
        AppointmentTypeEnum $type
    )
    {
        $this->name        = $name;
        $this->surname     = $surname;
        $this->email       = $email;
        $this->phoneNumber = $phoneNumber;
        $this->date        = $date;
        $this->type        = $type;
        $this->createdAt   = new \DateTimeImmutable();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}