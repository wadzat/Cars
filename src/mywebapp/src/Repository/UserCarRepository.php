<?php

namespace App\Repository;

use App\Entity\UserCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserCar>
 *
 * @method UserCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCar[]    findAll()
 * @method UserCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCar::class);
    }
}
