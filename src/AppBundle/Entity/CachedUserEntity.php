<?php
namespace AppBundle\Entity;

use AppBundle\Entity\UserEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="cachedUsers",indexes={@ORM\Index(name="indx_token", columns={"token"})})
 */
class CachedUserEntity
{

    /**
     * CachedUserEntity constructor.
     * @param $token
     * @param $uid
     * @param $email
     * @param $userId
     */
    public function __construct($token = null, $uid = null, $email = null, $userId = null)
    {
        $this->token = $token;
        $this->uid = $uid;
        $this->email = $email;
        $this->userId = $userId;
        $this->cacheTime = date_create();
    }


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
    protected $token;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $uid;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $cacheTime = "";

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $userId;



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
    public function getToken()
    {
        return $this->token;
    }
    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }
    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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
     * @return CachedUserEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getCacheTime()
    {
        return $this->cacheTime;
    }
    /**
     * @param mixed $cacheTime
     */
    public function setCacheTime($cacheTime)
    {
        $this->cacheTime = $cacheTime;
    }
    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @param mixed
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
