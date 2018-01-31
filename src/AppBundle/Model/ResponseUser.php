<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/29/2018
 * Time: 8:54 PM
 */

namespace AppBundle\Model;


class ResponseUser
{

    protected $id;
    protected $firstName;
    protected $lastName;
    protected $dob = "";
    protected $shirtSize = "";
    protected $gender = "";
    protected $isKeeper = false;
    protected $isOffense = false;
    protected $isDefense = false;
    protected $phone;
    protected $emergencyContact;
    protected $emergencyContactPhone;
    protected $userType;
    protected $email = null;
    protected $systemLoadDate = "";
    protected $systemUpdateDate = "";

    public function __construct($userEntity)
    {
        $this->id = $userEntity->getId();
        $this->firstName = $userEntity->getFirstName();
        $this->lastName = $userEntity->getLastName();
        $this->dob = $userEntity->getDob();
        $this->shirtSize = $userEntity->getShirtSize();
        $this->gender = $userEntity->getGender();
        $this->isKeeper = $userEntity->getisKeeper();
        $this->isOffense = $userEntity->getisOffense();
        $this->isDefense = $userEntity->getisDefense();
        $this->phone = $userEntity->getPhone();
        $this->emergencyContact = $userEntity->getEmergencyContact();
        $this->emergencyContactPhone = $userEntity->getEmergencyContactPhone();
        $this->userType = $userEntity->getUserType();
        $this->email = $userEntity->getEmail();
        $this->systemLoadDate = $userEntity->getSystemLoadDate();
        $this->systemUpdateDate = $userEntity->getSystemUpdateDate();
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
     * @return ResponseUser
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * @param mixed $firstName
     * @return ResponseUser
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * @param mixed $lastName
     * @return ResponseUser
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    /**
     * @return string
     */
    public function getDob()
    {
        return $this->dob;
    }
    /**
     * @param string $dob
     * @return ResponseUser
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }
    /**
     * @return string
     */
    public function getShirtSize()
    {
        return $this->shirtSize;
    }
    /**
     * @param string $shirtSize
     * @return ResponseUser
     */
    public function setShirtSize($shirtSize)
    {
        $this->shirtSize = $shirtSize;
        return $this;
    }
    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
    /**
     * @param string $gender
     * @return ResponseUser
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }
    /**
     * @return bool
     */
    public function isKeeper()
    {
        return $this->isKeeper;
    }
    /**
     * @param bool $isKeeper
     * @return ResponseUser
     */
    public function setIsKeeper($isKeeper)
    {
        $this->isKeeper = $isKeeper;
        return $this;
    }
    /**
     * @return bool
     */
    public function isOffense()
    {
        return $this->isOffense;
    }
    /**
     * @param bool $isOffense
     * @return ResponseUser
     */
    public function setIsOffense($isOffense)
    {
        $this->isOffense = $isOffense;
        return $this;
    }
    /**
     * @return bool
     */
    public function isDefense()
    {
        return $this->isDefense;
    }
    /**
     * @param bool $isDefense
     * @return ResponseUser
     */
    public function setIsDefense($isDefense)
    {
        $this->isDefense = $isDefense;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
     * @param mixed $phone
     * @return ResponseUser
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEmergencyContact()
    {
        return $this->emergencyContact;
    }
    /**
     * @param mixed $emergencyContact
     * @return ResponseUser
     */
    public function setEmergencyContact($emergencyContact)
    {
        $this->emergencyContact = $emergencyContact;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEmergencyContactPhone()
    {
        return $this->emergencyContactPhone;
    }
    /**
     * @param mixed $emergencyContactPhone
     * @return ResponseUser
     */
    public function setEmergencyContactPhone($emergencyContactPhone)
    {
        $this->emergencyContactPhone = $emergencyContactPhone;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->userType;
    }
    /**
     * @param mixed $userType
     * @return ResponseUser
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
        return $this;
    }
    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param null $email
     * @return ResponseUser
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return string
     */
    public function getSystemLoadDate()
    {
        return $this->systemLoadDate;
    }
    /**
     * @param string $systemLoadDate
     * @return ResponseUser
     */
    public function setSystemLoadDate($systemLoadDate)
    {
        $this->systemLoadDate = $systemLoadDate;
        return $this;
    }
    /**
     * @return string
     */
    public function getSystemUpdateDate()
    {
        return $this->systemUpdateDate;
    }
    /**
     * @param string $systemUpdateDate
     * @return ResponseUser
     */
    public function setSystemUpdateDate($systemUpdateDate)
    {
        $this->systemUpdateDate = $systemUpdateDate;
        return $this;
    }
}