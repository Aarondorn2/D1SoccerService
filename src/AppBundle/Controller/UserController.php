<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 7:40 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\UserEntity;
use AppBundle\Model\JsonApiResponse;
use AppBundle\Model\UserType;
use AppBundle\Service\FirebaseService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Service\FirebaseService2;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

//TODO if admin, allow look any email
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
    public function getUsers()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:UserEntity')->findAll();
        if ($users === null) {
            return new View("there are no users", Response::HTTP_NOT_FOUND);
        }
        return $users;
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
                $users[] = $authUser;
            } else { //TODO if admin, allow look any email

//                $users = $this->getDoctrine()->getRepository('AppBundle:UserEntity')->findBy(array('email' => $paramFetcher->get('equalTo')));
            }

        }

        if (empty($users)) {
            return new View("unable to find user", Response::HTTP_NOT_FOUND);
        }

        return new JsonApiResponse($users, 'users');
    }

    /**
     * @Rest\Get("/user/{id}")
     */
    public function getUserById($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:UserEntity')->find($id);
        if ($user === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $user;
    }


}