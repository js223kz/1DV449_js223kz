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
    public $time;
    public $name;


    public function __construct($day, $time, $name)
    {
        $this->day = $day;
        $this->time = $time;
        $this->name = $name;
    }

}