<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Entity\Appointment;
use App\Domain\Repository\AppointmentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineAppointmentRepository extends ServiceEntityRepository implements AppointmentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appointment::class);
    }

    public function save(Appointment $appointment): void
    {
        $this->getEntityManager()->persist($appointment);
        $this->getEntityManager()->flush();
    }
}