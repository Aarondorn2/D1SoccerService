<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ManualUserSeasonRepository extends EntityRepository {

    public function getTeamAndFreeAgents($teamId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:ManualUserSeasonEntity u WHERE u.teamId is null or u.teamId in(999, :teamId)'
            )->setParameter('teamId', $teamId)->getResult();
    }

}
