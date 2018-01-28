<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/27/2018
 * Time: 9:01 PM
 */

namespace AppBundle\Service;


class FirebaseService
{
    private $userCache;

    public function __construct(UserCacheService $userCache)
    {
        $this->userCache = $userCache;
    }


    public function getAuthorizedUser($token) {
        $cache = $this->userCache;

        $cachedUser = $cache->findUser($token);
        if (is_null($cachedUser)) { //check cache first
            //attempt to add user
            $cachedUser = $cache->addUser($token);
        }

        return $cachedUser->getUser();
    }

    public function isAuthorized($token, $accessLevel, $doctrine)
    {

    }

}