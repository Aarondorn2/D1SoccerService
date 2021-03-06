<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/26/2018
 * Time: 7:50 PM
 */

namespace AppBundle\Model;


class JsonApiResponse
{

    function __construct($response, $type) {
        $this->data = new JsonApiItem($response, $type);
    }

    protected $data = null;

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * @param null $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

}