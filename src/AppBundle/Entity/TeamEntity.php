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
 * @ORM\Table(name="team")
 */
class TeamEntity
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $captainId;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $captainFirstName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $captainLastName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $teamName;
    /**
     * @ORM\Column(type="string", length=55)
     */
    protected $teamColor;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemLoadDate = null;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemUpdateDate = null;

    /**
     * TeamEntity constructor.
     * @param $captainFirstName
     * @param $captainLastName
     * @param $teamName
     * @param $teamColor
     */
    public function __construct($captainFirstName, $captainLastName, $teamName, $teamColor)
    {
        $this->captainFirstName = $captainFirstName;
        $this->captainLastName = $captainLastName;
        $this->teamName = $teamName;
        $this->teamColor = $teamColor;
        $this->systemLoadDate = date_create();
        $this->systemUpdateDate = date_create();
    }



    //CUSTOM GETTERS/SETTERS
    public function getCaptainFullName()
    {
        return $this->captainFirstName . " " . $this->captainLastName;
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getCaptainId()
    {
        return $this->captainId;
    }
    /**
     * @param mixed $captainId
     */
    public function setCaptainId($captainId)
    {
        $this->captainId = $captainId;
    }
    /**
     * @return mixed
     */
    public function getCaptainFirstName()
    {
        return $this->captainFirstName;
    }
    /**
     * @param mixed $captainFirstName
     */
    public function setCaptainFirstName($captainFirstName)
    {
        $this->captainFirstName = $captainFirstName;
    }
    /**
     * @return mixed
     */
    public function getCaptainLastName()
    {
        return $this->captainLastName;
    }
    /**
     * @param mixed $captainLastName
     */
    public function setCaptainLastName($captainLastName)
    {
        $this->captainLastName = $captainLastName;
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
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
    }
    /**
     * @return mixed
     */
    public function getTeamColor()
    {
        return $this->teamColor;
    }
    /**
     * @param mixed $teamColor
     */
    public function setTeamColor($teamColor)
    {
        $this->teamColor = $teamColor;
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
     */
    public function setSystemLoadDate($systemLoadDate)
    {
        $this->systemLoadDate = $systemLoadDate;
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
     */
    public function setSystemUpdateDate($systemUpdateDate)
    {
        $this->systemUpdateDate = $systemUpdateDate;
    }
}