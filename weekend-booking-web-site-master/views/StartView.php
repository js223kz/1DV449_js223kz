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
    private static $movieName = "movieName";
    private static $movieTime = "&time";
    private $clickedRow;


    public function renderHTML(){
        return '
        <h1>Kolla möjliga tider</h1>
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

   public function movieLinkIsClicked() {
        if (isset($_GET[self::$movieName]) ) {
            return true;
        }
        return false;
    }
    private function getMovieUrl($date) {
        $_SESSION["movie"] = serialize($date);
        return "?".self::$movieName."=$date->movieName";
    }
    public function showPossibleDates($possibleDates){

        $ret = "<ul>";
        $ret .= "<h1>Dessa filmer kan vi se</h1>";
        foreach($possibleDates as $date){
            $movieTime = $date->movieTime;
            $day = $date->day;
            $name = $date->movieName;
            $this->clickedRow = $this->getMovieUrl($date);
            $ret .= "<li>Filmen $name klockan $movieTime på $day <a href='$this->clickedRow' >Välj denna och boka bord</a></li>";
            $ret .= "<br>";

        }
        $ret .= "</ul>";
        return $ret;
    }

    public function showChoosenDinnerTime(){

        var_dump("inne i viewmetod");
    }
}