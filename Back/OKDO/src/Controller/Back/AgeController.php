<?php

namespace App\Controller\Back;

use App\Entity\Age;
use App\Form\AgeType;
use App\Repository\AgeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/age")
 */
class AgeController extends AbstractController
{
    /**
     * @Route("/", name="back_age_index", methods={"GET"})
     */
    public function index(AgeRepository $ageRepository): Response
    {
        return $this->render('back/age/index.html.twig', [
            'ages' => $ageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="back_age_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $age = new Age();
        $form = $this->createForm(AgeType::class, $age);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($age);
            $entityManager->flush();

            return $this->redirectToRoute('back_age_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/age/new.html.twig', [
            'age' => $age,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="back_age_show", methods={"GET"})
     */
    public function show(Age $age): Response
    {
        return $this->render('back/age/show.html.twig', [
            'age' => $age,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="back_age_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Age $age, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AgeType::class, $age);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('back_age_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/age/edit.html.twig', [
            'age' => $age,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="back_age_delete", methods={"POST"})
     */
    public function delete(Request $request, Age $age, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$age->getId(), $request->request->get('_token'))) {
            $entityManager->remove($age);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_age_index', [], Response::HTTP_SEE_OTHER);
    }
}
