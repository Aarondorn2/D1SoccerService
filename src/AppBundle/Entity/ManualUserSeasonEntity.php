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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ManualUserSeasonRepository")
 * @ORM\Table(name="manualUserSeasons")
 */
class ManualUserSeasonEntity
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $userName;
    /**
     * @ORM\Column(type="integer")
     */
    protected $seasonId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $paymentId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $teamId;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $hasPaid = null;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $hasWaiver = null;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $hasTeam = null;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isManual = true;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemLoadDate = null;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemUpdateDate = null;

    /**
     * UserSeasonEntity constructor.
     * @param $userName
     * @param $seasonId
     * @param $paymentId
     * @param $teamId
     * @param $hasPaid
     * @param $hasWaiver
     * @param $hasTeam
     */
    public function __construct(
        $userName,
        $seasonId,
        $paymentId,
        $teamId,
        $hasPaid = false,
        $hasWaiver = false,
        $hasTeam = false)
    {
        $this->userName = $userName;
        $this->seasonId = $seasonId;
        $this->paymentId = $paymentId;
        $this->teamId = $teamId;
        $this->hasPaid = $hasPaid;
        $this->hasWaiver = $hasWaiver;
        $this->hasTeam = $hasTeam;
        $this->systemLoadDate = date_create();
        $this->systemUpdateDate = date_create();
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
     * @return ManualUserSeasonEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }
    /**
     * @param mixed $userName
     * @return ManualUserSeasonEntity
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }
    /**
     * @param mixed $seasonId
     * @return ManualUserSeasonEntity
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }
    /**
     * @param mixed $paymentId
     * @return ManualUserSeasonEntity
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getTeamId()
    {
        return $this->teamId;
    }
    /**
     * @param mixed $teamId
     * @return ManualUserSeasonEntity
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getHasPaid()
    {
        return $this->hasPaid;
    }
    /**
     * @param mixed $hasPaid
     * @return ManualUserSeasonEntity
     */
    public function setHasPaid($hasPaid)
    {
        $this->hasPaid = $hasPaid;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getHasWaiver()
    {
        return $this->hasWaiver;
    }
    /**
     * @param mixed $hasWaiver
     * @return ManualUserSeasonEntity
     */
    public function setHasWaiver($hasWaiver)
    {
        $this->hasWaiver = $hasWaiver;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getHasTeam()
    {
        return $this->hasTeam;
    }
    /**
     * @param mixed $hasTeam
     * @return ManualUserSeasonEntity
     */
    public function setHasTeam($hasTeam)
    {
        $this->hasTeam = $hasTeam;
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
     * @return ManualUserSeasonEntity
     */
    public function setSystemLoadDate($systemLoadDate)
    {
        $this->systemLoadDate = $systemLoadDate;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getSystemUpdateDate()
    {
        return $this->systemUpdateDate;
    }
    /**
     * @param mixed $systemUpdateDate
     * @return ManualUserSeasonEntity
     */
    public function setSystemUpdateDate($systemUpdateDate)
    {
        $this->systemUpdateDate = $systemUpdateDate;
        return $this;
    }
}