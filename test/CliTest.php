<?php

use \Citypantry\Libraries\Cli;

/**
 * Class CliTest
 */
class CliTest extends PHPUnit_Framework_TestCase {

    /**
     * @var
     */
    protected $cli;
    /**
     * @var
     */
    private $dateInput;
    /**
     * @var
     */
    private $filename;
    /**
     * @var
     */
    private $location;
    /**
     * @var
     */
    private $covers;

    /**
     *
     */
    public function setUp() {
        $datetime = new \DateTime();
        $this->dateInput = $datetime->add(new DateInterval('P1D'));
        $this->filename = 'test/datatest/data.txt';
        $this->location = 'sW85562';
        $this->covers = '10';
        $argv = array(
            'search.php',
            $this->filename,
            $this->dateInput->format('d/m/y'),
            $this->dateInput->format('H:i'),
            $this->location,
            $this->covers
        );
        $argc = count($argv);

        $this->cli = new Cli($argc, $argv);
    }

    /**
     *
     */
    public function testCli() {
        $this->assertEquals($this->cli->getLocation(), $this->location);
        $this->assertEquals($this->cli->getCovers(), $this->covers);
        $this->assertEquals($this->cli->getDate()->format('d/m/y H:i'), $this->dateInput->format('d/m/y H:i'));
        $this->assertEquals($this->cli->getFilename(), $this->filename);
    }

}
