<?php

namespace Citypantry\Models;

use Citypantry\Models\Entities\Package;
use Citypantry\Models\Entities\Vendor;

/**
 * Class Database
 * @package Citypantry\Models
 */
class Database extends \SQLite3  {

    /**
     * @var
     */
    private static $instance;

    /**
     *
     */
    function __construct() {
        $this->open(':memory:');
        $this->exec('CREATE TABLE vendors (id INTEGER PRIMARY KEY AUTOINCREMENT, name_vendor VARCHAR(255), postcode VARCHAR(128), max_cover INTEGER )');
        $this->exec('CREATE TABLE packages (id INTEGER PRIMARY KEY AUTOINCREMENT, id_vendor INTEGER, name_package VARCHAR(255), allergies VARCHAR(255), advance INTEGER, FOREIGN KEY(id_vendor) REFERENCES vendors(id) )');
    }

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param $name
     * @param $postcode
     * @param $maxCover
     * @return int
     */
    public function addVendor($name, $postcode, $maxCover) {
        $stmt = $this->prepare("INSERT INTO vendors (name_vendor, postcode, max_cover) VALUES (:name_vendor, :postcode, :max_cover)");
        $stmt->bindValue(':name_vendor', $name, SQLITE3_TEXT);
        $stmt->bindValue(':postcode', $postcode, SQLITE3_TEXT);
        $stmt->bindValue(':max_cover', $maxCover, SQLITE3_INTEGER);
        $stmt->execute();

        return $this->lastInsertRowID();
    }

    /**
     * @param $idVendor
     * @param $name
     * @param $allergies
     * @param $advance
     */
    public function addPackage($idVendor, $name, $allergies, $advance) {
        $stmt = $this->prepare("INSERT INTO packages (id_vendor, name_package, allergies, advance) VALUES (:id_vendor, :name_package, :allergies, :advance)");
        $stmt->bindValue(':id_vendor', $idVendor, SQLITE3_INTEGER);
        $stmt->bindValue(':name_package', $name, SQLITE3_TEXT);
        $stmt->bindValue(':allergies', $allergies, SQLITE3_TEXT);
        $stmt->bindValue(':advance', $advance, SQLITE3_INTEGER);
        $stmt->execute();
    }

    /**
     * @param $location
     * @param $date
     * @param $covers
     * @return array
     */
    public function findPackages($location, $date, $covers) {
        $pattern = '/^([a-zA-Z]+)[a-zA-Z0-9]+/';
        preg_match($pattern, $location, $matches);
        $locationToFind = $matches[1] . '%';

        $stmt = $this->prepare(
             'SELECT * FROM vendors v '
          .  'LEFT JOIN packages p ON v.id = p.id_vendor '
          .  'WHERE v.postcode LIKE :location '
          .  'AND datetime(:dateProvide) < datetime("now", "+"|| p.advance||" hours") '
          .  'AND :covers <= v.max_cover '
        );
        $stmt->bindValue(':location', $locationToFind, SQLITE3_TEXT);
        $stmt->bindValue(':dateProvide', $date->format('Y-m-d H:i:s'));
        $stmt->bindValue(':covers', $covers, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $vendors = array();
        while($row = $result->fetchArray(SQLITE3_ASSOC)){
            if(!isset($vendors[$row['id_vendor']])) {
                $vendors[$row['id_vendor']] = Vendor::fillFromDatabase($row);
            }

            $vendors[$row['id_vendor']]->addPackage(Package::fillFromDatabase($row));
        }
        return $vendors;
    }
}