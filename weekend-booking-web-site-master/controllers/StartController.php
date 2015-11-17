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


    public function __construct(Layout $commonView)
    {
        $this->startView = new \views\StartView();
        $commonView->render($this->startView->renderHTML());

        if($this->startView->startScraping()){
            $startScraper= new \models\StartScraper($this->startView->getUrl());

            $this->getPossibleDaysToMeet($startScraper->getCalendarUrl());
            $this->getPossibleMovies($startScraper->getMovieUrl());

            $this->startView->showPossibleDates($this->moviesToSee);
            //$this->getPossibleRestaurantBookings($startScraper->getRestaurantUrl());
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
        $bookings->getPossibleBookings($restaurantUrl, $this->moviesToSee);
    }
}