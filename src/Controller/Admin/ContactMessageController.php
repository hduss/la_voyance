<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactMessageController
{
    #[Route('/calendar', name: 'app_booking_calendar_admin', methods: ['GET'])]
    public function calendar(): Response
    {
        return $this->render('booking/calendar.html.twig');
    }
}


