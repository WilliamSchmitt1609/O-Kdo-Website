<?php

namespace App\Repository;

use App\Entity\Age;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Age|null find($id, $lockMode = null, $lockVersion = null)
 * @method Age|null findOneBy(array $criteria, array $orderBy = null)
 * @method Age[]    findAll()
 * @method Age[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Age::class);
    }
}
