<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-17
 * Time: 11:50
 */

namespace models;


class PossibleDate
{
    public $day;
    public $movieTime;
    public $movieName;


    public function __construct($day, $movieTime, $movieName)
    {
        $this->day = $day;
        $this->movieTime = $movieTime;
        $this->movieName = $movieName;
    }

}