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
        return "?".self::$movieName."=$date->name";
    }
    public function showPossibleDates($possibleDates){

        $ret = "<ul>";
        $ret .= "<h1>Dessa filmer kan vi se</h1>";
        foreach($possibleDates as $date){
            $movieTime = $date->time;
            $day = $date->day;
            $name = $date->name;
            $this->clickedRow = $this->getMovieUrl($date);
            $ret .= "<li>Filmen $name klockan $movieTime på $day <a href='$this->clickedRow' >Välj denna och boka bord</a></li>";
            $ret .= "<br>";

        }
        $ret .= "</ul>";
        return $ret;
    }

    public function showChoosenDinnerTime($possibleTimeToBook){
        $ret = "<ul>";
        if(unserialize($possibleTimeToBook)  != null){
            $ret .= "<h1>Vi har lediga platser</h1>";
            foreach($possibleTimeToBook as $possible) {
                $movieTime = $possible->time;
                $day = $possible->day;
                $name = $possible->name;
                $ret .= "<li>Filmen $name klockan $movieTime på $day <a href='' >Boka bord</a></li>";
                $ret .= "<br>";
            }

        }else{
            $ret .= "<h1>Tyvärr har vi inga lediga platser. Prova en annan tid!</h1>";
        }
            $ret .= "</ul>";
            return $ret;
    }
}