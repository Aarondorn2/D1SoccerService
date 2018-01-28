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
     * @param $user
     */
    public function __construct($token, $uid, $user)
    {
        $this->token = $token;
        $this->uid = $uid;
        $this->user = $user;
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
     * @ORM\Column(type="text")
     */
    protected $token;
    /**
     * @ORM\Column(type="string", length=55)
     */
    protected $uid;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $cacheTime = "";

    /**
     * @ORM\ManyToOne(targetEntity="UserEntity")
     * @ORM\JoinColumn(name="cachedUser_id", referencedColumnName="id")
     */
    protected $user;



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
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}
