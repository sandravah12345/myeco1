<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }
//     public function findByIds(array $productIds)
//     {
//     return $this->createQueryBuilder('p')
//         ->where('p.id IN (:ids)')
//         ->setParameter('ids', $productIds)
//         ->getQuery()
//         ->getResult();
// }

// public function findByIds(array $productIds)
// {
//     if (empty($result)) {
//         // Redirect to a specific page when the result is empty
//         return $this->redirectToRoute('app_panier');
//     }

//     $result = $this->createQueryBuilder('p')
//         ->where('p.id IN (:ids)')
//         ->setParameter('ids', $productIds)
//         ->getQuery()
//         ->getResult();

//     // Check if the result is empty
    

//     // Return the result when it's not empty
//     return $result;
// }
//    /**
//     * @return Produit[] Returns an array of Produit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



}
