<?php

use Citypantry\Libraries\FileParser;

/**
 * Class FileParserTest
 */
class FileParserTest extends PHPUnit_Framework_TestCase {

    /**
     *
     */
    const FILENAMETEST = 'test/datatest/data.txt';
    /**
     * @var
     */
    protected  $fileparser;

    /**
     *
     */
    public function setUp() {
        $this->fileparser = new FileParser(self::FILENAMETEST);
    }

    /**
     *
     */
    public function testParse() {
        $this->fileparser->parse();

        $database = $this->fileparser->getDatabase();
        $result = $database->query('SELECT * FROM vendors');
        $this->assertEquals(is_array($result->fetchArray()), true);
        $result = $database->query('SELECT * FROM packages');
        $this->assertEquals(is_array($result->fetchArray()), true);
    }
}
