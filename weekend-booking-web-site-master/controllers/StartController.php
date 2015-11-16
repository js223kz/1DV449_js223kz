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



class StartController
{
        private $startView;
        public function __construct(Layout $commonView)
        {
            $this->startView = new \views\StartView();
            $commonView->render($this->startView->renderHTML());

            if($this->startView->startScraping()){
                $calendarUrl = new \models\StartScraper($this->startView->getUrl());
                return new \models\CalendarScraper($calendarUrl->getcalendarUrl());
            }
        }
}