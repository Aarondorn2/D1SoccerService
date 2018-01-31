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
use AppBundle\Service\FirebaseService2;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

//TODO season edit (admin)
class SeasonController extends FOSRestController
{


    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }


    /**
     * @Rest\Get("/seasons")
     */
    public function getSeasons()
    {
        $seasons = $this->getDoctrine()->getRepository('AppBundle:SeasonEntity')->findAll();


        return new JsonApiArrayResponse($seasons, 'seasons');
    }


}