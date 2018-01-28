<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 1/27/2018
 * Time: 9:58 AM
 */

namespace AppBundle\Model;


class UserType
{
    public static $USER_TYPE_ADMIN = 'admin';
    public static $USER_TYPE_CAPTAIN = 'captain';
    public static $USER_TYPE_PLAYER = 'player';

    public static function getHierarchy() {
        return Array(
            UserType::$USER_TYPE_PLAYER => 0,
            UserType::$USER_TYPE_CAPTAIN => 1,
            UserType::$USER_TYPE_ADMIN => 2
        );
    }
}