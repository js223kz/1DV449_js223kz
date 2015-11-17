<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-16
 * Time: 17:07
 */

namespace models;

require_once('models/PossibleDate.php');

class MovieScraper
{
    private $daysToMeet;
    public function __construct($daysToMeet)
    {
        $this->daysToMeet = $daysToMeet;
        $this->changeToSwedish($daysToMeet);
    }

    public function getPossibleMovies($url){
        try{
            $scraper = new \models\Scraper($url);
            $result = $scraper->scrape($url);
            $dom = $scraper->getDOMDocument($result);
        }
        catch(\Exception $e){
            $e->getMessage();
        }
        $selectedDays = $this->getDayValue($dom);
        $selectedMovies = $this->getMovieValues($dom);
        $possibleMovies = $this->getMovies($url, $selectedDays, $selectedMovies);

        return $possibleMovies;
    }

    private function getMovies($baseUrl, $selectedDays, $selectedMovies){
        $possibleMovies = array();

        foreach($selectedDays as $key => $day){
            foreach($selectedMovies as $movie){
                $url = $baseUrl . "/check?day=" .$day["value"]. "&movie=" . $movie;
                try{
                    $scraper = new \models\Scraper($url);
                    $result = $scraper->scrape($url);
                    $json = $scraper->getJSON($result);

                    foreach($json as $movie){
                        if(!$movie["status"] == 0){
                            $possibleDateObject = new \models\PossibleDate($day["day"], $movie["time"], $movie["movie"]);
                            array_push($possibleMovies, $possibleDateObject);
                        }
                    }
                }
                catch(\Exception $e){
                    $e->getMessage();
                }
            }
        }
        return $possibleMovies;
    }

    private function changeToSwedish(){
        foreach($this->daysToMeet as $possible){
            if($possible->day == 'FRIDAY'){
                $possible->day = 'Fredag';
            }
            if($possible->day == 'SATURDAY'){
                $possible->day = 'Lördag';
            }
            if($possible->day == 'SUNDAY'){
                $possible->day = 'Söndag';
            }
        }
    }
    private function getDayValue($dom){
        $days = $dom->query('//select[@id = "day"]//option');
        $daysValue = array();
        foreach($days as $day){
            foreach($this->daysToMeet as $possible){
                if($possible->day == $day->nodeValue){
                    array_push($daysValue,["value" => $day->getAttribute('value'), "day" => $day->nodeValue] );
                }
            }
        }
        return $daysValue;
    }

    private function getMovieValues($dom){
        $movies = $dom->query('//select[@id = "movie"]//option');
        $moviesValue = array();
        foreach($movies as $movie){
            if(!empty($movie->getAttribute('value'))){
                array_push($moviesValue, $movie->getAttribute('value'));
            }
        }
        return $moviesValue;
    }
}