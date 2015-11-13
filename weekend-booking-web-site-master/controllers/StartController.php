<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-13
 * Time: 14:52
 */

namespace controllers;

require_once('views/StartView.php');

class StartController
{
        private $renderStartView;
        public function __construct()
        {
            $this.$this->renderStartView = new \views\StartView();
        }
}