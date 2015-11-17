<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-17
 * Time: 12:45
 */

namespace models;

require_once('models/Scraper.php');
require_once('models/Scraper.php');

class RestaurantScraper
{
    private $movieToSee;
    private $convertedDay;
    private $convertedTime;
    public function getPossibleBookings($url, $movie){
        $this->movieToSee = unserialize($movie);
        $this->convertedDay = $this->convertDay();
        $this->convertedTime = $this->convertTime();



       try{
            $scraper = new \models\Scraper($url);
            $result = $scraper->scrape($url);
            $dom = $scraper->getDOMDocument($result);

           $checkDays = $dom->query('//p[@class="MsoNormal"]//input[@type="radio"]');

           foreach($checkDays as $day){
               $valueToCheckFor = $day->getAttribute("value")[0].$day->getAttribute("value")[1];
               if($valueToCheckFor == $this->convertedDay){
                   var_dump($day->getAttribute("value"));
               }
           }


        }
        catch(\Exception $e){
            $e->getMessage();
        }
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
        $time = $this->movieToSee->movieTime;
        return current(explode(':', $time));

    }
}

