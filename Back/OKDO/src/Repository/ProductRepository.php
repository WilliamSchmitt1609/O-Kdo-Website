<?php

namespace App\Repository;


use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param array $categories
     * @param array $ages
     * @param array $genres
     * @param array $events
     * @return array
     */
    public function findProductByFilters(array $categories = [], array $ages = [], array $genres = [], array $events = []): array
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.status = 1')
            ->groupBy('p.id');

        if (!empty($categories)) {
            $query->innerJoin('p.categories', 'c')
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $categories);
        }

        if (!empty($ages)) {
            $query->innerJoin('p.ages', 'a')
                ->andWhere('a.id IN (:ages)')
                ->setParameter('ages', $ages);
        }

        if (!empty($genres)) {
            $query->innerJoin('p.genre', 'g')
                ->andWhere('g.id IN (:genres)')
                ->setParameter('genres', $genres);
        }

        if (!empty($events)) {
            $query->innerJoin('p.events', 'e')
                ->andWhere('e.id IN (:events)')
                ->setParameter('events', $events);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * Liste des products par ordre alpha
     * en DQL
     */
    public function findAllOrderedByTitleAscDql()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            ORDER BY p.name ASC'
        );


        // returns an array of Movie objects
        return $query->getResult();
    }

    //   MULTIPLE TESTS FOR ALGO SEARCH QB / DQL (not working)
      
    /* 
        $sql = 'SELECT `name`,`description`,`picture`,`shopping_link`
        FROM product p
        INNER JOIN age_product ap ON p.id = ap.product_id
        INNER JOIN event_product ep ON p.id = ep.product_id
        INNER JOIN product_category pc ON p.id = pc.product_id
        WHERE ap.age_id IN (1,2,3)
        AND ep.event_id IN (3,4)
        AND pc.category_id IN (3,4)
        AND p.genre_id IN (3)
        GROUP BY p.id'; */

  
}

   