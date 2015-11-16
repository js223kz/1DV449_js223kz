<?php


namespace models;

require_once('models/Scraper.php');

class StartScraper
{

    private $calendarUrl;
    private $movieUrl;
    private $restaurantUrl;

    public function __construct($url)
    {
        $this->getUrls($url);
    }

    private function getUrls($url){
        try{
            $scraper = new \models\Scraper($url);
            $xpath = $scraper->scrape($url);
        }
        catch(\Exception $e){
            $e->getMessage();
        }
        $items = $xpath->query('//ol//li/a');
        foreach($items as $item){
            $trimmed = trim($item->getAttribute('href'), " /");
            $newUrl = $url . $trimmed;
            if($trimmed == 'calendar'){
                $this->calendarUrl = $newUrl;
            }
            if($trimmed == 'cinema'){
                $this->movieUrl = $newUrl;
            }
            if($trimmed == 'dinner'){
                $this->restaurantUrl = $newUrl;
            }
        }
    }

    public function getCalendarUrl(){
        return $this->calendarUrl;
    }
    public function getMovieUrl(){
        return $this->movieUrl;
    }
    public function getRestaurantUrl(){
        return $this->restaurantUrl;
    }
}