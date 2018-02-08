<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 7:40 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\UserEntity;
use AppBundle\Model\JsonApiArrayResponse;
use AppBundle\Model\JsonApiResponse;
use AppBundle\Model\ResponseUser;
use AppBundle\Model\UserType;
use AppBundle\Service\FirebaseService;
use AppBundle\Utility\EmberDate;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Service\FirebaseService2;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

//TODO admin requests?
class UserController extends FOSRestController
{
    private $firebaseService;

    public function __construct(ContainerInterface $container, FirebaseService $firebaseService)
    {
        $this->setContainer($container);
        $this->firebaseService = $firebaseService;
    }

    /**
     * @Rest\Get("/user")
     */
    public function getUsers(Request $request)
    {
        if(!$this->firebaseService->isAuthorized($request->headers->get('x-token'), UserType::$USER_TYPE_ADMIN)) {
            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
        }

        $users = $this->getDoctrine()->getRepository('AppBundle:UserEntity')->findAll();
        if ($users === null) {
            return new View("there are no users", Response::HTTP_NOT_FOUND);
        }
        return new JsonApiArrayResponse($users, 'users');
    }


    /**
     * @Rest\Get("/users")
     * @Rest\QueryParam(name="equalTo")
     * @Rest\QueryParam(name="orderBy")
     */
    public function getUsersByQuery(ParamFetcher $paramFetcher, Request $request)
    {
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
        
        $users = Array();

        if ($paramFetcher->get('orderBy') === "email") {
            if ($authUser->getEmail() == $paramFetcher->get('equalTo')) {
                $users[] = new ResponseUser($authUser);
            }
        } else if($this->firebaseService->isAuthorized($authUser, UserType::$USER_TYPE_ADMIN)) {
            $userEntities = $this->getDoctrine()->getRepository('AppBundle:UserEntity')->findAll();
            foreach ($userEntities as $userEntity) {
                $users[] = new ResponseUser($userEntity);
            }
        }

        return new JsonApiArrayResponse($users, 'users');
    }

    /**
     * @Rest\Get("/user/{id}")
     */
    public function getUserById($id, Request $request)
    {
        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));

        $user = null;

        if ($authUser->getId() == $id) {
            $user = $authUser;
        } else { //TODO if admin, allow look any id
        }

        if (is_null($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonApiResponse($user, 'user');;
    }


    /**
     * @Rest\Post("/users")
     */
    public function addUser(Request $request)
    {
        $token = $request->headers->get('x-token');
        $authEmail = $this->firebaseService->getAuthorizedEmail($token);

        if(is_null($authEmail)) {
            return new View("user not registered with firebase", Response::HTTP_NOT_FOUND);
        }

        //TODO handle admin requests?
        //TODO validate!
        //TODO make user email unique in DB

        $requestArray = current($request->request->get('data'));
        $user = new UserEntity(
            $requestArray['firstName'],
            $requestArray['lastName'],
            (new EmberDate($requestArray['dob']))->getPhpDate(),
            $requestArray['shirtSize'],
            $requestArray['gender'],
            $requestArray['isKeeper'],
            $requestArray['isOffense'],
            $requestArray['isDefense'],
            $requestArray['phone'],
            $requestArray['emergencyContact'],
            $requestArray['emergencyContactPhone'],
            'player', //can ONLY add as player
            $authEmail //only use authorized email from firebase
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->firebaseService->updateCache($token, $user);

        return new JsonApiResponse($user, 'user');
    }

//    /**
//     * @Rest\Patch("/users/{id}")
//     */
//    public function updateUser($id, Request $request)
//    {
//        //get user
//        $authUser = $this->firebaseService->getAuthorizedUser($request->headers->get('x-token'));
//        if (empty($authUser->getId())) {
//            return new View("Access Denied for this user", Response::HTTP_FORBIDDEN);
//        }
//
//        $attributes = $request->request->get('data')['attributes'];
//        //if admin, do admin things
//        if($this->firebaseService->isAuthorized($authUser, UserType::$USER_TYPE_ADMIN)) {
//            $team = $this->getDoctrine()->getRepository('AppBundle:TeamEntity')->findOneBy(array('teamName' => $attributes['teamName']));
//
//            $userSeason = $this->getDoctrine()->getRepository('AppBundle:UserSeasonEntity')->find($id);
//            $userSeason->setHasPaid($attributes['hasPaid']);
//            $userSeason->setHasTeam($attributes['hasTeam']);
//            $userSeason->setSystemLoadDate((new EmberDate($attributes['systemLoadDate']))->getPhpDate());
//            $userSeason->setSystemUpdateDate(new \DateTime());
//            if(!is_null($team)) {
//                $userSeason->setTeamId($team->getId());
//            }
//
//        } else {
//            $teamId = $attributes['teamId'];
//
//            $userSeason = null;
//            //loop through seasons looking for the right one
//            foreach ($authUser->getSeasons() as $uSeason) {
//                if ($uSeason->getId() == $id) {
//                    $userSeason = $uSeason;
//                }
//            }
//            $userSeason->setHasTeam(true);
//            $userSeason->setTeamId($teamId);
//        }
//        $this->getDoctrine()->getManager()->flush();
//
//        return new JsonApiResponse(new ResponseUserSeason($userSeason), 'userSeasons');
//    }
}