<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-13
 * Time: 14:54
 */

namespace views;


class StartView
{
    private static $submitURL = 'StartView::SubmitURL';
    private static $Url = 'StartView::Url';


    public function renderHTML(){
        return '
        <form method="post">
            <fieldset>
                <legend>Ange url:</legend>
                <input type="text" id="' . self::$Url. '"name="' . self::$Url. '"/>
                <input type="submit" name=' . self::$submitURL . ' value="Start"/>
			</fieldset>
		</form>
		';
    }

    public function startScraping(){
        if(isset($_POST[self::$submitURL])){
            return true;
        }
        return false;
    }

    public function getUrl(){
        return $_POST[self::$Url];
    }

    public function showPossibleDates($possibleDates){
        if(isset($_POST[self::$submitURL])){
            foreach($possibleDates as $dates){
                
            }

        }
    }
}