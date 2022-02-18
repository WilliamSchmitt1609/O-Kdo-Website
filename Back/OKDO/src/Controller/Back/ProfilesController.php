<?php

namespace App\Controller\Back;

use App\Entity\Profiles;
use App\Form\ProfilesType;
use App\Repository\ProfilesRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/profiles")
 */
class ProfilesController extends AbstractController
{
    /**
     * Show list profile page 
     * 
     * @Route("/", name="back_profiles_index", methods={"GET"})
     */
    public function index(ProfilesRepository $profilesRepository): Response
    {
        return $this->render('back/profiles/index.html.twig', [
            'profiles' => $profilesRepository->findAll(),
        ]);
    }

    /**
     * Create profile page 
     * 
     * @Route("/new", name="back_profiles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profile = new Profiles();
        $form = $this->createForm(ProfilesType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile->setCreatedAt(new DateTime());
            $entityManager->persist($profile);
            $entityManager->flush();

            return $this->redirectToRoute('back_profiles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/profiles/new.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    /**
     * Show single profile page 
     * 
     * @Route("/{id}", name="back_profiles_show", methods={"GET"})
     */
    public function show(Profiles $profile): Response
    {
        return $this->render('back/profiles/show.html.twig', [
            'profile' => $profile,
        ]);
    }

    /**
     * Update profile page 
     * 
     * @Route("/{id}/edit", name="back_profiles_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Profiles $profile, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfilesType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile->setUpdatedAt(new DateTime());
            $entityManager->flush();

            return $this->redirectToRoute('back_profiles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/profiles/edit.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    /**
     * DELETE profile page 
     * 
     * @Route("/{id}", name="back_profiles_delete", methods={"POST"})
     */
    public function delete(Request $request, Profiles $profile, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->request->get('_token'))) {
            $entityManager->remove($profile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_profiles_index', [], Response::HTTP_SEE_OTHER);
    }
}
