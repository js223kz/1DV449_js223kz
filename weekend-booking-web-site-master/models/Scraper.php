<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-11-13
 * Time: 15:47
 */

namespace models;


class Scraper
{

    public function scrape($url){
        $curl = curl_init();
        curl_setopt ($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, \Settings::USERAGENT);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec ($curl);

        if(curl_errno($curl)){
            throw new Exception(curl_error($curl));
        }
        curl_close ($curl);
        return $result;
    }

    public function getDOMDocument($result){
        $dom = new \DOMDocument();
        if($dom->loadHTML($result)){
            return new \DOMXPath($dom);

        }else{
            die("HTML kan inte läsas in");
        }
    }

    public function getJSON($result){
        return json_decode($result, true);
    }
}