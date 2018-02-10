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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserSeasonRepository")
 * @ORM\Table(name="userSeasons")
 */
class UserSeasonEntity
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="seasons")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    /**
     * @ORM\OneToOne(targetEntity="WaiverEntity", inversedBy="userSeason")
     * @ORM\JoinColumn(name="waiver_id", referencedColumnName="id")
     */
    protected $waiver;
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
     * @ORM\Column(type="datetime")
     */
    protected $systemLoadDate = null;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemUpdateDate = null;

    /**
     * UserSeasonEntity constructor.
     * @param $id
     * @param $user
     * @param $waiver
     * @param $seasonId
     * @param $paymentId
     * @param $teamId
     * @param $hasPaid
     * @param $hasWaiver
     * @param $hasTeam
     */
    public function __construct(
        $user,
        $waiver,
        $seasonId,
        $paymentId,
        $teamId,
        $hasPaid = false,
        $hasWaiver = false,
        $hasTeam = false)
    {
        $this->user = $user;
        $this->waiver = $waiver;
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
     * @return UserSeasonEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @param mixed $user
     * @return UserSeasonEntity
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getWaiver()
    {
        return $this->waiver;
    }
    /**
     * @param mixed $waiver
     * @return UserSeasonEntity
     */
    public function setWaiver($waiver)
    {
        $this->waiver = $waiver;
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
     * @return UserSeasonEntity
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
     * @return UserSeasonEntity
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
     * @return UserSeasonEntity
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
     * @return UserSeasonEntity
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
     * @return UserSeasonEntity
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
     * @return UserSeasonEntity
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
     * @return UserSeasonEntity
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
     * @return UserSeasonEntity
     */
    public function setSystemUpdateDate($systemUpdateDate)
    {
        $this->systemUpdateDate = $systemUpdateDate;
        return $this;
    }
}