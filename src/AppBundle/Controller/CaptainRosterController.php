<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 7:40 PM
 */

namespace AppBundle\Controller;

use AppBundle\Model\ResponseCaptainRoster;
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

class CaptainRosterController extends FOSRestController
{
    private $firebaseService;

    public function __construct(ContainerInterface $container, FirebaseService $firebaseService)
    {
        $this->setContainer($container);
        $this->firebaseService = $firebaseService;
    }

    /**
     * @Rest\Get("/captain-rosters")
     */
    public function getRoster(Request $request)
    {
        $rosters = Array();

        //get user
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
        if (empty($authUser->getId())) {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }

        if($this->firebaseService->isAuthorized($authUser, UserType::$USER_TYPE_CAPTAIN)) {
            //TODO by season
            $team = $this->getDoctrine()->getRepository('AppBundle:TeamEntity')->findOneBy(array('captainId' => $authUser->getId()));
            if(!is_null($team)) {
                $userSeasons = $this->getDoctrine()->getRepository('AppBundle:UserSeasonEntity')->getTeamAndFreeAgents($team->getId());

                foreach ($userSeasons as $uSeason) {
                    $user = $uSeason->getUser();
                    $rcr = new ResponseCaptainRoster(
                        $uSeason->getId(),
                        $user->getFullName(),
                        $team->getId(),
                        $team->getTeamName(),
                        $uSeason->getHasPaid(),
                        $uSeason->getHasWaiver(),
                        $uSeason->getHasTeam(),
                        $user->getShirtSize(),
                        $user->getGender(),
                        $user->getisKeeper(),
                        $user->getisOffense(),
                        $user->getisDefense()
                    );

                    if(is_null($uSeason->getTeamId()) || $uSeason->getTeamId() == 999) {
                        $rcr->setTeamId(999);
                        $rcr->setTeamName("FREE AGENT");
                    }
                    $rosters[] = $rcr;
                }
            }
        } else {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }

        return new JsonApiArrayResponse($rosters, 'captainRosters');
    }

}