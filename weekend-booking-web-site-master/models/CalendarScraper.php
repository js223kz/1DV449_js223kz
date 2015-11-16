<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-16
 * Time: 12:34
 */

namespace models;

require_once('models/Scraper.php');
require_once('models/Day.php');

class CalendarScraper
{

    private $days = array();
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
            $this->setCalendars($newUrl);
        }
    }

    private function setCalendars($newUrl){
        $newDay = new Day();
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
                }
            }
        }
        array_push($this->days, $newDay);
    }

    public function getMatchingDays(){
        return array_unique($this->days);
    }
}
