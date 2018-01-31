<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 8:19 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="waiver")
 */
class WaiverEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToOne(targetEntity="UserSeasonEntity", mappedBy="waiver")
     */
    protected $userSeason;
    /**
     * @ORM\ManyToOne(targetEntity="ContractEntity", inversedBy="waivers")
     * @ORM\JoinColumn(name="contract_id", referencedColumnName="id")
     */
    protected $contract;
    /**
     * @ORM\Column(type="string", length=510)
     */
    protected $acceptedName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $acceptedEmail;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $acceptedIPAddress;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $hasAccepted;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $acceptedDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemLoadDate = "";

    /**
     * WaiverEntity constructor.
     * @param $userSeason
     * @param $contract
     * @param $acceptedName
     * @param $acceptedEmail
     * @param $acceptedIPAddress
     * @param $hasAccepted
     */
    public function __construct(
        $userSeason,
        $contract,
        $acceptedName,
        $acceptedEmail,
        $acceptedIPAddress,
        $hasAccepted)
    {
        $this->userSeason = $userSeason;
        $this->contract = $contract;
        $this->acceptedName = $acceptedName;
        $this->acceptedEmail = $acceptedEmail;
        $this->acceptedIPAddress = $acceptedIPAddress;
        $this->hasAccepted = $hasAccepted;
        $this->acceptedDate = date_create();
        $this->systemLoadDate = date_create();
    }



    //GETTERS AND SETTERS
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     * @return WaiverEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getUserSeason()
    {
        return $this->userSeason;
    }
    /**
     * @param mixed $userSeason
     * @return WaiverEntity
     */
    public function setUserSeason($userSeason)
    {
        $this->userSeason = $userSeason;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getContract()
    {
        return $this->contract;
    }
    /**
     * @param mixed $contract
     * @return WaiverEntity
     */
    public function setContract($contract)
    {
        $this->contract = $contract;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAcceptedName()
    {
        return $this->acceptedName;
    }
    /**
     * @param mixed $acceptedName
     * @return WaiverEntity
     */
    public function setAcceptedName($acceptedName)
    {
        $this->acceptedName = $acceptedName;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAcceptedEmail()
    {
        return $this->acceptedEmail;
    }
    /**
     * @param mixed $acceptedEmail
     * @return WaiverEntity
     */
    public function setAcceptedEmail($acceptedEmail)
    {
        $this->acceptedEmail = $acceptedEmail;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAcceptedIPAddress()
    {
        return $this->acceptedIPAddress;
    }
    /**
     * @param mixed $acceptedIPAddress
     * @return WaiverEntity
     */
    public function setAcceptedIPAddress($acceptedIPAddress)
    {
        $this->acceptedIPAddress = $acceptedIPAddress;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getHasAccepted()
    {
        return $this->hasAccepted;
    }
    /**
     * @param mixed $hasAccepted
     * @return WaiverEntity
     */
    public function setHasAccepted($hasAccepted)
    {
        $this->hasAccepted = $hasAccepted;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAcceptedDate()
    {
        return $this->acceptedDate;
    }
    /**
     * @param mixed $acceptedDate
     * @return WaiverEntity
     */
    public function setAcceptedDate($acceptedDate)
    {
        $this->acceptedDate = $acceptedDate;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getSystemLoadDate()
    {
        return $this->systemLoadDate;
    }
    /**
     * @param mixed $systemLoadDate
     * @return WaiverEntity
     */
    public function setSystemLoadDate($systemLoadDate)
    {
        $this->systemLoadDate = $systemLoadDate;
        return $this;
    }
}