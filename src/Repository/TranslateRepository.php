<?php

namespace App\Repository;

use App\Entity\Translate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Translate>
 *
 * @method Translate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Translate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Translate[]    findAll()
 * @method Translate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TranslateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Translate::class);
    }
}
