<?php

namespace App\Controller\Api;


use App\Entity\User;
use App\Entity\Profiles;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProfilesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiProfilesController extends AbstractController
{
    /**
     * Get profiles collection
     *
     * @Route("/api/secure/user/{id<\d+>}/profiles", name="api_profiles_get", methods={"GET"})
     */
    public function getProfilesCollection($id, UserRepository $userRepository, ProfilesRepository $profilesRepository): Response
    {
        
        
        $user = $userRepository->find($id);
        $profilesList = $user->getProfiles();
        

        return $this->json(
            // Serialize data
            $profilesList,
            // status code
            Response::HTTP_OK,
            // Header response (None)
            [],
            // needed groups for serialize
            ['groups' => 'get_profiles_collection']
        );
    }

    /**
     * Get single profile
     * 
     * @Route("/api/secure/profiles/{id<\d+>}", name="api_profiles_get_item", methods={"GET"})
     */
    public function getItem(Profiles $profiles = null, User $user): Response
    {


        $profiles->setUser($user);
        // 404 ?
       if ($profiles === null) {
            return $this->json(['error' => 'Profil de recherche non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($profiles, Response::HTTP_OK, [], ['groups' => 'get_profiles_collection']);
    }

    


    /**
     * Create profiles linked by one user
     * 
     * @Route("/api/secure/user/{id}/profiles", name="api_profiles_post", methods={"POST"})
     * 
     */
    public function createItem($id, CategoryRepository $categoryRepository, Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator, UserRepository $userRepository): Response
    {
        $profiles = $serializer->deserialize($request->getContent(), Profiles::class, 'json');

        $jsonContent = json_decode($request->getContent(), true);

        $user = $userRepository->find($id);

        $category = $categoryRepository->find("id");
        $profiles->setCreatedAt(new \DateTime('now'));
       
  
          // Entity's validation
          // @link : https://symfony.com/doc/current/validation.html#using-the-validator-service
          $errors = $validator->validate($profiles);
  
          // Errors ?
          if (count($errors) > 0) {
              $errorsClean = [];
              // @Return validation's error 
              /** @var ConstraintViolation $error */
              foreach ($errors as $error) {
                  $errorsClean[$error->getPropertyPath()][] = $error->getMessage();
              };
  
              return $this->json($errorsClean, Response::HTTP_UNPROCESSABLE_ENTITY);
          }
          
          $profiles->setUser($user);
          // Associate category to profile
          $profiles->getCategories($category);
          
          // Save entity
          $entityManager = $doctrine->getManager();
          $entityManager->persist($profiles);
          $entityManager->flush();
  
          // On retourne la réponse adaptée (201 + Location: URL de la ressource)
          return $this->json(
              // // Serialize data
              $profiles,
              //status code : 201 CREATED
              Response::HTTP_CREATED,
              // REST ask for a header location + URL of the ressource
              [
                  //  Header response + URL
                  'Location' => $this->generateUrl('api_profiles_get_item', ['id' => $profiles->getId()])
              ],
            // needed groups for serialize
            ['groups' => 'create_profiles_item']
        );
    }

    /**
     *   Update profile
     * 
    * @Route("/api/secure/profiles/{id<\d+>}", name="api_profiles_put", methods={"PUT"})
    */
    public function updateItem($id, Profiles $profile, ProfilesRepository $profilesRepository, Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine): Response {

        // Getting $profile with ID on route.
         $serializer->deserialize($request->getContent(),
            Profiles::class,
            'json',
            //Object to populate : updated from the normalized data, instead of the denormalizer re-creating them
            [AbstractNormalizer::OBJECT_TO_POPULATE => $profile]
        );
        $profile = $profilesRepository->find($id);
        $profile->setUpdatedAt(new \DateTime());
        // Save with new data.
        $entityManager = $doctrine->getManager();
        $entityManager->flush();
        
        return $this->json(
            // Serialize data
            $profile,
            // status code
            JsonResponse::HTTP_OK,
            // Header response (None)
            [],
            // needed groups for serialize
            ['groups' => 'create_profiles_item']
        );
      }
    
    /** 
     * Delete profile
     * 
    * @Route("/api/secure/profiles/{id<\d+>}", name="api_profiles_delete", methods={"DELETE"})
    */
    public function deleteProfiles($id, ProfilesRepository $profiles, EntityManagerInterface $entityManager): Response
    {
       $existingProfiles = $profiles->find($id);
        $entityManager->remove($existingProfiles);
        $entityManager->flush();

        return $this->json($existingProfiles, Response::HTTP_OK, [], ['groups' => 'delete_profiles_item']);
        
    }
}
