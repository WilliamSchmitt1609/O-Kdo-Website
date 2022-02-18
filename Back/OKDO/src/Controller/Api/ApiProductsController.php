<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiProductsController extends AbstractController
{
    /**
     * Get products collection
     *
     * @Route("/api/products", name="api_products_get", methods={"GET"})
     */
    public function getProductsCollection(ProductRepository $productRepository): Response
    {
        // Get product's data
        $productsList = $productRepository->findAll();
        

        return $this->json(
            // Serialize data
            $productsList,
            // status code
            Response::HTTP_OK,
            // Header response (None)
            [],
            // needed groups for serialize
            ['groups' => 'get_products_collection']
        );
    }

    /**
     * Get a product with one category associate
     * 
     * @Route("/api/category/{id}/products", name="api_products_get_category", methods={"GET"})
     */
    public function getProductsByCategory($id, CategoryRepository $categoryRepository): Response
    {
        // 404 ?
        
        // if ($product === null) {
        //     return $this->json(['error' => 'Product not find.'], Response::HTTP_NOT_FOUND);
        // }

        $category = $categoryRepository->find($id);
        $productsList = $category->getProducts();

        // array PHP convert to JSON
        $data = [
            'category' => $category,
            'products' => $productsList,
        ];

        return $this->json(
            $data,
            Response::HTTP_OK,
            [],
            [
                'groups' => [
                    // Product group
                    'get_products_collection'
                ]
            ]);
    }

    /**
     * Get a single product
     * 
     * @Route("/api/products/{id<\d+>}", name="api_products_get_item", methods={"GET"})
     */
    public function getItem(Product $product = null): Response
    {

        // 404 ?
        if ($product === null) {
            return $this->json(['error' => 'Product Not find.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($product, Response::HTTP_OK, [], ['groups' => 'get_products_collection']);
    }

    

}
