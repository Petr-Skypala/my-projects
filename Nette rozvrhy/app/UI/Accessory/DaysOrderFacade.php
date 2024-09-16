<?php

declare(strict_types=1);

namespace App\UI\Accessory;

#[Requires(sameOrigin: true)]
final class DaysOrderFacade
{
    /**
     * Vrátí nové pole s přidanou položkou day_order pro určení pořadí dne
     * @param type $list
     * @return type
     */
    public function daysOrder($list)
    {
        $days = array (
            'Pondělí' => 'monday',
            'Úterý' => 'tuesday',
            'Středa' => 'wednesday',
            'Čtvrtek' => 'thursday',
            'Pátek' => 'friday'
        );
        
        
        $newList = array();
        foreach ($list as $listItem) {
        
            if (isset($listItem['day'])) {
                
                $timestamp = strtotime($days[$listItem['day']]);  // Převede český den na timestamp

            } else {

                $timestamp = strtotime($days[$listItem['float_days']]);  // Převede český den na timestamp
            }

            $dayOrder = date('N', $timestamp); // Převede timestamp na pořadové číslo
            $listItem['day_order'] = $dayOrder; // Přidá pořadové číslo 
            $newList[] = $listItem;
        }
        
        return $newList;
    }
}    