<?php

namespace App\Controller\Api;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiEventController extends AbstractController
{
/**
     * Get events collection
     *
     * @Route("/api/events", name="api_events_get", methods={"GET"})
     */
    public function getCategoriesCollection(EventRepository $eventRepository): Response
    {
        
        // Get event's data
        $eventsList = $eventRepository->findAll();
        

        return $this->json(
            // Serialize data
            $eventsList,
            // status code
            Response::HTTP_OK,
            // Header response (None)
            [],
            // needed groups for serialize
            ['groups' => 'get_events_collection']
        );
    }
}
