<?php

use Citypantry\Autoloader;
use Citypantry\Controllers\Search;

require 'autoload.php';

$search = new Search();
$search->SearchCli();
