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
 * @ORM\Table(name="contract")
 */
class ContractEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="WaiverEntity", mappedBy="contract")
     */
    protected $waivers;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $contractName;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $contractDisplayName;
    /**
     * @ORM\Column(type="text")
     */
    protected $contractText;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $contractValidStartDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $contractValidEndDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemLoadDate = "";



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
    public function getWaivers()
    {
        return $this->waivers;
    }
    /**
     * @param mixed $waivers
     */
    public function setWaivers($waivers)
    {
        $this->waivers = $waivers;
    }
    /**
     * @param mixed $waivers
     */
    public function addWaiver($waiver)
    {
        $waiver->setContract($this);
        $this->waivers[] = $waiver;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getContractName()
    {
        return $this->contractName;
    }
    /**
     * @param mixed $contractName
     */
    public function setContractName($contractName)
    {
        $this->contractName = $contractName;
    }
    /**
     * @return mixed
     */
    public function getContractDisplayName()
    {
        return $this->contractDisplayName;
    }
    /**
     * @param mixed $contractDisplayName
     */
    public function setContractDisplayName($contractDisplayName)
    {
        $this->contractDisplayName = $contractDisplayName;
    }
    /**
     * @return mixed
     */
    public function getContractText()
    {
        return $this->contractText;
    }
    /**
     * @param mixed $contractText
     */
    public function setContractText($contractText)
    {
        $this->contractText = $contractText;
    }
    /**
     * @return mixed
     */
    public function getContractValidStartDate()
    {
        return $this->contractValidStartDate;
    }
    /**
     * @param mixed $contractValidStartDate
     */
    public function setContractValidStartDate($contractValidStartDate)
    {
        $this->contractValidStartDate = $contractValidStartDate;
    }
    /**
     * @return mixed
     */
    public function getContractValidEndDate()
    {
        return $this->contractValidEndDate;
    }
    /**
     * @param mixed $contractValidEndDate
     */
    public function setContractValidEndDate($contractValidEndDate)
    {
        $this->contractValidEndDate = $contractValidEndDate;
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
}