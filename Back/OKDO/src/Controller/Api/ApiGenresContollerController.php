<?php

namespace App\Controller\Api;

use App\Repository\GenreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiGenresContollerController extends AbstractController
{
    /**
     * Get profiles collection
     *
     * @Route("/api/genres", name="api_genres_get", methods={"GET"})
     */
    public function getGenresCollection(GenreRepository $genreRepository): Response
    {
        
        // Get genre's data
        $genresList = $genreRepository->findAll();
        

        return $this->json(
            // Serialize data
            $genresList,
            // status code
            Response::HTTP_OK,
            // Header response (None)
            [],
            // needed groups for serialize
            ['groups' => 'get_genres_collection']
        );
    }
}
