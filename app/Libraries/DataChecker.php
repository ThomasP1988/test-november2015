<?php
namespace Citypantry\Libraries;

/**
 * Class DataChecker
 * @package Citypantry\Libraries
 */
class DataChecker {

    /**
     * @param $filename
     * @return mixed
     * @throws \Exception
     */
    static public function file($filename) {
        if(!file_exists($filename)){
            throw new \Exception('file not found');
        }
        return $filename;
    }

    /**
     * @param $date
     * @param $string
     * @return mixed
     * @throws \Exception
     */
    static public function date($date, $string) {
        if(!$date || !$date->format('d/m/y H:i') == $string) {
            throw new \Exception('Date and/or time format is/are not correct');
        }
        return $date;
    }

    /**
     * @param $location
     * @return mixed
     * @throws \Exception
     */
    static public function location($location) {
        if(!preg_match('/[A-Za-z][A-Za-z0-9]*/', $location)) {
            throw new \Exception('Location format is not correct');
        }
        return $location;
    }

    /**
     * @param $covers
     * @return mixed
     * @throws \Exception
     */
    static public function covers($covers) {
        if(!is_numeric($covers)) {
            throw new \Exception('the number of covers must be numeric');
        }

        return $covers;
    }

    /**
     * @param $number
     * @throws \Exception
     */
    static public function numberOfArguments($number) {
        if($number < 6) {
            throw new \Exception('Argument is missing');
        }

        if($number > 6) {
            throw new \Exception('Too many arguments');
        }
    }

    /**
     * @param $advance
     * @return mixed
     */
    static public function advance($advance) {
        $pattern = '/^([0-9]+)[a-zA-Z]?/';
        preg_match($pattern, $advance, $matches);

        return $matches[1];
    }
}