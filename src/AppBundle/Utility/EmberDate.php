<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/28/2018
 * Time: 11:15 AM
 */

namespace AppBundle\Utility;


class EmberDate
{
    public function __construct($emberDateString)
    {
        $isoDate = str_replace('.000Z', '+00:00', $emberDateString);
        $this->phpDate = date_create_from_format(\DateTime::ISO8601, $isoDate);

        $this->tempDate = $isoDate;
    }

    private $phpDate;
    private $tempDate;


    /**
     * @return mixed
     */
    public function getPhpDate()
    {
        return $this->phpDate;
    }
    /**
     * @param mixed $phpDate
     * @return EmberDate
     */
    public function setPhpDate($phpDate)
    {
        $this->phpDate = $phpDate;
        return $this;
    }

    public function getTempDate()
    {
        return $this->tempDate;
    }

}