<?php

namespace App\Controller\Api;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiCategoriesController extends AbstractController
{
    /**
     * Get categories collection
     *
     * @Route("/api/categories", name="api_categories_get", methods={"GET"})
     */
    public function getCategoriesCollection(CategoryRepository $categoryRepository): Response
    {
        // Get catagorie's data
        $categoriesList = $categoryRepository->findAll();
        

        return $this->json(
            // Serialize data
            $categoriesList,
            // status code
            Response::HTTP_OK,
            // Header response (None)
            [],
            // // needed groups for serialize
            ['groups' => 'get_categories_collection']
        );
    }
}