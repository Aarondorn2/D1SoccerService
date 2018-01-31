<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/29/2018
 * Time: 6:40 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SeasonRepository extends EntityRepository
{
    public function findCurrentSeason() {

        $results = $this->getEntityManager()
            ->createQuery(
                'SELECT s FROM AppBundle:SeasonEntity s WHERE CURRENT_DATE() BETWEEN s.registrationStartDate AND s.endDate order by s.startDate DESC '
            )
            ->setMaxResults(1)
            ->getResult();

        return count($results) > 0 ? $results[0] : null;
    }

}