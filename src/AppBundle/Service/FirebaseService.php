<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/27/2018
 * Time: 9:01 PM
 */

namespace AppBundle\Service;


use AppBundle\Entity\UserEntity;
use AppBundle\Model\UserType;

class FirebaseService
{
    private $userCache;

    public function __construct(UserCacheService $userCache)
    {
        $this->userCache = $userCache;
    }

    //returns empty if none
    public function getAuthorizedUser($token)
    {
        $cache = $this->userCache;

        $cachedUser = $cache->findCachedUser($token);
        if (is_null($cachedUser)) { //check cache first
            //attempt to add user
            $cachedUser = $cache->buildCachedUser($token);
        }

        return $cache->getUserEntity($cachedUser);
    }

    public function isAuthorized($user, $accessLevel)
    {
        $userType = $user->getUserType();
        $hierarchy = UserType::getHierarchy();

        if(!array_key_exists($accessLevel, $hierarchy) || !array_key_exists($userType, $hierarchy)) {
            return false;
        }

        return $hierarchy[$userType] >= $hierarchy[$accessLevel];
    }

    public function getAuthorizedEmail($token)
    {
        $cache = $this->userCache;

        $cachedUser = $cache->findCachedUser($token);
        if (is_null($cachedUser)) { //check cache first
            //attempt to add user
            $cachedUser = $cache->buildCachedUser($token);
        }

        return is_null($cachedUser) ? null : $cachedUser->getEmail();
    }

    public function updateCache($token, $user)
    {
        $this->userCache->updateCachedUser($token, $user);
    }
}