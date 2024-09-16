<?php

namespace App\UI\Accessory;

use Nette\Database\Explorer;
use Nette\Database\ResultSet;

#[Requires(sameOrigin: true)]
final class QueryFacade
{
    /**
     * Konstruktor
     * @param Explorer $database
     */
    public function __construct(
        private Explorer $database
    ) {
    }
    /**
     * Vrátí všechny návštěvy u lékařů
     * @return Resultset
     */
    public function getDoctors(): Resultset
    {
        return $this->database->query(
                'SELECT * FROM `get_doctors` '
            );
    }
    /**
     * Vrátí všechny pevné služby
     * @return type
     */
    public function getFixServices(): ResultSet
    {
        return $this->database->query(
                'SELECT * FROM `fix_services`'
            );
    }
    /**
     * Vrátí všechny plovoucí služby
     * @return type
     */
    public function getFloatServices(): ResultSet
    {
        return $this->database->query(
                'SELECT * FROM `float_services`;'
            );
    }
    /**
     * Vrátí všechny pracovní doby
     * @return ResultSet
     */
    public function getWorkHours(): ResultSet
    {
        return $this->database->query(
                'SELECT * FROM `get_work_hours`'
            );
    }
    /**
     * Vrátí všechny pečovatelky přiřazené ke službě
     * @return ResultSet
     */
    public function getServiceCarers(): ResultSet
    {
        return $this->database->query(
                'SELECT * FROM `get_service_carers`'
        );
    }
}
