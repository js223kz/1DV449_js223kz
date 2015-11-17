<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-13
 * Time: 14:52
 */

namespace controllers;

use views\Layout;

require_once('views/StartView.php');
require_once('views/Layout.php');
require_once('models/StartScraper.php');
require_once('models/CalendarScraper.php');
require_once('models/MovieScraper.php');
require_once('models/RestaurantScraper.php');

class StartController
{
    private $startView;
    private $parentView;
    private $daysToMeet;
    private $moviesToSee;
    private static $restaurantSession = "restaurantUrl";

    public function __construct(Layout $commonView)
    {
        $this->parentView = $commonView;
        $this->startView = new \views\StartView();
        $this->checkUserChoice();
    }

    public function checkUserChoice(){
        //if user entered an url and clicked to start scraping
        if($this->startView->startScraping()){
            $this->scraper = new \models\StartScraper($this->startView->getUrl());
            $restaurantUrl = $this->scraper->getRestaurantUrl();
            $_SESSION[self::$restaurantSession] = $restaurantUrl;

            $this->getPossibleDaysToMeet($this->scraper->getCalendarUrl());
            $this->getPossibleMovies($this->scraper->getMovieUrl());

            $listView = $this->startView->showPossibleDates($this->moviesToSee);
            $this->parentView->render($listView);
        }
        //if user clicke link with certain movie at a certain time
        else if($this->startView->movieLinkIsClicked()){
            $url = $_SESSION[self::$restaurantSession];
            $this->getPossibleRestaurantBookings($url);
            session_unset();
        }
        else{

            $this->parentView->render($this->startView->renderHTML());
        }
    }

    public function getPossibleDaysToMeet($calendarUrl){
        $matchCalendars = new \models\CalendarScraper($calendarUrl);
        $this->daysToMeet = $matchCalendars->getMatchingDays();
    }

    public function getPossibleMovies($movieUrl){
        $movies = new \models\MovieScraper($this->daysToMeet);
        $this->moviesToSee = $movies->getPossibleMovies($movieUrl);
    }

    public function getPossibleRestaurantBookings($restaurantUrl){
        $bookings = new \models\RestaurantScraper();
        $possibleTimeToBook = $bookings->getPossibleBookings($restaurantUrl, $this->startView->getMovie());
        $this->parentView->render($this->startView->showChoosenDinnerTime($possibleTimeToBook));
    }
}