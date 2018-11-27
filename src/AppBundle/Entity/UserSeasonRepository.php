<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserSeasonRepository extends EntityRepository {

    public function getTeamAndFreeAgents($teamId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:UserSeasonEntity u WHERE (u.teamId is null or u.teamId in(999, :teamId)) and u.seasonId = 4'
            )->setParameter('teamId', $teamId)->getResult();
    }

}
