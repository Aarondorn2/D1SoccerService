<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 7:40 PM
 */

namespace AppBundle\Controller;

use AppBundle\Model\ResponseUserSeason;
use AppBundle\Entity\UserEntity;
use AppBundle\Entity\UserSeasonEntity;
use AppBundle\Model\JsonApiArrayResponse;
use AppBundle\Model\JsonApiResponse;
use AppBundle\Model\ResponseUserSeasonAdmin;
use AppBundle\Model\UserType;
use AppBundle\Service\FirebaseService;
use AppBundle\Utility\EmberDate;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

//TODO admin requests?
class UserSeasonController extends FOSRestController
{
    private $firebaseService;

    public function __construct(ContainerInterface $container, FirebaseService $firebaseService)
    {
        $this->setContainer($container);
        $this->firebaseService = $firebaseService;
    }


    /**
     * @Rest\Get("/user-seasons/{id}")
     */
    public function getUserSeason($id, Request $request)
    {
        //get user
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
        if (empty($authUser->getId())) {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }

        $userSeason = null;
        //loop through seasons adding to array
        foreach ($authUser->getSeasons() as $uSeason) {
            if ($uSeason->getId() == $id) {
                $userSeason = $uSeason;
            }
        }

        return new JsonApiResponse(new ResponseUserSeason($userSeason), 'userSeasons');
    }


    /**
     * @Rest\Get("/user-seasons")
     * @Rest\QueryParam(name="filter")
     */
    public function getUserSeasons(ParamFetcher $paramFetcher, Request $request)
    {
        $currentUserSeasons = Array();

        //get user
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
        if (empty($authUser->getId())) {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }
        if($paramFetcher->get('filter') == 'admin') {
            if($this->firebaseService->isAuthorized($authUser, UserType::$USER_TYPE_ADMIN)) {
                //TODO by season
                $userSeasons = $this->getDoctrine()->getRepository('AppBundle:UserSeasonEntity')->findBy(array('seasonId' => 2));
                $teams = $this->getDoctrine()->getRepository('AppBundle:TeamEntity')->findAll();
                foreach ($userSeasons as $uSeason) {
                    $currentUserSeasons[] = new ResponseUserSeasonAdmin($uSeason, $teams);
                }
            } else {
                return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
            }
        } else {
            //loop through seasons adding to array
            foreach ($authUser->getSeasons() as $uSeason) {
                $currentUserSeasons[] = new ResponseUserSeason($uSeason);
            }
        }

        return new JsonApiArrayResponse($currentUserSeasons, 'userSeasons');
    }

    /**
     * @Rest\Post("/user-seasons")
     */
    public function addUserSeason(Request $request)
    {
        //get user
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
        if (empty($authUser->getId())) {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }

        $requestArray = current($request->request->get('data'));
        $userSeason = new UserSeasonEntity(
            $authUser,
            null,
            $requestArray['seasonId'],
            null,
            null,
            false,
            false,
            false
        );

        $authUser->addSeason($userSeason);
        $em = $this->getDoctrine()->getManager();
        $em->persist($userSeason);
        $em->flush();

        return new JsonApiResponse(new ResponseUserSeason($userSeason), 'userSeason');
    }

    /**
     * @Rest\Patch("/user-seasons/{id}")
     */
    public function updateUserSeason($id, Request $request)
    {
        //get user
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
        if (empty($authUser->getId())) {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }

        $attributes = $request->request->get('data')['attributes'];
        //if admin, do admin things
        if($this->firebaseService->isAuthorized($authUser, UserType::$USER_TYPE_ADMIN)) {
            $team = $this->getDoctrine()->getRepository('AppBundle:TeamEntity')->findOneBy(array('teamName' => $attributes['teamName']));

            $userSeason = $this->getDoctrine()->getRepository('AppBundle:UserSeasonEntity')->find($id);
            $userSeason->setHasPaid($attributes['hasPaid']);
            $userSeason->setHasTeam($attributes['hasTeam']);
            $userSeason->setSystemLoadDate((new EmberDate($attributes['systemLoadDate']))->getPhpDate());
            $userSeason->setSystemUpdateDate(new \DateTime());
            if(!is_null($team)) {
                $userSeason->setTeamId($team->getId());
            }

        } else {
            $teamId = $attributes['teamId'];

            $userSeason = null;
            //loop through seasons looking for the right one
            foreach ($authUser->getSeasons() as $uSeason) {
                if ($uSeason->getId() == $id) {
                    $userSeason = $uSeason;
                }
            }
            $userSeason->setHasTeam(true);
            $userSeason->setTeamId($teamId);
        }
        $this->getDoctrine()->getManager()->flush();

        return new JsonApiResponse(new ResponseUserSeason($userSeason), 'userSeasons');
    }

}