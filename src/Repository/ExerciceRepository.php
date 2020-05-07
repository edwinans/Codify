<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Exercice;
use App\Entity\ExerciceFiltre;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Exercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercice[]    findAll()
 * @method Exercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercice::class);
    }

    // /**
    //  * @return Exercice[] Returns an array of Exercice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exercice
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return Exerice[]
     */
    public function findLatest():array{
        return $this->createQueryBuilder('p')
                //->where('p.difficulte=3')
                ->setMaxResults(4)
                ->getQuery()
                ->getResult();

    }

    /**
     * @return Query
     */
    public function findAllQuery(ExerciceFiltre $search):Query{

        $query= $this->findVisibleQuery();
        if($search->getMaxDifficulte()){
            $query=$query
                    ->andwhere('e.difficulte <= :maxDifficulte')
                    ->setParameter('maxDifficulte',$search->getMaxDifficulte());
        }
        if($search->getMinDifficulte()){
            $query=$query
                    ->andwhere('e.difficulte >= :minDifficulte')
                    ->setParameter('minDifficulte',$search->getMinDifficulte());
        }
        return $query->getQuery();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */

    private function findVisibleQuery():QueryBuilder{
        return $this->createQueryBuilder('e')
                ->orderBy("e.difficulte", "DESC");

    }

}
