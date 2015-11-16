<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-16
 * Time: 12:34
 */

namespace models;

require_once('models/Scraper.php');
require_once('models/Calendar.php');
require_once('models/Day.php');

class CalendarScraper
{

    private $calenders = array();
    public function __construct($url)
    {
        $this->getCalendars($url);
    }

    private function getCalendars($url){

        try{
            $scraper = new \models\Scraper($url);
            $result = $scraper->scrape($url);
        }
        catch(\Exception $e){
            $e->getMessage();
        }
        $xpath = $result;

        //get individual calendar urls
        $items = $xpath->query('//div[@class = "col s12 center"]/ul//li/a');

        //for every individual calender url create a new calendar object
        foreach($items as $item){
            $newUrl = $url . '/' .$item->getAttribute('href');
            $path_parts = pathinfo($item->getAttribute('href'));
            $name = $path_parts['filename'];
            $object = $this->setCalendars($newUrl, $name);
            array_push($this->calenders, $object);
        }
    }

    private function setCalendars($newUrl, $name){
        $calendar = new Calendar();
        $calendar->name = $name;
        $newDay = new Day();

        $daysArray = array();

        try{
            $scraper = new \models\Scraper($newUrl);
            $result = $scraper->scrape($newUrl);
        }
        catch(\Exception $e){
            $e->getMessage();
        }
        $days = $result->query('//table//thead//tr/th');
        $statuses = $result->query('//table//tbody//tr/td');

        foreach($days as $day){
            $dayToUpper = strtoupper($day->nodeValue);

            foreach($statuses as $status){
                $statusToUpper = strtoupper($status->nodeValue);
                if($statusToUpper == 'OK'){
                    $newDay->day = $dayToUpper;
                    $newDay->available = $statusToUpper;
                    array_push($daysArray, $newDay);
                }
            }
        }
        $calendar->days = $daysArray;
        return $calendar;
    }

    public function getMatchingDays(){
        foreach($this->calenders as $calender){
            foreach($calender as $days){
                if($calender->days){

                }
            }

        }
    }
}