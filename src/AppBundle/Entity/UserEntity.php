<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use AppBundle\Entity\UserSeasonEntity;
use AppBundle\Entity\UserPrefecEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="users",indexes={@ORM\Index(name="indx_email", columns={"email"})})
 * @UniqueEntity("email", message="This email has already been registered.")
 */
class UserEntity implements AdvancedUserInterface, \Serializable
{

    //FIELDS
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $firstName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $dob = "";
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $shirtSize = "";
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $gender = "";
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isKeeper = false;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isOffense = false;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isDefense = false;
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $phone;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $emergencyContact;
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $emergencyContactPhone;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $userType;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email = null;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemLoadDate = "";
    /**
     * @ORM\Column(type="datetime")
     */
    protected $systemUpdateDate = "";

    /**
     * @ORM\OneToMany(targetEntity="UserSeasonEntity", mappedBy="user")
     */
    protected $seasons;


    /**
     * UserEntity constructor.
     * @param $firstName
     * @param $lastName
     * @param string $dob
     * @param string $shirtSize
     * @param string $gender
     * @param bool $isKeeper
     * @param bool $isOffense
     * @param bool $isDefense
     * @param $phone
     * @param $emergencyContact
     * @param $emergencyContactPhone
     * @param $userType
     * @param null $email
     */
    public function __construct(
        $firstName = '',
        $lastName = '',
        $dob = '',
        $shirtSize = '',
        $gender = '',
        $isKeeper = false,
        $isOffense = false,
        $isDefense = false,
        $phone = '',
        $emergencyContact = '',
        $emergencyContactPhone = '',
        $userType = '',
        $email = '')
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->shirtSize = $shirtSize;
        $this->gender = $gender;
        $this->isKeeper = $isKeeper;
        $this->isOffense = $isOffense;
        $this->isDefense = $isDefense;
        $this->phone = $phone;
        $this->emergencyContact = $emergencyContact;
        $this->emergencyContactPhone = $emergencyContactPhone;
        $this->userType = $userType;
        $this->email = $email;
        $this->systemLoadDate = date_create();
        $this->systemUpdateDate = date_create();
    }



    //CUSTOM GETTERS/SETTERS
    public function getFullName()
    {
        return $this->firstName . " " . $this->lastName;
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }
    /**
     * @param mixed $dob
     * @return UserEntity
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
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
     * @return UserEntity
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     * @return UserEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return UserEntity
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
     * @return UserEntity
     */
    public function setSystemUpdateDate($systemUpdateDate)
    {
        $this->systemUpdateDate = $systemUpdateDate;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getSeasons()
    {
        return $this->seasons;
    }
    /**
     * @param mixed $seasons
     * @return UserEntity
     */
    public function setSeasons($seasons)
    {
        $this->seasons = $seasons;
        return $this;
    }
    public function addSeason(UserSeasonEntity $userSeason)
    {
        $userSeason->setUser($this);
        $this->seasons[] = $userSeason;

        return $this;
    }



    //USED BY SYMFONY
    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return array($this->userType);
    }
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email
            // see section on salt below
            // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
    public function getPassword()
    {
        return null;
    }
    public function isAccountNonExpired()
    {
        return true;
    }
    public function isAccountNonLocked()
    {
        return true;
    }
    public function isCredentialsNonExpired()
    {
        return true;
    }
    public function isEnabled()
    {
        return true;
    }
    public function eraseCredentials()
    {
    }
    public function getUsername()
    {
        return $this->email;
    }
}
