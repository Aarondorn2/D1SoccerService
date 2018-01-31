<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/30/2018
 * Time: 7:49 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\UserEntity;
use AppBundle\Entity\WaiverEntity;
use AppBundle\Model\JsonApiResponse;
use AppBundle\Service\FirebaseService;
use AppBundle\Utility\EmberDate;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Service\FirebaseService2;

//TODO dynamic contract selection
class WaiverController extends FOSRestController
{
    private $firebaseService;

    public function __construct(ContainerInterface $container, FirebaseService $firebaseService)
    {
        $this->setContainer($container);
        $this->firebaseService = $firebaseService;
    }


    /**
     * @Rest\Post("/waivers")
     */
    public function addWaiver(Request $request)
    {

        $token = $request->headers->get('x-token');
        $authUser = $this->firebaseService->getAuthorizedUser($token);

        if(is_null($authUser)) {
            return new View("user not registered with firebase", Response::HTTP_NOT_FOUND);
        }

        //get IP
        $ip = $this->container->get('request_stack')->getMasterRequest()->getClientIp();
        if(empty($ip)) {
            $ip = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();
            if(empty($ip)) {
                $ip = $request->getClientIp();
            }
        }

        //get contract
        //TODO dynamic
        $contract = $this->getDoctrine()->getRepository('AppBundle:ContractEntity')->find(1);

        //get user season
        $userSeason = null;
        $uSeasonId = current($request->request->get('data'))['userSeasonId'];
        foreach($authUser->getSeasons() as $uSeason) {
            if ($uSeason->getId() == $uSeasonId) {
                $userSeason = $uSeason;
            }
        }

        $waiver = new WaiverEntity(
            $userSeason, //set user season
            $contract, //contract
            $authUser->getFullName(),
            $authUser->getEmail(),
            $ip, //IP
            true
        );

        $contract->addWaiver($waiver);
        $userSeason->setWaiver($waiver);
        $userSeason->setHasWaiver(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($waiver);
        $em->flush();

        return new JsonApiResponse($waiver, 'waiver');
    }

}