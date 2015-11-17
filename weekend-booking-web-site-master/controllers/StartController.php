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
    private $daysToMeet;
    private $moviesToSee;
    private static $restaurantSession = "restaurantUrl";

    public function __construct(Layout $commonView)
    {
        $this->startView = new \views\StartView();


        if($this->startView->startScraping()){
            $this->scraper = new \models\StartScraper($this->startView->getUrl());
            $restaurantUrl = $this->scraper->getRestaurantUrl();
            $_SESSION[self::$restaurantSession] = $restaurantUrl;
            $this->getPossibleDaysToMeet($this->scraper->getCalendarUrl());
            $this->getPossibleMovies($this->scraper->getMovieUrl());
            $listView = $this->startView->showPossibleDates($this->moviesToSee);
            $commonView->render($listView);
        }
        //När jag går in i denna så blir det tokigt
        else if($this->startView->movieLinkIsClicked()){
            $url = $_SESSION[self::$restaurantSession];

            //$possibleTimeToBook ska returnera en array, men
            //den är null när den kommer hit
            $possibleTimeToBook =  $this->getPossibleRestaurantBookings($url);
            session_unset();
            $commonView->render($this->startView->showChoosenDinnerTime($possibleTimeToBook));
        }
        else{

            $commonView->render($this->startView->renderHTML());
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
        $movie = $_SESSION["movie"];
        $bookings = new \models\RestaurantScraper();
        $bookings->getPossibleBookings($restaurantUrl, $movie);
        session_unset();

    }
}