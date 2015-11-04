<?php
namespace Citypantry\Controllers;

use Citypantry\Libraries\Cli;
use Citypantry\Libraries\FileParser;
use Citypantry\Models\Database;
use Citypantry\Views\Result;

/**
 * Class Search
 * @package Citypantry\Controllers
 */
class Search {

    /**
     * Cli controller
     */
    public function SearchCli() {
        global $argc;
        global $argv;

        $cli = new Cli($argc, $argv);

        $fileparser = new FileParser($cli->getFilename());
        $fileparser->parse();

        $database = Database::getInstance();
        $vendors = $database->findPackages($cli->getLocation(), $cli->getDate(), $cli->getCovers());

        $view = new Result();
        $view->displaySearchResults($vendors);
    }
}