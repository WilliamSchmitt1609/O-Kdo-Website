<?php

namespace App\Controller\Api;

use App\Normalizer;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ProfilesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApiUsersController extends AbstractController
{
    

    /**
     * Get users collection
     *
     * @Route("/api/secure/users", name="api_users_get", methods={"GET"})
     */
    public function getUsersCollection(UserRepository $userRepository): Response
    {
        // User's data
        $usersList = $userRepository->findAll();

        return $this->json(
            // serialized data
            $usersList,
            // status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_users_collection']
        );
    }

    /**
     * Get One user collection
     * 
     * @Route("/api/secure/users/{id<\d+>}", name="api_users_get_item", methods={"GET"})
     */
    public function getItem(User $user = null): Response
    {

        
        // 404 ?
        if ($user === null) {
            return $this->json(['error' => 'Utilisateur non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($user, Response::HTTP_OK, [], ['groups' => 'get_users_collection']);
    }

    /**
     * Get the profil of the user authenticated 
     * 
     * @Route("/api/secure/login_check", name="profil", methods={"GET"})
     */
    public function getLogin(): Response
    {
        $user = $this->getUser();

        return $this->json(
            // Data to serialized
            $user,
            // Status code
            200,
            // Headers
            [],
            // Groups used for the serializer
            ['groups' => 'get_login_collection']
        );
    }

    /**
     * Create one [role_user]user
     * 
    * @Route("/api/users", name="api_users_post", methods={"POST"})
     */
    public function createItem(Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator, UserPasswordHasherInterface $hasher)
    {
        // Récupérer contenu JSON
        $jsonContent = $request->getContent();
    
        try {
            // Deserialized JSON in Doctrine Entity User
            $user = $serializer->deserialize($jsonContent, User::class, 'json');
            // Set user to [role_user]
            $user->setRoles(['ROLE_USER']);
        } catch (NotEncodableValueException $e) {
            // if given JSON is missing or wrongly configured
            return $this->json(
                ['error' => 'JSON invalide'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }


        // Entity's validation
        // @link : https://symfony.com/doc/current/validation.html#using-the-validator-service
        $errors = $validator->validate($user);

        // Errors ?
        if (count($errors) > 0) {
            $errorsClean = [];
            // @Return validation's errors
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $errorsClean[$error->getPropertyPath()][] = $error->getMessage();
            };


            return $this->json($errorsClean, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
 
 
        // Here, we hashed our password getting by json.
        $hashedPassword = $hasher->hashPassword($user, $user->getPassword());
        // then we send it to our bdd.
        $user->setPassword($hashedPassword);
        // determine role user

        // creation date = now
        $user->setCreatedAt(new \DateTime('now'));

        
        // Save entity

        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Get adapted responsed
        return $this->json(
            //Data to serialized
            $user,

            // status code
            //en constante de classe
            Response::HTTP_CREATED,
            // REST demande un header Location + URL de la ressource
            [
                // header response + URL
                'Location' => $this->generateUrl('api_users_get_item', ['id' => $user->getId()])
            ],

            // Groups used for the serializer
            ['groups' => 'create_user_item']
        );
    }

    /**
     *   Update single user data
     * 
    * @Route("/api/secure/users/{id<\d+>}", name="api_users_put", methods={"PUT"})
    */
    public function updateItem($id, UserRepository $userRepository, Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator, UserPasswordHasherInterface $hasher, ProfilesRepository $profilesRepository): Response
    {
        
        $user = $userRepository->findOneBy(['id'=> $id]);
        $jsonContent = json_decode($request->getContent(), true);
      
        empty($jsonContent['firstname']) ? true : $user->setFirstname($jsonContent['firstname']);
        empty($jsonContent['lastname']) ? true : $user->setLastname($jsonContent['lastname']);
        empty($jsonContent['email']) ? true : $user->setEmail($jsonContent['email']);
        empty($jsonContent['password']) ? true : $user->setPassword($hasher->hashPassword($user, $jsonContent['password']));

        // Entity's validation
          // @link : https://symfony.com/doc/current/validation.html#using-the-validator-service
          $errors = $validator->validate($user);
        
        // Errors ?
        if (count($errors) > 0) {
            $errorsClean = [];
            // @Return validation's errors
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $errorsClean[$error->getPropertyPath()][] = $error->getMessage();
            };

            return $this->json($errorsClean, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //Set actual time
        $user->setUpdatedAt(new \DateTime('now'));
        //Set role user
        $user->setRoles(['ROLE_USER']);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, Response::HTTP_OK, [], ['groups' => 'get_users_collection']);


    }

    /**
    * Delete one user
    *  
    * @Route("/api/secure/users/{id<\d+>}", name="api_users_delete", methods={"DELETE"})
    */
    public function deleteUsers($id, UserRepository $user, EntityManagerInterface $entityManager): Response
    {
       $existingUser = $user->find($id);
        $entityManager->remove($existingUser);
        $entityManager->flush();

        return $this->json($existingUser, Response::HTTP_OK, [], ['groups' => 'reate_user_item']);
        
    }
}
