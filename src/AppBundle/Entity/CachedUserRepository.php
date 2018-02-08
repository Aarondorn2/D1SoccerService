<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CachedUserRepository extends EntityRepository {

    public function deleteAllOlderThanMinutes($minutes)
    {
        return $this->getEntityManager()
            ->createQuery(
                'DELETE FROM AppBundle:CachedUserEntity c WHERE c.cacheTime < :expireTime'
            )->setParameter('expireTime', new \DateTime('-'. $minutes .' minutes'))->execute();
    }

    public function findAndUpdate($token) {
        $this->getEntityManager()
            ->createQuery(
                'UPDATE AppBundle:CachedUserEntity c SET c.cacheTime = :datetime WHERE c.token = :token')
            ->setParameter('datetime', new \DateTime())
            ->setParameter('token', $token)
            ->execute();
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:CachedUserEntity c WHERE c.token = :token')
            ->setParameter('token', $token)->getResult();
    }
}
