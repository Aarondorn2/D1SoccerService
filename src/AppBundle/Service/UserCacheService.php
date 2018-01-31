<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/27/2018
 * Time: 5:24 PM
 */

namespace AppBundle\Service;

use AppBundle\Entity\CachedUserEntity;
use AppBundle\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Kreait\Firebase\Exception\Auth\InvalidIdToken;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;

//TODO purge older than 30min
class UserCacheService
{

    private $entityManager;
    private $firebaseKey;

    public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->firebaseKey = $container->getParameter('firebase_key');
    }


    public function findCachedUser($token)
    {
        $cachedUsers = $this->entityManager->getRepository('AppBundle:CachedUserEntity')->findBy(array('token' => hash('sha256', $token)));
        $cachedUser = null;
        foreach($cachedUsers as $user) {
            $cachedUser = $user;
        }

        return $cachedUser;
    }

    public function buildCachedUser($token)
    {
        try {
            //load auth and build firebase
            $finder = new Finder();
            $jsonFilePath = null;

            foreach ($finder->files()->in(__DIR__)->name($this->firebaseKey) as $file) {
                $jsonFilePath = $file->getRealPath();
            }

            $serviceAccount = ServiceAccount::fromValue(file_get_contents($jsonFilePath));

            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();

            //check token
            $auth = $firebase->getAuth();

            $verifiedUid = $auth->verifyIdToken($token)->getClaim('sub'); //throws if invalid token, else gives userId related to token
            $verifiedUser = $auth->getUserInfo($verifiedUid);

            $email = $verifiedUser['providerUserInfo'][0]['email'];

            $userEntity = null;
            $users = $this->entityManager->getRepository('AppBundle:UserEntity')->findBy(array('email' => $email));
            foreach ($users as $user) {
                $userEntity = $user;
            }
            //user may be empty
            $userId = is_null($userEntity) ? null : $userEntity->getId();

            //buildCachedUserEntity and persist
            $cachedUser = new CachedUserEntity(hash('sha256', $token), $verifiedUid, $email, $userId);
            $this->entityManager->persist($cachedUser);
            $this->entityManager->flush();

            return $cachedUser;

        } catch (InvalidIdToken $e) {
            return null;
        }

    }

    public function updateCachedUser($token, $user) {
        $cachedUsers = $this->entityManager->getRepository('AppBundle:CachedUserEntity')->findBy(array('token' => hash('sha256', $token)));
        $cachedUser = null;
        foreach($cachedUsers as $x) {
            $cachedUser = $x;
        }

        if (!is_null($cachedUser)) {
            $cachedUser->setUserId($user->getId());
            $this->entityManager->persist($cachedUser);
            $this->entityManager->flush();
        }
    }

    public function getUserEntity($cachedUser) {
        $user = null;

        if (!is_null($cachedUser) && !is_null($cachedUser->getUserId())) {
            $user = $this->entityManager->getRepository('AppBundle:UserEntity')->find($cachedUser->getUserId());
        }

        return is_null($user) ? new UserEntity() : $user;
    }

}