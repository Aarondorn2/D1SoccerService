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
        foreach ($response as $model) {
            array_push($this->data, new JsonApiItem($model, $type));
        }
    }

    protected $data = array();

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