<?php

namespace App\Repository\Ressource;

use App\Entity\Ressource\Ressource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ressource>
 *
 * @method Ressource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ressource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ressource[]    findAll()
 * @method Ressource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RessourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ressource::class);
    }

    /**
     * Get published ressources
     * @return Ressource[] Returns an array of Ressource objects
     */
    public function findPublished(int $page): array
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->where('r.state = :state')
            ->setParameter('state', Ressource::STATES[1])
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();;

        $ressources = $this->paginatorInterface->paginate(
            $queryBuilder,
            $page,
            10
        );

        return $ressources;
    }
}
