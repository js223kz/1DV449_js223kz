<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-17
 * Time: 12:45
 */

namespace models;

require_once('models/Scraper.php');
require_once('models/PossibleDate.php');

class RestaurantScraper
{
    private $movieToSee;
    private $convertedDay;
    private $convertedTime;

    public function getPossibleBookings($url, $movie){
        $this->movieToSee = unserialize($movie);
        $this->convertedDay = $this->convertDay();
        $this->convertedTime = $this->convertTime();
        $availableForBooking = array();

        try{
            $scraper = new \models\Scraper($url);
            $result = $scraper->scrape($url);
            $dom = $scraper->getDOMDocument($result);

           $checkDays = $dom->query('//p[@class="MsoNormal"]//input[@type="radio"]');

           foreach($checkDays as $day){
               $dayToCheckFor = $day->getAttribute("value")[0].$day->getAttribute("value")[1];
               $startTime =  mb_substr($day->getAttribute("value"),3,2);
               if($dayToCheckFor == $this->convertedDay){
                   if($startTime >= $this->convertedTime + 2){
                       $possibleObject = new \models\PossibleDate($this->movieToSee->day, $day->getAttribute("value"), $this->movieToSee->name);
                       array_push($availableForBooking, serialize($possibleObject));
                    }
               }
            }
        }
        catch(\Exception $e){
            $e->getMessage();
        }
        return $availableForBooking;
    }

    private function convertDay(){
        $day = $this->movieToSee->day;
        if($day == 'Fredag'){
            return 'fr';
        }
        if($day == 'Lördag'){
            return 'lo';
        }
        if($day == 'Söndag'){
            return 'so';
        }
    }

    private function convertTime(){
        $time = $this->movieToSee->time;
        return current(explode(':', $time));
    }
}

