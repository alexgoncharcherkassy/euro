<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{
    /**
     * @param $id
     * @return array
     */
    public function showGame($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT g FROM AppBundle:Game g
              WHERE g.team1Id = :id1
              OR g.team2Id = :id1
              ORDER BY g.dateGame DESC'
            )->setParameter('id1', $id)
            ->getResult();
    }

    /**
     * @return array
     */
    public function showAllGame()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT g FROM AppBundle:Game g
              ORDER BY g.dateGame DESC');
      //      )->getResult();
    }

    /**
     * @param $start
     * @param $limit
     * @return array
     */
    public function showAllGameAjax($start, $limit)
    {
        return $this->createQueryBuilder('g')
            ->select('g')
            ->orderBy('g.dateGame', 'DESC')
            ->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($limit)
            ->getResult();
    }
}
