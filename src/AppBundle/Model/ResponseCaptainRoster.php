<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/24/2018
 * Time: 8:19 PM
 */

namespace AppBundle\Model;


class ResponseCaptainRoster
{
    protected $id;
    protected $playerName;
    protected $teamId;
    protected $teamName;
    protected $hasPaid;
    protected $hasWaiver;
    protected $hasTeam;
    protected $shirtSize;
    protected $gender;
    protected $isKeeper;
    protected $isOffense;
    protected $isDefense;

    /**
     * ResponseCaptainRoster constructor.
     * @param $id
     * @param $playerName
     * @param $teamId
     * @param $teamName
     * @param $hasPaid
     * @param $hasWaiver
     * @param $hasTeam
     * @param $shirtSize
     * @param $gender
     * @param $isKeeper
     * @param $isOffense
     * @param $isDefense
     */
    public function __construct(
        $id,
        $playerName,
        $teamId,
        $teamName,
        $hasPaid,
        $hasWaiver,
        $hasTeam,
        $shirtSize,
        $gender,
        $isKeeper,
        $isOffense,
        $isDefense)
    {
        $this->id = $id;
        $this->playerName = $playerName;
        $this->teamId = $teamId;
        $this->teamName = $teamName;
        $this->hasPaid = $hasPaid;
        $this->hasWaiver = $hasWaiver;
        $this->hasTeam = $hasTeam;
        $this->shirtSize = $shirtSize;
        $this->gender = $gender;
        $this->isKeeper = $isKeeper;
        $this->isOffense = $isOffense;
        $this->isDefense = $isDefense;
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
     * @return ResponseCaptainRoster
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }
    /**
     * @param mixed $playerName
     * @return ResponseCaptainRoster
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;
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
     * @return ResponseCaptainRoster
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
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
     * @return ResponseCaptainRoster
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
     * @return ResponseCaptainRoster
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
     * @return ResponseCaptainRoster
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
     * @return ResponseCaptainRoster
     */
    public function setHasTeam($hasTeam)
    {
        $this->hasTeam = $hasTeam;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getShirtSize()
    {
        return $this->shirtSize;
    }
    /**
     * @param mixed $shirtSize
     * @return ResponseCaptainRoster
     */
    public function setShirtSize($shirtSize)
    {
        $this->shirtSize = $shirtSize;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }
    /**
     * @param mixed $gender
     * @return ResponseCaptainRoster
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getisKeeper()
    {
        return $this->isKeeper;
    }
    /**
     * @param mixed $isKeeper
     * @return ResponseCaptainRoster
     */
    public function setIsKeeper($isKeeper)
    {
        $this->isKeeper = $isKeeper;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getisOffense()
    {
        return $this->isOffense;
    }
    /**
     * @param mixed $isOffense
     * @return ResponseCaptainRoster
     */
    public function setIsOffense($isOffense)
    {
        $this->isOffense = $isOffense;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getisDefense()
    {
        return $this->isDefense;
    }
    /**
     * @param mixed $isDefense
     * @return ResponseCaptainRoster
     */
    public function setIsDefense($isDefense)
    {
        $this->isDefense = $isDefense;
        return $this;
    }
}