<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 8:19 PM
 */

namespace AppBundle\Model;


class ResponseUserSeasonAdmin
{
    protected $id;
    protected $userName;
    protected $seasonId;
    protected $teamName;
    protected $hasPaid = null;
    protected $hasWaiver = null;
    protected $hasTeam = null;
    protected $systemLoadDate = null;
    protected $systemUpdateDate = null;


    public function __construct($userSeasonEntity = null, $teams = null)
    {
        if(!is_null($userSeasonEntity)) {
            $this->id = $userSeasonEntity->getId();
            if (!is_null($userSeasonEntity->getUser())) {
                $this->userName = $userSeasonEntity->getUser()->getFullName();
            }
            $this->seasonId = $userSeasonEntity->getSeasonId();
            if (!is_null($teams) && !is_null($userSeasonEntity->getTeamId())) {
                foreach($teams as $team) {
                    if($team->getId() == $userSeasonEntity->getTeamId()) {
                        $this->teamName = $team->getTeamName();
                    }
                }
            }
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
    public function getUserName()
    {
        return $this->userName;
    }
    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
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
    public function getTeamName()
    {
        return $this->teamName;
    }
    /**
     * @param mixed $teamName
     * @return mixed
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
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