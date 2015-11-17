<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-17
 * Time: 12:45
 */

namespace models;

require_once('models/Scraper.php');

class RestaurantScraper
{
    public function getPossibleBookings($url, $possibleMovies){

        foreach($possibleMovies as $movie){
            var_dump($movie->day);
        }
        /*try{
            $scraper = new \models\Scraper($url);
            $result = $scraper->scrape($url);
            $json = $scraper->getJSON($result);


        }
        catch(\Exception $e){
            $e->getMessage();
        }*/
    }

}

