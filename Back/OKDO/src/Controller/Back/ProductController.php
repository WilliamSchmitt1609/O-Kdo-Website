<?php

namespace App\Controller\Back;

use DateTime;
use App\Entity\Age;
use App\Entity\Event;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;
use App\Repository\AgeRepository;
use App\Repository\EventRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/back/product")
 */
class ProductController extends AbstractController
{
    /**
     * Index list product page 
     * 
     * @Route("/", name="back_product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('back/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     *  Create product page 
     * 
     * @Route("/new", name="back_product_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        dump ($product);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCreatedAt(new DateTime);
            $entityManager->persist($product);
            dump($product);
            $entityManager->flush();
            
            return $this->redirectToRoute('back_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * Show single product page 
     * 
     * @Route("/{id}", name="back_product_show", methods={"GET"})
     */
    public function show(Product $products): Response
    {
        return $this->render('back/product/show.html.twig', [
            'product' => $products,
        ]);
    }

    /**
     * Update product page 
     * 
     * @Route("/{id}/edit", name="back_product_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUpdatedAt(new DateTime);
            $entityManager->flush();

            return $this->redirectToRoute('back_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
    * Delete product page  
    *
    * @Route("/{id}", name="back_product_delete", methods={"POST"})
    */
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_product_index', [], Response::HTTP_SEE_OTHER);
    }

 
   
}
