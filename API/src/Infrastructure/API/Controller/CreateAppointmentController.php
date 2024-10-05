<?php

namespace App\Infrastructure\API\Controller;

use App\Application\Command\CreateAppointmentCommand;
use App\Application\DTO\CreateAppointmentDTO;
use App\Application\Service\AppointmentService;
use App\Domain\Enum\AppointmentTypeEnum;
use App\Infrastructure\API\Response\AppointmentResponse;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
class CreateAppointmentController
{
    public function __construct(
        private AppointmentService $appointmentService,
        private ValidatorInterface $validator
    ) {}

    #[Route('/api/appointments', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([
            'name'            => [new Assert\NotBlank(), new Assert\Length(['min' => 2, 'max' => 255])],
            'surname'         => [new Assert\NotBlank(), new Assert\Length(['min' => 2, 'max' => 255])],
            'email'           => [new Assert\NotBlank(), new Assert\Email()],
            'phoneNumber'     => [new Assert\NotBlank(), new Assert\Regex('/^\+?[1-9]\d{1,14}$/')],
            'date'            => [new Assert\NotBlank(), new Assert\Date()],
            'appointmentType' => [
                new Assert\NotBlank(),
                new Assert\Choice(['choices' => [AppointmentTypeEnum::ONLINE->value, AppointmentTypeEnum::IN_PERSON->value]])
            ],
        ]);

        $violations = $this->validator->validate($data, $constraints);

        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return new JsonResponse(['errors' => $errors], 400);
        }

        try {
            $dto = CreateAppointmentDTO::fromArray($data);
            $appointment = $this->appointmentService->createAppointment($dto);
            return new JsonResponse(new AppointmentResponse($appointment), 201);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}