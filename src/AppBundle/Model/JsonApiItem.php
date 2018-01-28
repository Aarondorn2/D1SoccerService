<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/26/2018
 * Time: 9:18 PM
 */

namespace AppBundle\Model;


class JsonApiItem
{
    function __construct($model, $type) {
        $this->setType($type);
        $this->setId((string)$model->getId());
        $this->setAttributes($model);
    }

    protected $type;
    protected $id;
    protected $attributes;


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
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
    public function getAttributes()
    {
        return $this->attributes;
    }
    /**
     * @param mixed $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

}