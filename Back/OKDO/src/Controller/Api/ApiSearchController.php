<?php

namespace App\Controller\Api;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiSearchController extends AbstractController
{
    /**
     * Allow to filters product by ages/events/categories/genre
     * 
     * @Route("/api/search", name="api_search", methods={"POST"})
     */
    public function search(ProductRepository $productRepository, Request $request): Response
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
       
        // Regroup data on different filters
        $categories = $data['categories'];
        $ages = $data['ages'];
        $genres = $data['genres'];
        $events = $data['events'];

        $productListForProfile = $productRepository->findProductByFilters($categories, $ages, $genres, $events);

        return $this->json(
            // serialize data
            $productListForProfile,
            // status code
            200,
            // Headers response (none)
            [],
            // Needed groups for serialization
            ['groups' => 'get_searchs_collection']
        );
    }
}
