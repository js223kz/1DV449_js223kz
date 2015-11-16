<?php


namespace models;

require_once('models/Scraper.php');

class StartScraper
{

    private $calendarUrl;
    public function __construct($url)
    {
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
        }
    }

    public function getcalendarUrl(){
        return $this->calendarUrl;
    }
}