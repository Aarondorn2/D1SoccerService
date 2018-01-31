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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SeasonRepository")
 * @ORM\Table(name="season")
 */
class SeasonEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $startDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $endDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $registrationStartDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $registrationEndDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemLoadDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemUpdateDate = "";



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
     * @return SeasonEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     * @return SeasonEntity
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }
    /**
     * @param mixed $startDate
     * @return SeasonEntity
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    /**
     * @param mixed $endDate
     * @return SeasonEntity
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getRegistrationStartDate()
    {
        return $this->registrationStartDate;
    }
    /**
     * @param mixed $registrationStartDate
     * @return SeasonEntity
     */
    public function setRegistrationStartDate($registrationStartDate)
    {
        $this->registrationStartDate = $registrationStartDate;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getRegistrationEndDate()
    {
        return $this->registrationEndDate;
    }
    /**
     * @param mixed $registrationEndDate
     * @return SeasonEntity
     */
    public function setRegistrationEndDate($registrationEndDate)
    {
        $this->registrationEndDate = $registrationEndDate;
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
     * @return SeasonEntity
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
     * @return SeasonEntity
     */
    public function setSystemUpdateDate($systemUpdateDate)
    {
        $this->systemUpdateDate = $systemUpdateDate;
        return $this;
    }
}