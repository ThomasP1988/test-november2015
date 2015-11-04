<?php

namespace Citypantry\Libraries;

use Citypantry\Libraries\DataChecker;

/**
 * Class Cli
 * @package Citypantry\Libraries
 */
class Cli {

    /**
     * @var
     */
    private $filename;
    /**
     * @var
     */
    private $date;
    /**
     * @var
     */
    private $location;
    /**
     * @var
     */
    private $covers;

    /**
     * @param $argc
     * @param $argv
     * @throws \Exception
     */
    public function __construct($argc, $argv) {

        DataChecker::numberOfArguments($argc);

        $this->setFilename($argv[1]);
        $this->setDate($argv[2], $argv[3]);
        $this->setLocation($argv[4]);
        $this->setCovers($argv[5]);
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getCovers()
    {
        return $this->covers;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
            $this->filename = DataChecker::File($filename);
    }

    /**
     * @param mixed $date
     */
    public function setDate($date, $time)
    {
        $toFormat = $date . ' ' . $time;
        $d = \DateTime::createFromFormat('d/m/y H:i', $toFormat);

        $this->date = DataChecker::date($d, $toFormat);
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
            $this->location = DataChecker::location($location);
    }

    /**
     * @param mixed $covers
     */
    public function setCovers($covers)
    {
            $this->covers = DataChecker::covers($covers);
    }
}