<?php

namespace App\Controller\Back;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/genre")
 */
class GenreController extends AbstractController
{
    /**
     * Index genre page
     * 
     * @Route("/", name="back_genre_index", methods={"GET"})
     */
    public function index(GenreRepository $genreRepository): Response
    {
        return $this->render('back/genre/index.html.twig', [
            'genres' => $genreRepository->findAll(),
        ]);
    }

    /**
     * Create genre page
     * 
     * @Route("/new", name="back_genre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genre);
            $entityManager->flush();

            return $this->redirectToRoute('back_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/genre/new.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    /**
     * Show single genre page
     * 
     * @Route("/{id}", name="back_genre_show", methods={"GET"})
     */
    public function show(Genre $genre): Response
    {
        return $this->render('back/genre/show.html.twig', [
            'genre' => $genre,
        ]);
    }

    /**
     *  Update genre page
     * 
     * @Route("/{id}/edit", name="back_genre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Genre $genre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('back_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/genre/edit.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    /**
     *  DELETE single event page
     * 
     * @Route("/{id}", name="back_genre_delete", methods={"POST"})
     */
    public function delete(Request $request, Genre $genre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($genre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_genre_index', [], Response::HTTP_SEE_OTHER);
    }
}
