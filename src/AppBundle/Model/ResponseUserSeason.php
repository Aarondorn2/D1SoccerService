<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 8:19 PM
 */

namespace AppBundle\Model;


class ResponseUserSeason
{
    protected $id;
    protected $userId;
    protected $waiverId;
    protected $seasonId;
    protected $paymentId;
    protected $teamId;
    protected $hasPaid = null;
    protected $hasWaiver = null;
    protected $hasTeam = null;
    protected $systemLoadDate = null;
    protected $systemUpdateDate = null;


    public function __construct($userSeasonEntity = null)
    {
        if(!is_null($userSeasonEntity)) {
            $this->id = $userSeasonEntity->getId();
            if (!is_null($userSeasonEntity->getUser())) {
                $this->userId = $userSeasonEntity->getUser()->getId();
            }
            if (!is_null($userSeasonEntity->getWaiver())) {
                $this->waiverId = $userSeasonEntity->getWaiver()->getId();
            }
            $this->seasonId = $userSeasonEntity->getSeasonId();
            $this->paymentId = $userSeasonEntity->getPaymentId();
            $this->teamId = $userSeasonEntity->getTeamId();
            $this->hasPaid = $userSeasonEntity->getHasPaid();
            $this->hasWaiver = $userSeasonEntity->getHasWaiver();
            $this->hasTeam = $userSeasonEntity->getHasTeam();
            $this->systemLoadDate = $userSeasonEntity->getSystemLoadDate();
            $this->systemUpdateDate = $userSeasonEntity->getSystemUpdateDate();
        }
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
     * @return mixed
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    /**
     * @return mixed
     */
    public function getWaiverId()
    {
        return $this->waiverId;
    }
    /**
     * @param mixed $waiverId
     * @return mixed
     */
    public function setWaiverId($waiverId)
    {
        $this->waiverId = $waiverId;
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
     */
    public function setSystemUpdateDate($systemUpdateDate)
    {
        $this->systemUpdateDate = $systemUpdateDate;
        return $this;
    }
}