<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Entity\Reservation;
use App\Form\BookingType;
use App\Repository\PrestationsRepository;
use App\Repository\ReservationRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{

    public function __construct(
        private readonly ReservationRepository $reservationRepository,
        private readonly PrestationsRepository $prestationsRepository,
    )
    {
    }
    #[Route('/booking/{id}', name: 'app_booking',  requirements: ['id' => '\d+'])]
    public function index(int $id, Request $request): Response
    {

        $prestation = $this->prestationsRepository->findOneBy(['id' => $id]);
        $booking = new Reservation();
        $booking->setPrestation($prestation);
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $booking = $form->getData();
            var_dump($booking);
            die('booking form submition');

            // ... perform some action, such as saving the task to the database
        }

//        var_dump($form);
//        die('test booking');
        return $this->render('booking/create.html.twig', [
            'form' => $form,
        ]);
    }

}