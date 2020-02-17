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
        $userSeasons = Array();
        $manualUserSeasons = Array();
        $teams = Array();
        //get user
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
        if (empty($authUser->getId())) {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }
        if($this->firebaseService->isAuthorized($authUser, UserType::$USER_TYPE_ADMIN)) {
            $userSeasons = $this->getDoctrine()->getRepository('AppBundle:UserSeasonEntity')->findBy(array('seasonId' => 8));
            $manualUserSeasons = $this->getDoctrine()->getRepository('AppBundle:ManualUserSeasonEntity')->findBy(array('seasonId' => 8));
            $teamEnts = $this->getDoctrine()->getRepository('AppBundle:TeamEntity')->findAll();
            foreach ($teamEnts as $team) {
                $teams[$team->getId()] = $team->getTeamName();
            }
        } else if($this->firebaseService->isAuthorized($authUser, UserType::$USER_TYPE_CAPTAIN)) {
            //TODO by season
            $team = $this->getDoctrine()->getRepository('AppBundle:TeamEntity')->findOneBy(array('captainId' => $authUser->getId()));
            if(!is_null($team)) {
                $userSeasons = $this->getDoctrine()->getRepository('AppBundle:UserSeasonEntity')->getTeamAndFreeAgents($team->getId());
                $manualUserSeasons = $this->getDoctrine()->getRepository('AppBundle:ManualUserSeasonEntity')->getTeamAndFreeAgents($team->getId());
                $teams[$team->getId()] = $team->getTeamName();
                $teams[999] = "FREE AGENTS";
            }
        } else {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }

        foreach ($userSeasons as $uSeason) {
            $user = $uSeason->getUser();
            $teamId = empty($uSeason->getTeamId()) ? 999 : $uSeason->getTeamId();
            $rcr = new ResponseCaptainRoster(
                $uSeason->getId(),
                $user->getFullName(),
                $teamId,
                $uSeason->getTeamId() == 999 ? "FREE AGENT" : $teams[$teamId],
                $uSeason->getHasPaid(),
                $uSeason->getHasWaiver(),
                $uSeason->getHasTeam(),
                $user->getShirtSize(),
                $user->getGender(),
                $user->getisKeeper(),
                $user->getisOffense(),
                $user->getisDefense()
            );

            array_push($rosters, $rcr);
        }

        foreach ($manualUserSeasons as $uSeason) {
            $teamId = empty($uSeason->getTeamId()) ? 999 : $uSeason->getTeamId();
            $rcr = new ResponseCaptainRoster(
                "M".$uSeason->getId(),
                $uSeason->getUserName(),
                $teamId,
                $uSeason->getTeamId() == 999 ? "FREE AGENT" : $teams[$teamId],
                $uSeason->getHasPaid(),
                $uSeason->getHasWaiver(),
                $uSeason->getHasTeam(),
                null,
                null,
                false,
                false,
                false
            );
            array_push($rosters, $rcr);
        }
        return new JsonApiArrayResponse($rosters, 'captainRosters');
    }

}